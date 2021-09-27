window.onload  = function() {
	var canvas = document.getElementById("myCanvas");
	var context = canvas.getContext("2d");
	document.addEventListener("keydown", dealWithKeyboard, false);
	var train = document.getElementById("train");
	var speed = 25;

	context.scale(0.5,0.5);
	context.drawImage(train, 0, 0);
	context.scale(2, 2);

	function dealWithKeyboard(e) {
		// canvas.clear();
		// canvas = document.getElementById("myCanvas");
		context.clearRect(0, 0, 500, 500);
		switch(e.keyCode) {
			case 37:
				// left key pressed
				context.translate(-1 * speed, 0);
				break;
			case 38:
				// up key pressed
				context.translate(0, -1 * speed);
				break;
			case 39:
				// right key pressed
				context.translate(speed, 0);
				break;
			case 40:
				// down key pressed
				context.translate(0, speed);
				break;	
		}
		context.scale(0.5,0.5);
		context.drawImage(train, 0, 0);
		context.scale(2, 2);
	}

}