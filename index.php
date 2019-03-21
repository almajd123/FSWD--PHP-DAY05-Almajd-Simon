
<?php require_once 'actions/db_connect.php'; 
// Logged In
session_start();
if(isset($_SESSION["admin"]) == ""){
	header("Location: login.php");
	exit;
}


$res = mysqli_query($conn, "SELECT * FROM user WHERE user_ID =".$_SESSION['admin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<header class="header" class=""> 
      <h1>Admin Panel</h1>
      <nav>
        <ul id="ulflex">
          <li>Your logged in as: <?php echo $userRow['userName']; ?></li>
          <li><a href="logout.php?logout">Sign Out</a></li>
        </ul>
      </nav>
    </header><!-- /header -->

  <div class="manageData col-lg-9">
 <a href="create.php"><button type="button">Add Item</button></a>
 <table class="table">
   <thead>
     <tr>
      <th>Item ID</th>
      <th>Item Name</th>
      <th>Item Date</th>
      <th>Item Image</th>
      <th>Item Type</th>
      <th>Item Status</th>
      <th></th>
      <th></th>


    </tr>
  </thead>
  <tbody>
     <tbody>

   <?php

// Query SELECT Media_ID, Name, ISBN, Image, Descr, Publish_Date FROM media

   $sql = "SELECT items.item_ID, items.itemName, items.itemDate, status.statusName, type.typeName, items.itemImage
   FROM items
   INNER JOIN `status` ON items.fk_itemStatus = `status`.status_ID
   INNER JOIN type ON items.fk_itemType = type.type_ID;";

   $result = mysqli_query($conn, $sql);
   $rows = $result->fetch_all(MYSQLI_ASSOC);
// Fetch Data
   foreach ($rows as $val) {
    echo "<tr>
    <td>".$val["item_ID"]."</td>
    <td>".$val["itemName"]."</td>
    <td>".$val["itemDate"]."</td>
    <td><img class='images' src=".$val["itemImage"]."></td>
    <td>".$val["typeName"]."</td>
    <td>".$val["statusName"]."</td>
    <td><a class='btn btn-danger' href='update.php?id=".$val["item_ID"]."'>Edit</a></td>
    <td><a class='btn btn-danger' href='delete.php?id=".$val["item_ID"]."'>Delete</a></td>
    </tr>";
  }
 ?>


  </tbody>
</table>
</body>
</html>