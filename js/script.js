/*
* JavaScripts for Pranon_base_theme
* */

jQuery(document).ready(function($){

  /*
  * Scroll top
  * */
    var speed = 250;
    $('#topButton').on('click', function(){
        $('html, body').animate({scrollTop:0}, speed);
        return false;
    });
/*
* Preloader
* */
    $(window).load(function () {
        $('#page-pre-loader').fadeOut(1000, function () {
            $(this).remove();
        });
    });
  /*
  * -------------------sticky menu activation-------------------------------
  * */
    var num = 50;
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > num) {
            $('.menu').addClass('fixed');
        } else {
            $('.menu').removeClass('fixed');
        }
    });

});





