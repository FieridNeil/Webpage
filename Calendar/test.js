var next_month = document.getElementById("next_month");
var prev_month = document.getElementById("prev_month");

$(document).ready(function(){
    $("#prev_month").click(function(){
        console.log("Prev_month button is clicked");
        var date = new Date($.now());
        console.log(date);
    });
    
    $("#next_month").click(function (){
        console.log("Next_month button is clicked");
    });
})