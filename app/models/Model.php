<?php

class Model {
    private $pdo;

    public function __construct($file) {
        $this->pdo = new PDO('sqlite:' . $file);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDataById($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = '" . $id . "'";
        $stmt = $this->pdo->query($sql);
        return $stmt;
    }

    public function getDataByName($table, $name) {
        $sql = "SELECT * FROM $table WHERE name = '" . $name . "'";
        $stmt = $this->pdo->query($sql);
        return $stmt;
    }

    public function getAllData($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->pdo->query($sql);
        return $stmt;
    }

    public function createTable($table, $params, $types) {
        try {
            $base = "CREATE TABLE $table (";
            $end = null;

            for ($i = 0; $i < count($params); $i++) {
                $end += $params[i] . " " . $types[i] . ", ";
            }
            $end = substr_replace($end, ")", -2);
            $sql = $base + $end;

            $this->pdo->exec($sql);
            $this->$pdo = null;
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }

    public function addValues($table, $params, $values) {
        try {
            $base = "INSERT INTO $table (";
            $end = "VALUES (";

            for ($i = 0; $i < count($params); $i++) {
                $base += $params[i] . ", ";
                $end += $values[i] . ", ";
            }
            $base = substr_replace($base, ")", -2);
            $end = substr_replace($end, ")", -2);
            $sql = $base + $end;

            $this->pdo->exec($sql);
            $this->pdo = null;
        } catch (PDOException $e) {
            echo "Error inserting values: " . $e->getMessage();
        }
    }

    public function updateValueById($table, $id, $param, $value) {
        try {
            $sql = "UPDATE $table SET $param = '" . $value . "' WHERE id = $id";
            $this->pdo->exec($sql);
            $this->pdo = null;
        } catch(PDOException $e) {
            echo "Error updating value: " . $e->getMessage();
        }
    }

    public function deleteById($table, $id) {
        try {
            $sql = "DELETE FROM $table WHERE id = $id";
            $this->pdo->exec($sql);
            $this->pdo = null;
        } catch(PDOException $e) {
            echo "Error deleting data: " . $e->getMessage();
        }
    }



}


?>