<!-- // DB Connection -->


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">
  

  <header id="header" class=""> 
    <h1>Admin Panel</h1>
    <nav>
      <ul id="ulflex">
        <li>Hello <?php echo $userRow['userName']; ?></li>
        <li><a href="logout.php?logout">Sign Out</a></li>
      </ul>
    </nav>
  </header><!-- /header -->

 
    <div class="col-lg-3">
      <h2>Add Item Here</h2>
      <form class="form-horizontal" action="" method="POST">
        <div class="form-group">
          <label class="control-label col-sm-2">Item Name</label>
          <?php 
          // echo '<input type="" name="id" value="'. $row['bookname'].'">';
          // echo'<input type="hidden" name="id" id="name" value="'. $row['Media_ID'].'">';
          ?>
          <div class="col-sm-10">
            <input type="name" class="form-control" name="itemname">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Item Date</label>
          <div class="col-sm-10">          
            <input type="date" class="form-control" name="itemdate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Item Image URL</label>
          <div class="col-sm-10">          
            <input type="" class="form-control" placeholder="https://examplelink" name="itemimage">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Item Type</label>
          <div class="col-sm-10">          
               <select name="itemtype">     
             <option value="1">Phone</option>
             <option value="2">TV</option>
             <option value="3">PC</option>
             <option value="4">Laptop</option>
           </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Item Status</label>
          <?php 
          // echo '<input type="" name="id" value="'. $row['publisher'].'">';
          // echo'<input type="hidden" name="id" id="name" value="'. $row['Media_ID'].'">';
          ?>
          <div class="col-sm-10">     
            <select name="itemstatus">     
             <option value="1">Availables</option>
             <option value="2">Not Available</option>
           </select>
         </div>
       </div>
     </div>
    



      <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" name="submit">Submit</button>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" name="submit3">Update</button>
        </div>
      </div>
    </form>






    <div class="manageData col-lg-9">
     <!-- <a href="create.php"><button type="button">Add User</button></a> -->
     <table class="table">
       <thead>
         <tr>
          <th>Item ID</th>
          <th>Item Name</th>
          <th>Item Date</th>
          <th>Item Image</th>
          <th>Item Type</th>
          <th>Item Status</th>


        </tr>
      </thead>
      <tbody>

       <?php
       // Connection Data
       $servername = "localhost";
       $username   = "root";
       $password   = "moony#1423"; 
       $dbname     = "admin_panel_exercise";
// Create connection
       $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
       if (!$conn) {
         die("Connection failed: " . mysqli_connect_error() . "\n");
       } else {
                // echo "Works!";
       }
// Query SELECT Media_ID, Name, ISBN, Image, Descr, Publish_Date FROM media

       $sql = "SELECT items.item_ID, items.itemName, items.itemDate, status.statusName, type.typeName, items.itemImage
       FROM items
       INNER JOIN status ON items.itemStatus = status.status_ID
       INNER JOIN type ON items.itemType = type.type_ID";
       $result = mysqli_query($conn, $sql);
       $rows = $result->fetch_all(MYSQLI_ASSOC);
// Fetch Data
       foreach ($rows as $val) {
        echo "<tr>
        <td>".$val["item_ID"]."</td>
        <td>".$val["itemName"]."</td>
        <td>".$val["itemDate"]."</td>
        <td><img class='images' src=".$val["itemImage"]."></td>
        <td>".$val["statusName"]."</td>
        <td>".$val["typeName"]."</td>
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

// Insert Address Into Database!
      /* if (isset($_POST["submit2"])) {
        $address = mysqli_real_escape_string($conn, $_POST['street']);
        $zip = mysqli_real_escape_string($conn, $_POST['zipcode']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $sql = "INSERT INTO address (`Address_ID`, `Street`, `ZIP-Code`, `City`, `Country`) VALUES (NULL, '$address', '$zip', '$city', '$country')";
        if (mysqli_query($conn, $sql)) {
         echo "<h1>New record created.</h1>";
       } else {
         echo "<h1>Record creation error for: </h1>" . 
         "<p>" . $sql . "</p>" . 
         mysqli_error($conn);
       }
       mysqli_close($conn);
     } */
// Delete Function
     if(isset($_GET["id"])){
      $id= $_GET["id"];
      $sql = "DELETE FROM items WHERE item_ID = $id";
      mysqli_query($conn, $sql);
    };


/*
    if(isset($_GET['id'])) {
     $id = $_GET['id'];
     $sql = "SELECT * FROM media WHERE Media_ID = $id";
     $result = mysqli_query($conn, $sql);

     $row = mysqli_fetch_assoc($result);
     // echo "bookname :" . $row["bookname"];
   };
*/
   // $connect->close();


/*
   if (isset($_POST["submit3"])){
    $id= $_POST["id"];
    $name = mysqli_real_escape_string($conn, $_POST['newname']);
    $sql = "UPDATE `media` SET bookname = '$bookname' WHERE Media_ID = $id"; 
    if (mysqli_query($conn, $sql)) {
     echo "<h1>record updated.<h1>";
   } else {
     echo "<h1>Update error for: </h1>" . 
     "<p>" . $sql . "</p>" . mysqli_error($conn);
   } 
 };
//Edit End
*/
   // $connect->close();

//Logged In
 if( !isset($_SESSION['user']) ) {
 header("Location: admin_panel.php");
 exit;
}
// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM user WHERE user_ID=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>


 ?>
</tbody>
</table>

</div>

</div>



</body>
</html>