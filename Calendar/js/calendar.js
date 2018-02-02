class Calendar {
  constructor(month, year) {
    this.month = month;
    this.year = year;
  }

  // Display the days from mon -> sun
  ShowDays() {
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var container = document.getElementById('calendar_header');
    var ul = document.createElement("ul");
    ul.id = "calendar";
    container.appendChild(ul);
    for (var i = 0; i < 7; i++) {
      var li = document.createElement("li");
      li.className = "day";
      var text = document.createTextNode(days[i]);
      li.appendChild(text);
      ul.appendChild(li);
    }
  }

  // Calculate how many days in a given month
  daysInMonth() {
    return new Date(this.year, this.month, 0).getDate();
  }

  // Display every date in a given month
  ShowDates() {
    var container = document.getElementById('calendar_body');
    var ul = document.createElement("ul");
    ul.id = "calendar";
    container.appendChild(ul);
    var day = 1;
    // Print out all the dates in a given month
    for (var i = 0; day <= this.daysInMonth(); i++) {
      var li = document.createElement("li");
      if (new Date(this.year, this.month - 1, 1).getDay() - i > 0) {
        li.className = "not_date";
        var node = document.createTextNode("");
      } else {
        li.className = "date";
        var node = document.createTextNode(day);
        day++;
      }
      li.appendChild(node);
      ul.appendChild(li);
    }

    // Fill the remaining empty spots on the last row if any
    var index = 6;
    while (index - new Date(this.year, this.month, 0).getDay() > 0) {
      var li = document.createElement("li");
      li.className = "not_date";
      var node = document.createTextNode("");
      li.appendChild(node);
      ul.appendChild(li);
      index--;
    }
  }

  RemoveDates() {
    var container = document.getElementById('calendar_body');
    container.removeChild(container.childNodes[1]);
  }


  CreateEvent(){

  }
}
