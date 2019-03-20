@extends('layouts.app')

@section('content')
	<style>
		{
		list-style:none;
		}
	</style>
<body>
		<div class="jumbotron text-center">
			<h1>MBA TEST</h1>
   			<br/>
   			<div class="card w-50 mx-auto bg-dark">
  				<br>
  				<div class="text-light" id='quiz'></div>
  				<br>
  			</div>
  			<div id='score'></div>
    		<div id='confidence'></div><br>
    		<div class='btn btn-primary btn lg' id='next'><a class="text-light" href='#'>Next</a></div>
    		<div class='btn btn-primary btn lg' id='prev'><a class="text-light" href='#'>Prev</a></div>
    		<div class='btn btn-primary btn lg' id='start'> <a class="text-light" href='#'>Start Over</a></div>
    	</div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script>
		(function() {
		  var questions = [
		  	easy = [		  {
		    question: "Easy Question #1",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Easy Question #2",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Easy Question #3",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Easy Question #4",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Easy Question #5",
		    choices: [0, 1],
		    correctAnswer: 1
		  }], medium = [		  {
		    question: "Medium Question #1",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Medium Question #2",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Medium Question #3",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Medium Question #4",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Medium Question #5",
		    choices: [0, 1],
		    correctAnswer: 1
		  }], difficult =[		  {
		    question: "Hard Question #1",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Hard Question #2",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Hard Question #3",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Hard Question #4",
		    choices: [0, 1],
		    correctAnswer: 1
		  }, {
		    question: "Hard Question #5",
		    choices: [0, 1],
		    correctAnswer: 1
			}]
		  ];
		  
		  var questionCounter = 0; //Tracks question number
		  var selections = []; //Array containing user choices
		  var quiz = $('#quiz'); //Quiz div object
		  var confCounter = 0;
		  var difficulty = 0;
		  var conf = $('#confidence');
		  var limit = 2;
		  // Display initial question
		  displayNext();
		  
		  // Click handler for the 'next' button
		  $('#next').on('click', function (e) {
		    e.preventDefault();
		    
		    // Suspend click listener during fade animation
		    if(quiz.is(':animated')) {        
		      return false;
		    }
		    choose();
		    checkScore(questionCounter);
		          
		    // If no user selection, progress is stopped
		    if (isNaN(selections[questionCounter])) {
		      alert('Please make a selection!');
		    } else {
		      questionCounter++;
		      displayNext();
		    }
		  });
		  
		  // Click handler for the 'prev' button
		  $('#prev').on('click', function (e) {
		    e.preventDefault();
		    
		    if(quiz.is(':animated')) {
		      return false;
		    }

		    choose();
		    questionCounter--;
		    displayNext();
		  });
		  
		  // Click handler for the 'Start Over' button
		  $('#start').on('click', function (e) {
		    e.preventDefault();
		    
		    if(quiz.is(':animated')) {
		      return false;
		    }
		    
		    questionCounter = 0;
		    selections = [];
		    displayNext();
		    $('#start').hide();
		  });
		  
		  // Animates buttons on hover
		  $('.button').on('mouseenter', function () {
		    $(this).addClass('active');
		  });
		  $('.button').on('mouseleave', function () {
		    $(this).removeClass('active');
		  });
		  
		  // Creates and returns the div that contains the questions and 
		  // the answer selections
		  function createQuestionElement(index) {
		    var qElement = $('<div>', {
		      id: 'question'
		    });
		    
		    var header = $('<h2>Question ' + (index + 1) + ':</h2>');
		    qElement.append(header);
		    
		    var question = $('<p>').append(questions[difficulty][index].question);
		    qElement.append(question);
		    
		    var radioButtons = createRadios(index);
		    qElement.append(radioButtons);
		    
		    return qElement;
		  }
		  
		  // Creates a list of the answer choices as radio inputs
		  function createRadios(index) {
		    var radioList = $('<ul>');
		    radioList.left = '-999 cm';
		    radioList.position = 'absolute';
		    var item;
		    var input = '';
		    for (var i = 0; i < questions[difficulty][index].choices.length; i++) {
		      item = $('<li>');
		      input = '<input type="radio" name="answer" value=' + i + ' />';
		      input += questions[difficulty][index].choices[i];
		      item.append(input);
		      radioList.append(item);
		    }
		    return radioList;
		  }
		  
		  // Reads the user selection and pushes the value to an array
		  function choose() {
		    selections[questionCounter] = +$('input[name="answer"]:checked').val();
		  }
		  
		  // Displays next requested element
		  function displayNext() {
		    quiz.fadeOut(function() {
		      $('#question').remove();

		      if(questionCounter < questions[difficulty].length){
		        var nextQuestion = createQuestionElement(questionCounter);
		        quiz.append(nextQuestion).fadeIn();
		        if (!(isNaN(selections[questionCounter]))) {
		          $('input[value='+selections[questionCounter]+']').prop('checked', true);
		        }
		        // Controls display of 'prev' button
		        
		        if(questionCounter === 1){
		          $('#prev').show();
		        } else if(questionCounter === 0){
		          $('#prev').hide();
		          $('#next').show();
		        }
		      }else {
		        var scoreElem = displayScore();
		        quiz.append(scoreElem).fadeIn();
		        $('#next').hide();
		        $('#prev').hide();
		        $('#start').show();
		      }
		    });
		  }
		  function checkScore(index){
			var score = $('<p>',{id: 'score'});
			if(selections[index] === questions[difficulty][index].correctAnswer){
				confCounter++;
			}
			else{
				confCounter--;
			}
				checkConfCounter();
				conf.text(confCounter);
		  }

		  function checkConfCounter(){
		  	if(confCounter > limit){
		  		if(difficulty < questions[difficulty].length){
		  			difficulty++;
		  		}
		  		confCounter = 0;
		  	}else if(confCounter < 0){
		  		if(difficulty > 0){
		  			difficulty--;	
		  		}
		  		confCounter = 0;
		  	}
		  }
		  // Computes score and returns a paragraph element to be displayed
		  function displayScore() {
		    var score = $('<p>',{id: 'question'});
		    
		    var numCorrect = 0;
		    for (var i = 0; i < selections.length; i++) {
		      if (selections[i] === questions[difficulty][i].correctAnswer) {
		        numCorrect++;
		      }
		    }
		    
		    score.append('You got ' + numCorrect + ' questions out of ' +
		                 questions[difficulty].length + ' right!!!'+'</p>');
		    return score;
		  }
		})();
		</script><!-- 
		<script type="text/javascript" src='questions.json'></script>
		<script type='text/javascript' src='jsquiz.js'></script> -->
</body>
@endsection