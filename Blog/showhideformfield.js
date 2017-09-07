$(document).ready(function () {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
    toggle();
    //this will call our toggleFields function every time the selection value of our category field changes
    $("#category").change(function () {
        toggleFields();
    });
    //$("#toggle").hide();


});

// Toggle on off new input field when editing a post and wanting to add a new category
function toggleFields() {
    //Controls fields in create_new_post.php
    if ($("#category").val() === "+ New Category")
        $("#new_category").show();
    else
        $("#new_category").hide();
        

}
