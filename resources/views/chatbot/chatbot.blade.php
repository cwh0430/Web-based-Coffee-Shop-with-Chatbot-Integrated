<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css/chatbot.css') }}" rel="stylesheet">
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <link rel="stylesheet" href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js"></script>
</head>

<body style="min-width:375px;">

    <!-- chat open -->
    <div class="chat-bar-open" id="chat-open">
        <button id="chat-open-button" type="button" class=" close" onclick="chatOpen()">
            <i class="fa-regular fa-message"></i> </button>
    </div>

    <!-- chat close -->
    <div class="chat-bar-close" id="chat-close">
        <button id="chat-close-button" type="button" class=" close" onclick="chatClose()">
            <i class="fa-solid fa-xmark"></i> </button>
    </div>


    <!-- chat chat-window -->
    <div class="chat-window" id="chat-window">
        <div class="chat-window-header">
            <p>MyCoffee</p>
        </div>
        <div class="message-box" id="messageBox">
            <div class="first-chat">
                <img src="/img/chatbot-2.jpeg" alt="Profile Pic" class="circle">
                <p>Hi! I'm your coffee assistant today! Feel free to ask me anything.</p>
            </div>
        </div>
        <div class="input-box">
            <div class="write-reply">
                <input class="inputText" type="text" id="question" placeholder="Ask Anything..." required />
            </div>
            <div class="send-button">
                <button type="submit" class="send-message" id="send" onclick="userResponse()">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</body>



</html>