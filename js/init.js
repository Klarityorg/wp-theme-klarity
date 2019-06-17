(function ($) {
    $(function () {
        // Init Materialize's parallax components
        $('.parallax').parallax();

        // Force comment form validation (disabled by default on html5 forms, see comment-template.php)
        $('#commentform').removeAttr('novalidate');

        // Scroll to anchor if it exists
        if ($(':target').length) {
            $('html, body').prop({scrollTop: $(':target').offset().top - $('.navbar-fixed').height()});
        }

        // Show non-empty breadcrumbs
        $('.breadcrumbs').each(function () {
            if ($.trim($(this).text()) !== '') {
                $(this).addClass('show-after-page-load');
            }
        });

    });

    /*--------------------------------------------------------------
    # Custom code new design 2019/05/10
    --------------------------------------------------------------*/
    $(document).ready(function () {
        $(document).on("click", ".tablinks", function (event) {
            $('.tabcontent, .tablinks').removeClass('active');
            $('.' + $(this).data('id')).addClass('active');
            $(this).addClass('active')
        });

        $(document).on("click", "#filter-all-case", function (event) {
            event.preventDefault();
            $('.solved-case-list').show();
            $('.unsolved-case-list').show();
        });

        $(document).on("click", "#filter-solved-case", function (event) {
            event.preventDefault();
            $('.solved-case-list').show();
            $('.unsolved-case-list').hide();
        });

        $(document).on("click", "#filter-unsolved-case", function (event) {
            event.preventDefault();
            $('.solved-case-list').hide();
            $('.unsolved-case-list').show();
        });

        $(document).on("click", ".filter-news", function (event) {
            event.preventDefault();
            $('.container-content-news article').hide();
            var category = $(this).data('category');
            $('.category-' + category).show();
        });

        var data = {
            action: 'klarity_count_all_tabs',
            post_id: post_id
        };
        $.post(ajaxurl, data, function (response) {
            var result = JSON.parse(response);
            $('.personal-involved-number').text(result['personal_involved']);
            $('.call-to-action-number').text(result['number_actions']);
            $('.comments-number').text(result['comments']);
        });
    });

    // $(window).on("scroll", function () {
    //     if ($(window).scrollTop() > 50) {
    //         $(".home nav").addClass("active");
    //         $(".home .navbar-fixed").addClass("active");
    //     } else {
    //         //remove the background property so it comes transparent again (defined in your css)
    //         $(".home nav").removeClass("active");
    //         $(".home .navbar-fixed").removeClass("active");
    //     }
    // });

})(jQuery);
