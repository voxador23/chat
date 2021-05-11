<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<link rel="stylesheet" href="style.css">

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyBQqUTK0WHgw_8WkdFmX93UmvJ2lEI8K80",
    authDomain: "v2chat-fed54.firebaseapp.com",
    projectId: "v2chat-fed54",
    storageBucket: "v2chat-fed54.appspot.com",
    messagingSenderId: "701460541413",
    appId: "1:701460541413:web:3bbb915bf2c19e2233890c"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  var myName = prompt("Unesi tvoje ime.")

  if (myName == null) return prompt("UKUCAJ IME DEBILU")

  function sendMessage() {
      var msg = document.getElementByClassName("message").value

      firebase.database().ref("messages").push().set({
          "sender": myName,
          "message": msg
      })

      return false
  }

  firebase.database().ref("messages").on("child_added", function(snapshot) {
        var html = ""
        html += "<li>"
           html += snapshot.val().sender + ": " + snapshot.val().message
        html += "</li>"

        document.getElementById("messages").innerHTML += html
      })
      function deleteMessage(self) {
    // get message ID
    var messageId = self.getAttribute("data-id");
 
    // delete message
    firebase.database().ref("messages").child(messageId).remove();
}
 
// attach listener for delete message
firebase.database().ref("messages").on("child_removed", function (snapshot) {
    // remove message node
    document.getElementById("message-" + snapshot.key).innerHTML = "This message has been removed";
});
</script>

<form onsubmit="return sendMessage()">
    <input class="message" type="text" placeholder="Enter a message.">

    <input class="button" type="submit">
</form>

<ul id="messages"></ul>
