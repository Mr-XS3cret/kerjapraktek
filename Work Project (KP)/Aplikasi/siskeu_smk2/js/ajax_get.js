$(function() {
	$('#loading').ajaxStart(function(){
		$(this).fadeIn();
	}).ajaxStop(function(){
		$(this).fadeOut();
	});

	$('#menu a').click(function() {
		var url = $(this).attr('href');
		$('#container').load(url);
		return false;
	});
});