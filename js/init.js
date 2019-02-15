(function($){
  $(function(){
    // Init Materialize's parallax components
    $('.parallax').parallax();

    // Force comment form validation (disabled by default on html5 forms, see comment-template.php)
    $('#commentform').removeAttr('novalidate');

  }); // end of document ready
})(jQuery); // end of jQuery name space
