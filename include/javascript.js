var common = "cell_"; //The common head before each cell ID.
var filled = new Array(); //The index of which are filled by the user: [21, 32, 34, ...]
var ans = new Array(); //The 81 keys to the quiz.
var wrong_times = 1; //Nbr of mistakes.
var submitted = 0; //Whether the current user has submitted the answer or not.

function changeWindow(url){
	var window=url;
	document.getElementById("window").src=window;
}


function clearAll() {

	for (var n in filled) {


		document.getElementById( common.concat(filled[n]) ).value =  "";

	}
}





function showAnswer (){
	
	for (var n in filled) {


	document.getElementById( common.concat(filled[n]) ).value =  ans[ filled[n] ];

	}

	wrong_times += filled.length;

	alert("Here're the answers, note that you will not be awarded any scores since you have asked for solution.");
}

function checkAnswer() {

	var token = -1;

	for (var n in filled){

		if ( ans[ filled[n] ] != document.getElementById( common.concat(filled[n]) ).value ){

			token = filled[n];
		}
	}

	if (token != -1){

		var row = 1 + Math.floor ( token / 9 );
		
		var col = 1 + Math.floor ( token % 9 );

		alert("Opps, mistake NO." + wrong_times +": The entry in Row " + row + ", Col " + col + " is wrong, check again.");
		
		wrong_times++;
	}
	
	else if (token == -1  && submitted == 0 ) {
		
		var score = calculateScore( filled.length - wrong_times + 1 );
		
		alert("Congratulations, You won! Your score is: " + score + ". Click 'Update my Score' to update this score in our database.");
		
		document.getElementById("score").value = score;
		
		submitted = 1;

	}

	else {
		alert("You have already submitted. Click 'Update' button to update your score in our database.");
	}

}


function filling (x) {//fill the index of the blank numbers.

	filled.push(x);
}

function answering (y) {//convert php variable $anw{} into jscript variable ans().

	ans.push(y);
}


function updateInput() {//when you want to save a game, update the current user input into the element with id "input".
	
	var input = "";

	for (var i = 0; i < 81 ; i++) {

		if ( include(filled, i) ) {
			
			var acc = document.getElementById( common.concat( i )).value;

			if ( acc == "" ) {

				acc = "a";
			}

			input += acc;

		}

		else {
			input += 0;
		}
	}

	document.getElementById("input").value = input;

}

function include (arr, obj) {//helper function

	    return (arr.indexOf(obj) != -1);

}

function calculateScore (score) {

	var boundary = ["0", "10", "25", "50", "60", "81"];
	var new_score = 0;
	
	
	for (var i = 0; i < 5; i++) {

		if(score > boundary[i] && score <= boundary[i + 1]) {

			new_score += (score - boundary[i]) * Math.pow(2, i);
		}
		
		else if(score > boundary[i + 1]) {

			new_score += (boundary[i + 1] - boundary[i]) * Math.pow(2, i);

		}
	}

	return (score < 0) ? score : new_score;
}


