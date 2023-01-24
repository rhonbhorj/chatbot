<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Rubik&display=swap");

    /* Center body contents, both horizontally and vertically */
    body {
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Rubik", sans-serif;
    }

    /* Style the outer container. Centralize contents, both horizontally and vertically */
    #bot {
      margin: 50px 0;
      height: 700px;
      width: 450px;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.2);
      border-radius: 20px;
    }

    /* Make container slightly rounded. Set height and width to 90 percent of .bots' */
    #container {
      height: 90%;
      border-radius: 6px;
      width: 90%;
      background: #f3f4f6;
    }

    /* Style header section */
    #header {
      width: 100%;
      height: 10%;
      border-radius: 6px;
      background: #3b82f6;
      color: white;
      text-align: center;
      font-size: 2rem;
      padding-top: 12px;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style body */
    #body {
      width: 100%;
      height: 75%;
      background-color: #f3f4f6;
      overflow-y: auto;
    }

    /* Style container for user messages */
    .userSection {
      width: 100%;
    }

    /* Seperates user message from bot reply */
    .seperator {
      width: 100%;
      height: 50px;
    }

    /* General styling for all messages */
    .messages {
      max-width: 60%;
      margin: 0.5rem;
      font-size: 1.2rem;
      padding: 0.5rem;
      border-radius: 7px;
    }

    /* Targeted styling for just user messages */
    .user-message {
      margin-top: 1rem;
      text-align: left;
      background: #3b82f6;
      color: white;
      float: left;
    }

    /* Targeted styling for just bot messages */
    .bot-reply {
      text-align: right;
      background: #e5e7eb;
      margin-top: 1rem;
      float: right;
      color: black;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style the input area */
    #inputArea {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 10%;
      padding: 1rem;
      background: transparent;
    }

    /* Style the text input */
    #userInput {
      height: 20px;
      width: 80%;
      background-color: white;
      border-radius: 6px;
      padding: 1rem;
      font-size: 1rem;
      border: none;
      outline: none;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style send button */
    #send {
      height: 50px;
      padding: 0.5rem;
      font-size: 1rem;
      text-align: center;
      width: 20%;
      color: white;
      background: #3b82f6;
      cursor: pointer;
      border: none;
      border-radius: 6px;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
  <div id="bot">
    <div id="container">
      <div id="header">Online Chatbot App</div>

      <div id="body">
        <!-- This section will be dynamically inserted from JavaScript -->
        <div class="userSection">
          <div class="messages user-message"></div>
          <div class="seperator"></div>
        </div>
        <div class="botSection">
          <div class="messages bot-reply"></div>
          <div class="seperator"></div>
        </div>
      </div>

      <div id="inputArea">
        <input type="text" name="messages" id="userInput" placeholder="Please enter your message here" required />
        <input type="submit" id="send" value="Send" />
      </div>
    </div>
  </div>
  <script type="text/javascript">
    // When send button gets clicked
    document.querySelector("#send").addEventListener("click", async () => {
      // create new request object. get user message
      let xhr = new XMLHttpRequest();
      var userMessage = document.querySelector("#userInput").value;

      // create html to hold user message.
      let userHtml =
        '<div class="userSection">' +
        '<div class="messages user-message">' +
        userMessage +
        "</div>" +
        '<div class="seperator"></div>' +
        "</div>";

      // insert user message into the page
      document.querySelector("#body").innerHTML += userHtml;

      // open a post request to server script. pass user message as parameter
      xhr.open("POST", "query.php");
      xhr.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhr.send(`messageValue=${userMessage}`);

      // When response is returned, get reply text into HTML and insert in page
      xhr.onload = function() {
        let botHtml =
          '<div class="botSection">' +
          '<div class="messages bot-reply">' +
          this.responseText +
          "</div>" +
          '<div class="seperator"></div>' +
          "</div>";

        document.querySelector("#body").innerHTML += botHtml;
      };
    });
  </script>
</body>

</html>