var month = new Date().getMonth() + 1; // Month used based 0 so month 0 = jan

var year = new Date().getFullYear();


var c =  new Calendar(month, year);

c.ShowDays();
c.ShowDates();


var next_month = document.getElementById('next_month');
next_month.addEventListener('click', GetNextMonth);

function GetNextMonth(){
  c.RemoveDates();
  month++;
  c =  new Calendar(month, year);
  c.ShowDates();
}


var prev_month = document.getElementById('prev_month');
prev_month.addEventListener('click', GetPrevMonth);

function GetPrevMonth(){
  c.RemoveDates();
  month--;
  c =  new Calendar(month, year);
  c.ShowDates();
}



// Add click event delegate to each date in the calendar
//childNodes returns a list of child and childnodes[1] returns the ul which is what we want
document.getElementById('calendar_body').childNodes[1].addEventListener('click',
function(e){
  if(e.target && e.target.matches("li.date")){
    console.log("date is clicked");
  }
});
