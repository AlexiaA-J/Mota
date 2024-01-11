$(document).ready(function() {

    // Menu nav burger

    const menuBurger = $("#menu_burger");
    const openBtn = $("#openBtn");
    const closeBtn = $("#closeBtn");

    openBtn.click(openMenu);
    closeBtn.click(closeMenu);

    function openMenu() {
        menuBurger.addClass("active");
    }

    function closeMenu() {
        menuBurger.removeClass("active");
    }

    // Contact form call from menu or single-photo button

    const contactBtns = $(".menu-item-29 a, .contact-btn");
    const modalForm = $(".modal-overlay");
    const modalContent = $("#wpcf7-f28-o1");
    const formRefDiv = $(".formRef");

    contactBtns.click(openForm);

    function openForm(event) {
        event.preventDefault();
        const refValueElement = $(".ref-value");

        // Check if ref-value element is present on the page
        if (refValueElement.length) {
            const refValue = refValueElement.text();

            const inputField = formRefDiv.find("input[name='your-subject']");
            if (inputField.length) {
                inputField.val(refValue.toUpperCase());
            }
        }
        modalForm.addClass("active");
            $(document).click(closeFormOutside);
    }

    function closeFormOutside(event) {
        if (!modalContent.is(event.target) && !$.makeArray(contactBtns).includes(event.target)) {
            modalForm.removeClass("active");
            $(document).unbind("click", closeFormOutside);
        }
    }

    // Arrow positions

    var arrowLeft = $('.arrow-left');
    var arrowRight = $('.arrow-right');

    if (arrowLeft.length && !arrowRight.length) {
        arrowLeft.mouseover(function() {
            var thumbnailLeft = $('.hover-thumbnail.thumbnail-left');
            if (thumbnailLeft.length) {
                thumbnailLeft.css({
                    display: 'block',
                    top: '-80px',
                    left: '-55px'
                });
            }
        });

        arrowLeft.mouseout(function() {
            var thumbnailLeft = $('.hover-thumbnail.thumbnail-left');
            if (thumbnailLeft.length) {
                thumbnailLeft.css('display', 'none');
            }
        });
    }

    $(document).ready(function() {
        $('.selector').select2({
            dropdownPosition: 'below',
        });
    });
});