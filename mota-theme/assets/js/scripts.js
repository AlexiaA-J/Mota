// MENU BURGER

const menuBurger = document.getElementById("menu_burger");
const openBtn = document.getElementById("openBtn");
const closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openMenu;
closeBtn.onclick = closeMenu;

function openMenu() {
    menuBurger.classList.add("active");
}

function closeMenu() {
    menuBurger.classList.remove("active");
}
