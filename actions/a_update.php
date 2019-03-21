<?php

require_once 'db_connect.php';

if($_POST){
	$id = $_POST['id'];
	$itemname = mysqli_real_escape_string($conn, $_POST['itemname']);
	$itemdate = mysqli_real_escape_string($conn, $_POST['itemdate']);
	$itemimage = mysqli_real_escape_string($conn, $_POST['itemimage']);
	$itemtype = mysqli_real_escape_string($conn, $_POST['itemtype']);
	$itemstatus = mysqli_real_escape_string($conn, $_POST['itemstatus']);
	$sql = "UPDATE items SET itemName = '$itemname', itemDate = '$itemdate', itemImage = '$itemimage', fk_itemType = $itemtype, fk_itemStatus = $itemstatus WHERE item_ID = {$id}";

	if($conn->query($sql) === TRUE){
		echo "<p>Updated successfully</p>";
		echo "<a href='../index.php'><button>Home</button></a>";
	} else {
		echo "<p>Error while updating record : </p>" . $conn->error;
	}
}
?>