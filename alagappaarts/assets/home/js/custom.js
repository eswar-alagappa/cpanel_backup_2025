$(document).ready(function(){

//activate the lightbox
jQuery('a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg]').prettyPhoto({theme: "light_square"});

$('#frontpage-slider').aviaSlider({
animationSpeed: 600,
betweenBlockDelay: 1000,
transition: 'fade'
});		


												
});



