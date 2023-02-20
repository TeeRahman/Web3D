let logo = document.getElementById('burgerMenu');
let dropdown = document.getElementById('navHidden')

logo.onclick = function() {
    dropdown.classList.toggle('nav-show')
}