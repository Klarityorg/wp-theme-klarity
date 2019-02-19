(function($){
  $(function(){
    // Init Materialize's parallax components
    $('.parallax').parallax();

    // Force comment form validation (disabled by default on html5 forms, see comment-template.php)
    $('#commentform').removeAttr('novalidate');

    // Scroll to anchor if it exists
    let anchor = $(':target');
    if (anchor.length) {
      $('html, body').prop({scrollTop: anchor.offset().top - $('.navbar-fixed').height()});
    }

  });
})(jQuery);
