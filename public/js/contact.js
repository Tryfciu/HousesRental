"use strict";

window.onload = function()
{
    addEventListeners();
}

function addEventListeners()
{
    document.getElementById("button_submit").addEventListener("click", sendFeedbackMessage);
}

function sendFeedbackMessage()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    }
    xhttp.open("POST", "/contact/sendFeedback");
    xhttp.send();
}