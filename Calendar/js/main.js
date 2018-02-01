var month = new Date().getMonth() + 1; // Month used based 0 so month 0 = jan
console.log(month);
var year = new Date().getFullYear();
console.log(year);

var c =  new Calendar(month, year);

c.ShowDays();
c.ShowDates();

var next = document.getElementById('next_month').addEventListener('click', GetNextMonth);

function GetNextMonth(){
  month += 1;
  var c =  new Calendar(month, year);

  c.ShowDays();
  c.ShowDates();
}

// Add click event delegate to each date in the calendar
document.getElementById('calendar').addEventListener('click',
function(e){
  if(e.target && e.target.matches("li#flex-item")){
    console.log("date is clicked");
  }
});
