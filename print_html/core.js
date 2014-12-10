$(function() {
	
	$('.print').click(function() {
		var container = $(this).attr('rel');
		$('#' + container).printArea();
		return false;
	});
	
});