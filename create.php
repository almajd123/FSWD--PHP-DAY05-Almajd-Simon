<?php require_once 'actions/db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <div class="col-lg-3">
    <h2>Add Item Here</h2>
    <form class="form-horizontal" action="actions/a_create.php" method="POST">

      <div class="form-group">
        <label class="control-label col-sm-2">Item Name</label>
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
           <?php 
           $sql = "SELECT * from `type`;";
           $result = mysqli_query($conn, $sql);
           $rows = $result->fetch_all(MYSQLI_ASSOC);

           foreach ($rows as $row) {
            echo "<option value='".$row['type_ID']."'>".$row['typeName']."</option>";
          }
          ?>   

        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Item Status</label>
      <div class="col-sm-10">
        <select name="itemstatus"> 
          <?php 
          $sql = "SELECT * from `status`;";
          $result = mysqli_query($conn, $sql);
          $rows = $result->fetch_all(MYSQLI_ASSOC);

          foreach ($rows as $row) {
            echo "<option value='".$row['status_ID']."'>".$row['statusName']."</option>";
          }
          ?>   
        </select>
      </div>
    </div>
    <button type="submit">Insert Item</button>
    <a href="index.php"><button type="button">Back</button>
    </body>
    </html>