
// Get the modal
var modal = document.getElementById("editModal");

// Get the button that opens the modal
var btn = document.getElementById("editLink");
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// if the user clicks outside of the modal, close the modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}