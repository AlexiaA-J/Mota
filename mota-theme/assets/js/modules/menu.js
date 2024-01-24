// Menu nav burger

function initializeMenu() {
    const menuBurger = jQuery("#menu_burger");
    const openBtn = jQuery("#openBtn");
    const closeBtn = jQuery("#closeBtn");

    openBtn.click(openMenu);
    closeBtn.click(closeMenu);

    function openMenu() {
        menuBurger.addClass("active");
    }

    function closeMenu() {
        menuBurger.removeClass("active");
    }
}