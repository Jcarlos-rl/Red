$(document).ready(function(){
  $(window).scroll(function(){
      if ($(this).scrollTop() > 0 ) {
        $('header').addClass('herader2');
      }else {
        $('header').removeClass('herader2');
      }
  });
});
