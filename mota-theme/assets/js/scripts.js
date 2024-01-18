$(document).ready(function() {

    localStorage.clear();

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

    // LOAD MORE

    const loadMore = $("#load-more");
    let currentPage = 1;

    loadMore.on('click', function(event) {
        event.preventDefault();
        currentPage++;

        $.ajax({
            type: 'POST',
            url: './wp-admin/admin-ajax.php', // Use the absolute URL provided by WordPress
            dataType: 'json',
            data: {
                action: 'load_more',
                paged: currentPage,
            },
            success: function(response) {
                $('.gallery-container').append(response.html);

                if (!response.has_more_posts) {
                    loadMore.hide();
                } else {
                    loadMore.show();
                }
            },
        });
    });

    // Variables to track filter states
    var activeCategory = 'all';
    var activeFormat = 'all';
    var activeSortByDate = 'all';

    $('#categories').val(activeCategory);
    $('#formats').val(activeFormat);
    $('#sort-by-date').val(activeSortByDate);

    // Function to check if any filters are active
    function areFiltersActive() {
        return activeCategory !== 'all' || activeFormat !== 'all' || activeSortByDate !== 'all';
    }

    // Event handler for filter changes
    $('#categories, #formats, #sort-by-date').on('change', function() {
        ajaxFilter();
    });

    function ajaxFilter() {
        var category = $('#categories').val();
        var format = $('#formats').val();
        var sortByDate = $('#sort-by-date').val();

        // Update active filter states
        activeCategory = category;
        activeFormat = format;
        activeSortByDate = sortByDate;

        // Hide the "Load More" button if filters are active
        if (areFiltersActive()) {
            $('#load-more').hide();
        }

        $.ajax({
            type: 'POST',
            url: './wp-admin/admin-ajax.php',
            data: {
                action: 'ajax_filter',
                category: category,
                format: format,
                sortByDate: sortByDate
            },
            success: function(response) {
                $('.gallery-container').html(response);

                // Show the "Load More" button if no filters are active
                if (!areFiltersActive()) {
                    $('#load-more').show();
                }
            }
        });
    }
});