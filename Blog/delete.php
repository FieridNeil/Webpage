<?php 
require_once("global_vars.php");
require_once($mysql_config_url);

$id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id = $id";



if(!$conn->query($sql)){
    echo "Error " . $sql . $conn->error;
}else{
    header('Location: view_posts.php');
}
?>