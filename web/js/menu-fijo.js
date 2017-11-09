$(document).ready(function(){
  var altura = $('.side-menu').offset().top;

  $(window).on('scroll', function(){
    if($(window).scrollTop() > altura){
      $('.side-menu').addClass('menu-fixed');
      $('.justify-content-md-center').removeClass('non-fixed');
    }else{
      $('.side-menu').removeClass('menu-fixed');
      $('.justify-content-md-center').addClass('non-fixed');
    }
  });
});
