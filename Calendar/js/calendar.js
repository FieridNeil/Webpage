class Calendar{
  constructor(month, year){
    this.month = month;
    this.year = year;
  }

  // Display the days from mon -> sun
  ShowDays(){
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var container = document.getElementById('calendar_header');
    var ul = document.createElement("ul");
    for(var i = 0; i < 7; i++){
      var li = document.createElement("li");
      li.id = "day";
      var text = document.createTextNode(days[i]);
      li.appendChild(text);
      var ul = document.getElementById("calendar");
      ul.appendChild(li);
    }
  }

  // Calculate how many days in a given month
  daysInMonth () {
    return new Date(this.year, this.month, 0).getDate();
  }

  // Display every date in a given month
  ShowDates(){
    var day = 1;
    for(var i = 0; day <= this.daysInMonth(); i++){
      var li = document.createElement("li");
      if(new Date(this.year, this.month - 1, 1).getDay() - i > 0){
        li.id = "flex-item1";
        var node = document.createTextNode("");
      }else{
        li.id = "flex-item";
        var node = document.createTextNode(day);
        day++;
      }
      li.appendChild(node);
      var ul = document.getElementById("calendar");
      ul.appendChild(li);
    }
  }

  RemoveDates(){

  }

}
