$('.colors').click(function() {
	
	var color_that_was_clicked = $(this).css('background-color');
	
	$('#canvas').css('background-color', color_that_was_clicked);
	
});



$('.textures').click(function() {
	      
	var texture_that_was_clicked = $(this).css('background-image');
	console.log(texture_that_was_clicked);
	$('#canvas').css('background-image', texture_that_was_clicked);
	
});









