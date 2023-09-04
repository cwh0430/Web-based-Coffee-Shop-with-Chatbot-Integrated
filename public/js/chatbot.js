function chatOpen() {
    document.getElementById("chat-open").style.display = "none";
    document.getElementById("chat-close").style.display = "block";
    document.getElementById("chat-window").style.display = "block";
}
function chatClose() {
    document.getElementById("chat-open").style.display = "block";
    document.getElementById("chat-close").style.display = "none";
    document.getElementById("chat-window").style.display = "none";
}
function openConversation() {
    document.getElementById("chat-window").style.display = "none";
}

//Gets the text from the input box(user)
function userResponse() {
    let userQuestion = document.getElementById("question").value;

    document.getElementById(
        "messageBox"
    ).innerHTML += `<div class="second-chat">
        <p>${userQuestion}</p>
      </div>`;

    document.getElementById("question").value = "";
    var objDiv = document.getElementById("messageBox");
    objDiv.scrollTop = objDiv.scrollHeight;

    setTimeout(() => {
        openAIResponse(userQuestion);
    }, 1000);
}

//admin Respononse to user's message
function openAIResponse(userQuestion) {
    showLoadingIndicator();
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    $.ajax({
        url: "/embeddings",
        type: "POST",
        data: {
            _token: csrfToken,
            question: userQuestion,
        },
        success: function (response) {
            hideLoadingIndicator();
            document.getElementById(
                "messageBox"
            ).innerHTML += `<div class="first-chat">
            <img src="/img/chatbot-2.jpeg" alt="Profile Pic" class="circle" id="circle-mar">
            <p>${response.answer}</p>
          </div>`;

            var objDiv = document.getElementById("messageBox");
            objDiv.scrollTop = objDiv.scrollHeight;
        },
        error: function (xhr, status, error) {
            // Handle error
            console.log(error);
        },
    });
}

function showLoadingIndicator() {
    document.getElementById(
        "messageBox"
    ).innerHTML += `<div class="first-chat loading-indicator-container">
    <img src="/img/chatbot-2.jpeg" alt="Profile Pic" class="circle" id="circle-mar">
        <p>
        <span class="jumping-dots">
        <span class="dot-1"></span>
        <span class="dot-2"></span>
        <span class="dot-3"></span>
    </span>
        </p>
    </div>`;
}

function hideLoadingIndicator() {
    var loadingIndicator = document.querySelector(
        ".first-chat.loading-indicator-container"
    );
    if (loadingIndicator) {
        loadingIndicator.parentNode.removeChild(loadingIndicator);
    }
}

//press enter on keyboard and send message
addEventListener("keypress", (e) => {
    if (e.keyCode === 13) {
        const e = document.getElementById("question");
        if (e === document.activeElement) {
            userResponse();
        }
    }
});
