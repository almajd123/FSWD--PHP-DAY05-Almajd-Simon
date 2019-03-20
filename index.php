
<?php require_once 'actions/db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
    <td><a class='btn btn-danger' href='admin_panel.php?id=".$val["item_ID"]."'>Edit</a></td>
    <td><a class='btn btn-danger' href='admin_panel.php?id=".$val["item_ID"]."'>Delete</a></td>
    </tr>";
  }
// Insert Record Media

  if (isset($_POST["submit"])) {
    $itemname = mysqli_real_escape_string($conn, $_POST['itemname']);
    $itemdate = mysqli_real_escape_string($conn, $_POST['itemdate']);
    $itemimage = mysqli_real_escape_string($conn, $_POST['itemimage']);
    $itemtype = mysqli_real_escape_string($conn, $_POST['itemtype']);
    $itemstatus = mysqli_real_escape_string($conn, $_POST['itemstatus']);

    $sql = "INSERT INTO items (item_ID, itemName, itemDate, itemImage, itemType, itemStatus) 
    VALUES (NULL,'$itemname', '$itemdate', '$itemimage', '$itemtype', '$itemstatus')";
    if (mysqli_query($conn, $sql)) {
     echo "<h1>New record created.</h1>";
   } else {
     echo "<h1>Record creation error for: </h1>" . 
     "<p>" . $sql . "</p>" . 
     mysqli_error($conn);
   }
   mysqli_close($conn);
 }

 ?>


  </tbody>
</table>
</body>
</html>