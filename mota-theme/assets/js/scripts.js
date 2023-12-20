// DOMContentLoaded related functions

document.addEventListener("DOMContentLoaded", function() {

    // Menu nav burger

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

    // Contact form

    const contactBtns = document.querySelectorAll(".menu-item-29 a");
    const modalForm = document.querySelector(".modal-overlay");
    const modalContent = document.getElementById("wpcf7-f28-o1");

    contactBtns.forEach(contactBtn => {
        contactBtn.onclick = openForm;
    });

    function openForm(event) {
        event.preventDefault();
        modalForm.classList.add("active");

        document.addEventListener("click", closeFormOutside);
    }

    function closeFormOutside(event) {
        if (!modalContent.contains(event.target) && !Array.from(contactBtns).includes(event.target)) {
            modalForm.classList.remove("active");

            document.removeEventListener("click", closeFormOutside);
        }
    }
});