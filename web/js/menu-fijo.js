//Menu pegajoso
$(document).ready(function(){
  var altura = $('.side-menu').offset().top;

  $(window).on('scroll', function(){
    if($(window).scrollTop() > altura){
      $('.side-menu').addClass('menu-fixed');
    }else{
      $('.side-menu').removeClass('menu-fixed');
    }
  });
});

//Color de los botones
$(document).ready(function() {

  // identifico el path
  var pathname = window.location.pathname;

  //Saco el ultimo valor del path
  var path = pathname.split("/", 3);
  var myId = path[2];


  //en la clase "myId" agrego el activo
  $('#' + myId).removeClass('boton');
  $('#' + myId).addClass('boton-activo');

});
