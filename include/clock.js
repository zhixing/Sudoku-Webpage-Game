//This clock function was excerpted and modified from Code_snippets_collection, www.icodesnip.com.

var clockID = 0;
var init = new Date();
var start = init.getTime();

function UpdateClock() {
	
	if(clockID) {

clearTimeout(clockID);
		clockID  = 0;
       }
			  
	var now = new Date ();
	var nowtime = now.getTime();
	var sec = Math.floor((nowtime - start) / 1000);
	var min = Math.floor((sec / 60));
	var std = Math.floor((min / 60));
	sec = sec % 60;
	min = min % 60;
	if (sec < 10) sec = "0" + sec;
	if (min < 10) min = "0" + min;
	if (std < 10) std = "0" + std;
	document.myClock.time_spent.value = std + ":" + min + ":" + sec;
								   
	clockID = setTimeout("UpdateClock()", 100);
}

function StartClock() {
	        clockID = setTimeout("UpdateClock()", 100);
}

StartClock();


