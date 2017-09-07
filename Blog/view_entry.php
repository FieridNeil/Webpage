<?php 
require_once("global_vars.php");
require_once($mysql_config_url);

if(!isset($_GET['id'])){
    echo "Cannot retrieve id";
}else{
    $post_id = $_GET['id'];
}

$sql = "SELECT * FROM posts WHERE id = $post_id";
$retval = $conn->query($sql);
if(!$retval){
    echo "Error: " . $sql . "<br />" . $conn->error;
}

$sql = "SELECT * FROM category";
$categories = $conn->query($sql);
$category = $categories->fetch_assoc();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Entry</title>
</head>

<body>

<?php 
    $post = $retval->fetch_assoc();
    echo "Title: " . $post['title'] .  "<br />";
    foreach($categories as $category){
            if($post['cat_id'] == $category['id']){
                echo "Category: " . $category['name'] . "  <br />";
            }
    }
    echo "Content:<br />";
    echo $post['content'] . "<br />";
    echo "Date posted: " . $post['date_posted'] . "<br />";
    echo "<a href= \"edit.php?id=" . $post['id'] . "\">Edit</a>&nbsp&nbsp&nbsp&nbsp<a href = \"delete.php?id=" . $post['id'] . "\">Delete</a><br />";
?>

<a href="view_posts.php">Back to view posts</a>
</body>
</html>
