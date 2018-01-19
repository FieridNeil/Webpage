<?php 

    include_once("generate_calendar.php");
    
    // Get current date, index 0 = month, 1 = day, 2 = year
        $current_date = explode('/', date('F/d/Y', time()), 3);
        echo "<pre>";
        var_dump($current_date);
        echo "</pre>";
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/card.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="test.js" type="text/javascript"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>

    <div class="container-fluid alert alert-primary">

        <div class="container alert alert-secondary">
            <div class="row">
                <div class="col-md-12 alert alert-warning">
                    <h1><?php echo $current_date[0] . " " . $current_date[2];?></h1>
                    <button name="prev_month" id="prev_month">Previous Month</button>
                    <button name="next_month" id="next_month">Next Month</button>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md alert alert-warning">Monday</div>
                <div class="col-md alert alert-warning">Tuesday</div>
                <div class="col-md alert alert-warning">Wednesday</div>
                <div class="col-md alert alert-warning">Thursday</div>
                <div class="col-md alert alert-warning">Friday</div>
                <div class="col-md alert alert-warning">Saturday</div>
                <div class="col-md alert alert-warning">Sunday</div>
            </div>
            
            <div id="calendar_body">
            
    <?php 
        generate_month($current_date[0],$current_date[2]);
        

    ?>
    
            </div>
    
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>