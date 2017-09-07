<?php 
require_once("global_vars.php");
require_once($mysql_config_url);

$sql = "SELECT * FROM category";
$categories = $conn->query($sql);
// Edit a category name
if(isset($_GET['type']) AND $_GET['type'] == "edit"){
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
        if(isset($_POST['new_cat']) AND $_POST['new_cat'] != ""){
            $cat = $_POST['new_cat'];
            $sql = "UPDATE category SET name = '$cat' WHERE id = $id";
            if(!$conn->query($sql)){
                echo "Error: " . $sql . "<br />" . $conn->error;
            }else{
                echo "Changed";
                //Refresh page
                header('Location: manage_categories.php');
            }
        }
    }
}

// Delete a category
if(isset($_GET['type']) AND $_GET['type'] == "delete"){
    $id = $_GET['id'];
    $sql = "DELETE FROM category WHERE id = $id";
    if(!$conn->query($sql)){
        echo "Error: " . $sql . "<br />" . $conn->error;
    }else{
        //Refresh page
        header('Location: manage_categories.php');
    }
}


// Create new category
if(isset($_GET['type']) AND $_GET['type'] == "add"){
    if(isset($_POST['submit'])){
        if(isset($_POST['new_cat']) AND $_POST['new_cat'] != ""){
            $cat = $_POST['new_cat'];
            $sql = "INSERT INTO category (name) VALUES ('$cat') ON DUPLICATE KEY UPDATE name = name;";
            if(!$conn->query($sql)){
                echo "Error: " . $sql . "<br />" . $conn->error;
            }else{
                //Refresh page
                header('Location: manage_categories.php');
            }
        }
    }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Manage Categories</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="test.js"></script>
</head>

<body>

<h1>Manage Categories</h1>
<h3>List of current categories: </h3>

                    <ul>
    <?php 
        $counter = 0;
        while($category = $categories->fetch_assoc()){
        if($category['name'] === "+ New Category"){
            continue;
        }
    ?>


                    <li>
                        <?php echo $category['name']?>&nbsp;
                        <a id="link<?php echo $counter ?>" href="manage_categories.php?type=edit&id=<?php echo $category['id'];?>">Edit</a>&nbsp;&nbsp; 
                        <a href="manage_categories.php?type=delete&id=<?php echo $category['id'];?>">Delete</a>
                    </li>
 

<div id="edit_form<?php echo $counter ?>">
    <form action="manage_categories.php?type=edit&id=<?php echo $category['id'];?>" method="POST">

 
            New category name:
            <input type="text" name="new_cat" />
            <input type="submit" name="submit" value="Change" />
            


    </form>
</div>

               </ul>
 
    <?php
    $counter++; 
    }
        
    ?>

    <form action="manage_categories.php?type=add" method="POST">

            <a href="manage_categories.php?type=add">Add New Category</a>



            New category name: 
            <input type="text" name="new_cat" />
            <input type="submit" name="submit" value="Add" />

    </form>



<a href="<?php echo $journal_url ?>">Return to journal homepage</a>
</body>
</html>
