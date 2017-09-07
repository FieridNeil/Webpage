<?php 
require_once("global_vars.php");
require_once($mysql_config_url);

$error = array();
// Get the post id sent from view_post
$id = $_GET['id'];

// Select that post 
$sql = "SELECT * FROM posts WHERE id = $id";
$retval = $conn->query($sql);
if(!$retval){
    echo "Error: " . $sql . "<br />" . $conn->error;
}

// Retrieve information about that post
$rows = $retval->fetch_assoc();
$cat_id = $rows['cat_id'];
$title = $rows['title'];
$content = $rows['content'];

// Get the associate category of that post
$sql = "SELECT * FROM category WHERE id = $cat_id";
$categories = $conn->query($sql);
if(!$categories){
    echo "Error: " . $sql . "<br />" . $conn->error;
}
$cat = $categories->fetch_assoc();
$cat_name = $cat['name'];

if($_POST['submit']){
    
    if(!isset($_POST['title']) || $_POST['title'] == ""){
        $error['Title'] = " cannot be blank";
    }else{
        $title = $conn->real_escape_string($_POST['title']);
    }
    
    // If user wants to create a new category
    if($_POST['category'] == "+ New Category"){
        if(isset($_POST['new_category']) AND $_POST['new_category'] != ""){
            $new_category = $_POST['new_category'];
        }

        $sql1 = "INSERT INTO `category` (name) VALUES ('$new_category') ON DUPLICATE KEY UPDATE name = name;";
        
        if(!$conn->query($sql1)){
            echo "Error: " . $sql . "<br />" . $conn->error;
        }
    }else{
        $new_category = $_POST['category'];
    }
    
    // Check for content to see if its blank
    if(!isset($_POST['content']) || $_POST['content'] == ""){
        $error['Content'] = " cannot be blank";
    }else{
        $content = $conn->real_escape_string($_POST['content']);
    }
    
    
    // If there are errors, good luck
    if($error){
        foreach($error as $key => $value){
            echo $key . " " . $value . "<br />";
        }
    }else{
        // Good to update database
        // Get the id of the category name
        $sql = "SELECT id FROM category WHERE name = '$new_category'";
        $row = $conn->query($sql);
        $cat_id = $row->fetch_assoc();
        $cid = $cat_id['id'];
        
        $sql = "UPDATE posts SET title = '$title', cat_id = $cid, content = '$content' WHERE id = $id";
        
        if($conn->query($sql) === TRUE){
            header('Location: view_entry.php?id=' . $id);
        }else{
            echo "Error: " . $sql . "<br />" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Create a new post</title>

    <link rel="stylesheet" href="styles.css" />    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="showhideformfield.js"></script>

</head>

<body>
    <h1>Create new post</h1>
    
    <div id="form">
        <table>
            <form action="edit.php?id=<?php echo $id; ?>" method= "POST">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"/></td>
                </tr>
                
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" id="category">
                            <option selected="selected"><?php echo $cat_name;
                            
                                    $sql = "SELECT * FROM category";
                                    $categories = $conn->query($sql);
                                    if(!$categories){
                                        echo "Error: " . $sql . "<br />" . $conn->error;
                                    }
                                    while($category = $categories->fetch_assoc()){
                                        if($category['name'] === $cat_name){
                                            continue;
                                        }
                                        echo "<option>";    
                                        echo $category['name'];
                                        echo "</option>"; 
                                    }
                            ?></option>

                        
                        </select>
                    </td>
                </tr>
                
                <tr id="new_category">
                    <td>New Category Name:</td>
                    <td><input type="text" name="new_category" /></td>
                </tr>

                <tr>
                    <td colspan="2">Content</td>
                    
                </tr>
                
                <tr>
                    <td colspan="2"><textarea cols="50" rows="10" name="content"><?php echo $content ?></textarea></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="submit" value="Submit" /></td>
                    <td><input type="reset" name="reset" value="Reset" /></td>
                </tr>
            </form>
        </table>
    </div>
        <a href="<?php echo $journal_url ?>">Return to journal homepage</a>
</body>
</html>
