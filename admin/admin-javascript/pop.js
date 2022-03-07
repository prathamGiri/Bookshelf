window.onload = function() {
  var addbtn = document.getElementById("addButton");
  var table = document.getElementById("table");
  var newBook = document.getElementById("newBook");
  var listButton = document.getElementById("listButton");

  addbtn.onclick = function() {
    newBook.style.display = "block";
    listButton.style.display = "block";
    addbtn.style.display = "none";
    table.style.display = "none";
  };

  listButton.onclick = function() {
    table.style.display = "block";
    addbtn.style.display = "block";
    listButton.style.display = "none";
    newBook.style.display = "none";
  };
};  

//to make navbar responsive
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }

