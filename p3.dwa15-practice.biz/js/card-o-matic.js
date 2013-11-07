$('.colors').click(function() {
	
	var color_that_was_clicked = $(this).css('background-color');
	
	$('#canvas').css('background-color', color_that_was_clicked);
	
});



$('.textures').click(function() {
	      
	var texture_that_was_clicked = $(this).css('background-image');
	console.log(texture_that_was_clicked);
	$('#canvas').css('background-image', texture_that_was_clicked);
	
});


$('input[name=message]').click(function() {

	// Get the label element that comes immediately after this radio button
	var label = $(this).next();

	// From the label element extract the inner HTML - i.e what is the message.
	var message = label.html();

	// Place the message in the card
	$('#message-output').html(message);

});


$('#recipient').keyup(function() {

	// Find out what is in the field
	var value = $(this).val();

	var how_many_characters = value.length;

	var how_many_left = 14 - how_many_characters;

	if(how_many_left == 0) {
		$('#recipient-error').css('color','red');
	}
	else if(how_many_left < 5) {
		$('#recipient-error').css('color','orange');
	}


	$('#recipient-error').html('You have ' + how_many_left + ' characters left.');

	/*
	if(how_many_characters == 14) {
		$('#recipient-error').html('You\'ve reached the max amount of characters');
	}
	else {
		$('#recipient-error').html('');
	}
	*/

	// Place the message in the card
	$('#recipient-output').html(value);

});



$('.stickers').click(function() {

	//var new_image = "<img src='"++"'></img>";
	//$('#canvas').html(new_image);

	// Clone whatever sticker was clicked
	var new_image = $(this).clone();

	new_image.addClass('stickers_on_card');

	// Place the clone in the canvas
	$('#canvas').prepend(new_image);

	$('.stickers_on_card').draggable({containment: "#canvas"});

});









