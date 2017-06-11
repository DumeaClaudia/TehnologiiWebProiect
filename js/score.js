function ajaxGet(url, cFunction) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            cFunction(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

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
    
    
    var answers_div = document.getElementById('game-answers'),
        answer_buttons = answers_div.getElementsByTagName('button'),
        next_div = document.getElementById('next-level'),
        length = answer_buttons.length,
        i = 0;
    
    for (i = 0; i < length; i = i + 1) {
        answer_buttons[i].addEventListener('click', function (e) {
            var answer_text = this.textContent;
            var question = document.getElementById("vip-img").alt;
                console.log(question);
            ajaxGet("check_answer.php?q="+encodeURIComponent(question)+"&a="+encodeURIComponent(answer_text), function (resp) {
               

                document.getElementById('answer-feedback').innerHTML = resp.responseText;
                answers_div.style.display = "none";
                next_div.style.display = "block";
            });
           
        });
    }
    
    document.getElementById('next-button').addEventListener('click', function () {
        next_div.style.display = "none";
        answers_div.style.display = "block";
        location.reload(true);
    });
    
    
});