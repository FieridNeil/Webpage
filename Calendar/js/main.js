var month = new Date().getMonth() + 1; // Month used based 0 so month 0 = jan
var year = new Date().getFullYear();


var c = new Calendar(month, year);
c.ShowDays();
c.ShowDates();

// Display next month
document.getElementById('next_month').addEventListener('click', function() {
  c.RemoveDates();
  month++;
  c = new Calendar(month, year);
  c.ShowDates();
});

// Display previous month
document.getElementById('prev_month').addEventListener('click', function() {
  c.RemoveDates();
  month--;
  c = new Calendar(month, year);
  c.ShowDates();
});




// Add click event delegate to each date in the calendar
//childNodes returns a list of child and childnodes[1] returns the ul which is what we want
document.getElementById('calendar_body').childNodes[1].addEventListener('click',
  function(e) {
    if (e.target && e.target.matches("li.date")) {
      console.log("date is clicked");
    }
  });






  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function() {
      modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  } 
