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
    var firstName = document.getElementById("input_name");
    var content = document.getElementById("input_content");

    fetch("/contact/sendFeedback", {
        method: "POST",
        headers: {
          "content-type": "application/json"
        },
        body: JSON.stringify({
            firstName: firstName.value,
            content: content.value
        })
    }).then(function(response) {
        return response.json()
        // window.location.replace("/about");
    }).then(function(json) {
        alert(json);
})
}