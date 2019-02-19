(function($){
  $(function(){
    // Init Materialize's parallax components
    $('.parallax').parallax();

    // Force comment form validation (disabled by default on html5 forms, see comment-template.php)
    $('#commentform').removeAttr('novalidate');

    // Scroll to anchor if it exists
    $('html, body').prop({scrollTop:$(':target').offset().top - $('.navbar-fixed').height()});

  });
})(jQuery);
