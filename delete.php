<?php 

require_once 'actions/db_connect.php';

if($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM items WHERE item_ID = {$id}";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();

   $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
   <title>Delete User</title>
</head>
<body>

<h3>Do you really want to delete this item?</h3>
<form action="actions/a_delete.php" method="post">

   <input type="hidden" name="id" value="<?php echo $row['item_ID'] ?>" />
   <button type="submit">Yes, delete it!</button>
   <a href="index.php"><button type="button">No, go back!</button></a>
</form>

</body>
</html>

<?php
}
?>