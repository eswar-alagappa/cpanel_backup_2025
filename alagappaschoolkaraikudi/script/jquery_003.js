$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade',
		pager: '.right',
		cleartype: 1,
		after: function(curr, next, opts) {
		    var alt = $(next).find('img').attr('alt');
			$('.left').fadeIn('200');
		    $('.left').html(alt);
		},
		before: function(curr, next, opts) {
		    var alt = $(curr).find('img').attr('alt');
			$('.left').fadeOut('200');
		    $('.left').html(alt);
		}
	});
});