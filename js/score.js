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
    
});