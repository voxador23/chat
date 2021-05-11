<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-database.js"></script>
<link rel = "stylesheet" href  = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>    
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   
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

  function sendMessage() {
      var msg = document.getElementById("message").value

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
    <input id="message" type="text" placeholder="Enter a kurac.">

    <input class="button" type="submit">
</form>

<ul id="messages"></ul>
