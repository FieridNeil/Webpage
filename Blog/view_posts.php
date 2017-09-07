<?php 
require_once("global_vars.php");
require_once($mysql_config_url);

// Get number of posts
$sql = "SELECT * FROM posts ORDER BY date_posted DESC";
$posts = $conn->query($sql);
$number_of_posts = $posts->num_rows;

$sql = "SELECT * FROM category";
$categories = $conn->query($sql);
$category = $categories->fetch_assoc();

// Get the current page, default to 0
$current_page = $_GET['page'];
if(!isset($current_page)){
    $current_page = 0;
}

// Set how many posts per page
$limit = 5;

// Determine posts per page
$pages = $number_of_posts / $limit;

// Prevent user from manually enter page 99 or -5 in the url
if($current_page > $pages + 1){
    $current_page = $pages;
}else if($current_page < 1){
    $current_page = 1;
}

// Calculate offset 
$offset = $limit * ($current_page - 1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Posts</title>
</head>

<body>
    <h1>Entries</h1>
    <hr />

    <div>
    <?php 
    $sql = "SELECT * FROM posts LIMIT $offset, $limit";
    $posts = $conn->query($sql);
    if(!$posts){
        echo "Error: " . $sql . "<br />" . $conn->error;
    }
    while($post = $posts->fetch_assoc()){
        echo "Title: " . $post['title'] . "<br />";
        
        // Get category associates with current post
        foreach($categories as $category){
            if($post['cat_id'] == $category['id']){
                echo "Category: " . $category['name'] . "  <br />";
            }
        }

        echo "Content: <br />" . substr($post['content'], 0, 100) . " <a href=\"view_entry.php?id={$post['id']}\">...</a><br />";
        echo "Date posted: " .$post['date_posted'] . "<br />";
        echo "<a href= \"edit.php?id=" . $post['id'] . "\">Edit</a>&nbsp&nbsp&nbsp&nbsp<a href = \"delete.php?id=" . $post['id'] . "\">Delete</a><br />";
        echo "<br />";
    }
    $page = 1;
    while($page < $pages + 1){
        echo "<a href=\"view_posts.php?page=" .$page . "\">" . $page . "</a> &nbsp&nbsp&nbsp&nbsp";
        $page++;
    }

    ?>
    </div>
    <a href="<?php echo $journal_url ?>">Return to journal homepage</a>
</body>
</html>

<?php
    $posts->free()
?>