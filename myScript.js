$(document).ready(function() {
	addRow(2);
    $('.innercontainer').mouseenter(function() {
 		$(this).fadeTo('fast', 0.8);
 	});

 	$('.innercontainer').mouseleave(function() {
       	$(this).fadeTo('fast', 1.0);
    });
    
	reverseString("Testing");

});


function buttonClicked() {
	var num, text;
	num = document.getElementById("num").value;
	if(num == "" || isNaN(num) || num > 10 || num < 0){
		text = "Invalid Input!";
	}else {
		text = "Valid Input!";
	}
	document.getElementById("text").innerHTML = text;
	document.getElementById("num").value = ""
}

function addRow(numRows) {
	var contentContainer = document.getElementById("content");
	for (var i = 0; i < numRows; i++) {
		//add outerContainer

		var row1 = document.createElement('div');
		row1.setAttribute('class', 'innercontainer');
		row1.setAttribute('style', 'float: left; margin-left: 150px;');

		var row2 = document.createElement('div');
		row2.setAttribute('class', 'innercontainer');
		row2.setAttribute('style', 'float: right; margin-right: 160px;');

		//add inner containers to outer container
		var outerContainer = document.createElement('div');
		outerContainer.setAttribute('class', 'outercontainer');
		outerContainer.appendChild(row1);
		outerContainer.appendChild(row2);
		contentContainer.appendChild(outerContainer);
	};
}

function reverseString(string) {
	var output = document.getElementById("output");
	var reversed = "";
	for(var i=string.length-1; i >=0; i--) {
		reversed += string.charAt(i);
	}
	output.innerHTML = reversed;
}