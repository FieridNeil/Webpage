<?php 

$request_uri = explode('/calendar', $_SERVER['REQUEST_URI'], 2);
echo "<pre>";
var_dump($request_uri);
echo "</pre>";



switch($request_uri[1]){
    case '/':
    case ' ':
    case '/home.php':
        Header("Location: home.php");
        break;
    
    default:
        Header("Location: 404.html");
}

?>