<?php 
require_once("global_vars.php");
require_once($mysql_config_url);

$title;
$content;
$error = array();

// Read in categories
$sql = "SELECT * FROM category ORDER BY id DESC";
$categories = $conn->query($sql);
if(!$categories){
    echo "Error: " . $sql . "<br />" . $conn->error;
}
    
if($_POST['submit']){
    // Check title to see if its blank 
    if(!isset($_POST['title']) AND $_POST['title'] == ""){
        $error['Title'] = " cannot be blank";
    }else{
        $title = $conn->real_escape_string($_POST['title']);
    }
    
    // If user does not choose a category, default it to be Uncategorized
    if(!isset($_POST['category']) OR $_POST['category'] == ""){
        while($rows = $categories->fetch_assoc()){
            if($rows['name'] === "Uncategorized"){
                $category = $rows['name'];
            }

        }
    }
    // If user wants to create a new category
    else if($_POST['category'] == "+ New Category"){
        if(isset($_POST['new_category']) AND $_POST['new_category'] != ""){
            $category = $_POST['new_category'];
        }

        $sql1 = "INSERT INTO `category` (name) VALUES ('$category') ON DUPLICATE KEY UPDATE name = name;";
        
        if(!$conn->query($sql1)){
            echo "Error: " . $sql . "<br />" . $conn->error;
        }
    }
    // User simply choose one of the existing categories
    else{
        $category = $_POST['category'];
    }
    
    // Check for content to see if its blank
    if(!isset($_POST['content']) AND $_POST['content'] == ""){
        $error['Content'] = " cannot be blank";
    }else{
        $content = $conn->real_escape_string($_POST['content']);
    }
    
    // Catch all errors if there are any
    if($error){
        foreach($error as $key => $value){
            echo $key . " " . $value . "<br />";
        }
    }
    // No errors, good to add into database
    else{
        
        $sql = "SELECT id FROM category WHERE name = '$category'";
        $row = $conn->query($sql);
        $cat_id = $row->fetch_assoc();
        $cid = $cat_id['id'];
        
        $sql2 = "INSERT INTO `posts` (cat_id, title, content, date_posted) VALUES ($cid, '$title', '$content', NOW());";

        
        if($conn->query($sql2) === TRUE){
            header('Location: ' . $journal_url);
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="showhideformfield.js"></script>
    <link rel="stylesheet" href="styles.css" />    

</head>

<body>
    <h1>Create new post</h1>
    
    <div id="form">
        <table>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "POST">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" /></td>
                </tr>
                
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="category">
                            <option selected="selected"></option>
                            <?php
  
                                while($category = $categories->fetch_assoc()){
                                        echo "<option>";    
                                        echo $category['name'];
                                        echo "</option>"; 
                                }
                                
                            ?>
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
                    <td colspan="2"><textarea cols="50" rows="10" name="content"></textarea></td>
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
