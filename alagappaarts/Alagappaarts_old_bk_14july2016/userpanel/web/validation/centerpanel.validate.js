$(document).ready(function(){


$.validator.addMethod('required_group', function(val, el) {
	var $module = $(el).parents('div.searchBox');
     return $module.find('.required_group:filled').length;
});
$.validator.addClassRules('required_group', {
        'required_group' : true
});
$.validator.messages.required_group = 'Please fill out at least one of these fields.';
$('#frmStudentsearch').validate({
	errorPlacement: function(error, element) {
		if(element.attr("name") == 'txtEnrollmentid' )
		  $("#frmStudentsearch").find(".errorContainer").append(error);
}});

});