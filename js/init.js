(function($){
  $(function(){
    // Init Materialize's parallax components
    $('.parallax').parallax();

    // Force comment form validation (disabled by default on html5 forms, see comment-template.php)
    $('#commentform').removeAttr('novalidate');

    // Scroll to anchor if it exists
    if ($(':target').length) {
      $('html, body').prop({scrollTop: $(':target').offset().top - $('.navbar-fixed').height()});
    }

    // Show non-empty breadcrumbs
    $('.breadcrumbs').each(function(){
      if($.trim($(this).text()) !== ''){
        $(this).addClass('show-after-page-load');
      }
    });

  });
})(jQuery);
