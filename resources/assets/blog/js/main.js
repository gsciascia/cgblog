// Shorthand for $( document ).ready()
$(function() {
    $(".header__icon-hamburger").click( function(e){

         $('.header__menu').toggleClass('is-open');
        e.preventDefault();

    });


});