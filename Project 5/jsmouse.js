var canvas = document.getElementById("myCanvas");
var context = canvas.getContext("2d");
var smiling = true;


//function to draw the base head and eyes
function drawHead() {
	//draw head for both canvases
	context.beginPath();
	context.arc(250,250,200,0,2*Math.PI);
	context.fillStyle = "#f2f547";
	context.fill();
	context.beginPath();
	context.arc(250,250,200,0,2*Math.PI);
	context.strokeStyle = "#000000";
	context.lineWidth = 1;
	context.stroke();

	//draw eyes for both canvases
	context.beginPath();
	context.arc(170,190, 30, 0, 2*Math.PI);
	context.fillStyle = "#001aff";
	context.fill();
	context.beginPath();
	context.arc(330,190, 30, 0, 2*Math.PI);
	context.fillStyle = "#001aff";
	context.fill();
}

//function used to draw smile when button is pressed
function drawSmile() {
	//draw smile
	context.beginPath();
	context.arc(250, 300, 90, 0.2, Math.PI - 0.2);
	context.strokeStyle = "#c20000";
	context.lineWidth = 5;
	context.stroke();
}

//function used to draw frown when button is pressed
function drawFrown() {
	//draw frown
	context.beginPath();
	context.arc(250, 390, 90, 0.2 + Math.PI, 2*Math.PI - 0.2);
	context.strokeStyle = "#0064c2";
	context.lineWidth = 5;
	context.stroke();
}


//INITIAL DRAW
drawHead();
drawSmile();

function myFunction() {
	context.clearRect(0,0,1000,1000);
	if(smiling) {
		// smileCanvas.style.display = "none";
		// frownCanvas.style.display = "block";
		drawHead();
		drawFrown();
		document.getElementById("button").innerHTML = "Make me happy";
		smiling = false;
	} else {
		// smileCanvas.style.display = "block";
		// frownCanvas.style.display = "none";
		drawHead();
		drawSmile();
		document.getElementById("button").innerHTML = "Make me sad";
		smiling = true;
	}

}