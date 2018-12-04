$(document).ready(function(){
    $('.slider').slider({
        indicators:false,
        height: 400
    });

    $('.parallax').parallax({
        height: 20
    });

    $('.scrollspy').scrollSpy();

    $('.dropdown-trigger').dropdown();
    $('.modal').modal();
    $('input#nom, input#sujet, textarea#textarea1').characterCounter();
    AOS.init();

    setTimeout(function(){
        document.getElementsByClassName("snackbar").style.display('none');
    }, 3000);
});
