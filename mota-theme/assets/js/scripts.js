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

    // Contact form call from menu
const contactBtns = document.querySelectorAll(".menu-item-29 a, .contact-btn");
const modalForm = document.querySelector(".modal-overlay");
const modalContent = document.getElementById("wpcf7-f28-o1");
const formRefDiv = document.querySelector(".formRef");

contactBtns.forEach(contactBtn => {
    contactBtn.onclick = openForm;
});

function openForm(event) {
    event.preventDefault();
    const refValueElement = document.querySelector(".ref-value");

    // Check if ref-value element is present on the page
    if (refValueElement) {
        const refValue = refValueElement.textContent;

        const inputField = formRefDiv.querySelector("input[name='your-subject']");
        if (inputField) {
            inputField.value = refValue;
        }

        const uppercaseValue = refValue.toUpperCase();

        inputField.value = uppercaseValue;
    }
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