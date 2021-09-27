	$(document).ready(function(){
	var currentQuesAnswered = true;
	var currentQuestion = "";
	var questionAnswers = new Map();
	questionAnswers.set("Kessel", true);
	questionAnswers.set("Luke", false);
	questionAnswers.set("Anakin", true);
	questionAnswers.set("Mandalorian", false);
	var numCorrect = 0;

	function win() {
		if (numCorrect == 4) {
			$("#questions").append('<p class="win_text">That is correct!</p>').append('<div class="win_img" style="background:#98bf21;height:100px;width:100px;position:absolute;"></div>');
			// .append('<img class="win_img" src="images/star.png" alt="star" height="50px", width="auto">');
			//couldn't figure out the last bit of animation
			$(".win_text").animate({left: '500px'});
			$(".win_img").animate({left: '+=250px'});
		}
	}

	function disableButton() {
		if (currentQuestion == "Kessel") {
			$("#kessel").prop('disabled', true);
		} else if (currentQuestion == "Luke") {
			$("#luke").prop('disabled', true);
		} else if (currentQuestion == "Anakin") {
			$("#anakin").prop('disabled', true);
		} else if (currentQuestion == "Mandalorian") {
			$("#mandalorian").prop('disabled', true);
		}
	}

	$("#kessel").click(function() {
		if($("#answer-box p").hasClass("right")) {
			$(".right").remove();
		} else if($("#answer-box p").hasClass("wrong")) {
			$(".wrong").remove();
		} else if($("#answer-box p").hasClass("warning")) {
			$(".warning").remove();
		}

		$("#true").prop('checked', false);
		$("#false").prop('checked', false);

		if (currentQuesAnswered) {
			currentQuesAnswered = false;
			currentQuestion = "Kessel";
			$("#question_text").text("The Millenium Falcon made the Kessel Run in 12 parsecs.");
		} else if (!($("#answer-box p").hasClass("warning"))) {
			$("#answer-box").append('<p class="warning">Must answer current question</p>');
		}
	});

	$("#luke").click(function() {
		if($("#answer-box p").hasClass("right")) {
			$(".right").remove();
		} else if($("#answer-box p").hasClass("wrong")) {
			$(".wrong").remove();
		} else if($("#answer-box p").hasClass("warning")) {
			$(".warning").remove();
		}

		$("#true").prop('checked', false);
		$("#false").prop('checked', false);
		
		if (currentQuesAnswered) {
			currentQuesAnswered = false;
			currentQuestion = "Luke";
			$("#question_text").text("Luke's first lightsaber was green.");
		} else if (!($("#answer-box p").hasClass("warning"))) {
			$("#answer-box").append('<p class="warning">Must answer current question</p>');
		}
	});

	$("#anakin").click(function() {
		if($("#answer-box p").hasClass("right")) {
			$(".right").remove();
		} else if($("#answer-box p").hasClass("wrong")) {
			$(".wrong").remove();
		} else if($("#answer-box p").hasClass("warning")) {
			$(".warning").remove();
		}

		$("#true").prop('checked', false);
		$("#false").prop('checked', false);
		
		if (currentQuesAnswered) {
			currentQuesAnswered = false;
			currentQuestion = "Anakin";
			$("#question_text").text("Anakin hates sand.");
		} else if (!($("#answer-box p").hasClass("warning"))) {
			$("#answer-box").append('<p class="warning">Must answer current question</p>');
		}
	});


	$("#mandalorian").click(function() {
		if($("#answer-box p").hasClass("right")) {
			$(".right").remove();
		} else if($("#answer-box p").hasClass("wrong")) {
			$(".wrong").remove();
		} else if($("#answer-box p").hasClass("warning")) {
			$(".warning").remove();
		}

		$("#true").prop('checked', false);
		$("#false").prop('checked', false);
		
		if (currentQuesAnswered) {
			currentQuesAnswered = false;
			currentQuestion = "Mandalorian";
			$("#question_text").text("The green alien in The Mandalorian is referred to as Baby Yoda in season 1.");
		} else if (!($("#answer-box p").hasClass("warning"))) {
			$("#answer-box").append('<p class="warning">Must answer current question</p>');
		}
	});


	$("#check_answer").click(function() {
		if($("#answer-box p").hasClass("warning2")) {
			$(".warning2").remove();
		}
		if(!currentQuesAnswered) {
			if ($("#true").is(':checked')) {
				currentQuesAnswered = true;
				if(questionAnswers.get(currentQuestion)) {
					$("#answer-box").append('<p class="right">That is correct!</p>');
					$("#questions").append('<li>' + currentQuestion + '</li>');
					disableButton();
					++numCorrect;
					win();
				} else {
					$("#answer-box").append('<p class="wrong">Sorry that is incorrect.</p>');
					$("#questions").append('<li>' + currentQuestion + '</li>');
				}
			} else if ($("#false").is(':checked')) {
				currentQuesAnswered = true;
				if(!questionAnswers.get(currentQuestion)) {
					$("#answer-box").append('<p class="right">That is correct!</p>');
					$("#questions").append('<li>' + currentQuestion + '</li>');
					disableButton();
					++numCorrect;
					win();
				} else {
					$("#answer-box").append('<p class="wrong">Sorry that is incorrect.</p>');
					$("#questions").append('<li>' + currentQuestion + '</li>');
				}
			} else {
				$("#answer-box").append('<p class="warning2">Must select true/false</p>');
			}
		}
	});

});