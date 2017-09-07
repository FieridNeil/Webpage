<?php 
    
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "hoanghiepp";
    $db_name = "journal";
    
    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_pass);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    
    // Select database
    $conn->select_db($db_name);
    
    if($conn->connect_error){
        die("Cannot select database" . $conn->connect_error);
    }
    //echo "Database selected";
    
    

?>