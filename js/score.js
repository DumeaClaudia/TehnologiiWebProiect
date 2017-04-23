document.addEventListener("DOMContentLoaded", function (event) {
    'use strict';
    
    document.getElementById('showHideContainer').addEventListener('click', function () {
        var divTest = document.getElementById('hideaway');
        if (divTest.style.display === "none") {
            divTest.style.display = 'block';
        } else {
            divTest.style.display = "none";
        }
    });
    
    
    var answers_div = document.getElementById('game-answers')
    var answer_buttons = answers_div.getElementsByTagName('button');
    var next_div = document.getElementById('next-level');
    var length =  answer_buttons.length, i = 0;
    
    for (i = 0; i < length; i = i + 1) {
        answer_buttons[i].addEventListener('click', function(e) {
            var answer_text = this.textContent; 
            document.getElementById('answer-feedback').innerHTML = "Raspunsul tau " + answer_text + " nu este corect.";
            answers_div.style.display= "none";
            next_div.style.display = "block";
        });
    }
    
    document.getElementById('next-button').addEventListener('click', function(){
         next_div.style.display = "none";
         answers_div.style.display= "block";
        
    });
    
    
});