// function getdataBookking(){

// }

$("#book_rfid").keypress(function(event) {
  var keycode = event.keyCode ? event.keyCode : event.which;
  if (keycode == "13") {
    var book_rfid = document.getElementById("book_rfid").value;
    if (book_rfid.length == 10) {
      //  post
    }
  }
});
