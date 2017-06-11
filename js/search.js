'use strict';

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

    var score_table = document.getElementById('score-table');
    document.getElementsByName('search-smth')[0].addEventListener('input', function (e) {
        ajaxGet("search.php?q="+e.target.value, function (resp) {
            
            var users = JSON.parse(resp.responseText),
                users_len = users.length,
                i = 0,
                row,
                name_col;
            
            /* clear table */
            while (score_table.hasChildNodes()) {
                score_table.removeChild(score_table.lastChild);
            }
            /* add header */
            var header = document.createElement("tr");
            name_col = document.createElement("th");
            name_col.innerHTML = "Name";
            header.appendChild(name_col);

            name_col = document.createElement("th");
            name_col.innerHTML = "Score";
            header.appendChild(name_col);

            name_col = document.createElement("th");
            name_col.innerHTML = "Games played";
            header.appendChild(name_col);

            score_table.appendChild(header);

            /* add result */

            for (i = 0; i < users_len; i += 1) {
                row = document.createElement("tr");
            
                name_col = document.createElement("td");
                name_col.innerHTML = users[i].name; 
                row.appendChild(name_col);
                
                name_col = document.createElement("td");
                name_col.innerHTML = users[i].score;
                row.appendChild(name_col);
                
                name_col = document.createElement("td");
                name_col.innerHTML = users[i].games;
                row.appendChild(name_col);
               
                score_table.appendChild(row);
            }
            console.log(resp.responseText);
            console.log(resp); 
        });
    });


});