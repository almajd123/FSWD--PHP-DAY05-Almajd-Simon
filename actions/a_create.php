<?php

require_once 'actions/db_connect.php'

if($_POST) {
    $itemname = $_POST['itemname'];
    $itemdate = $_POST['itemdate'];
    $itemimage = $_POST['itemimage'];
    $itemtype = $_POST['itemtype'];
    $itemstatus = $_POST['itemstatus'];

    $sql = "INSERT INTO items (item_ID, itemName, itemDate, itemImage, itemType, itemStatus) 
    VALUES (NULL,'$itemname', '$itemdate', '$itemimage', '$itemtype', '$itemstatus')";
    if($connect->query($sql) === TRUE){
     echo "<h1>New record created.</h1>";
     echo "<a href='../create.php'><button type='button'>Back</button></a>";
     echo "<a href='../index.php'><button type='button'>Home</button></a>";
 } else {
     echo "<h1>Record creation error for: </h1>" . 
     "<p>" . $sql . "</p>" . ' ' . mysqli_error($conn);
 }
 mysqli_close($conn);
}

?>