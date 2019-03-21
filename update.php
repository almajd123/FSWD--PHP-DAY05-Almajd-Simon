<?php 

require_once 'actions/db_connect.php';

if($_GET['id']) {
	$id = $_GET['id'];

	$sql = "SELECT * FROM items WHERE item_ID = {$id}";
	$result = $conn->query($sql);

	$row = $result->fetch_assoc();


	?>

	<div class="col-lg-3">
		<h2>Edit Item Here</h2>
		<form class="form-horizontal" action="actions/a_update.php" method="POST">

			<div class="form-group">
				<label class="control-label col-sm-2">Item Name</label>
				<div class="col-sm-10">
					<input type="name" class="form-control" name="itemname" value="<?php 
					echo $row['itemName']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Item Date</label>
				<div class="col-sm-10">          
					<input type="date" class="form-control" name="itemdate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php 
					echo $row['itemDate']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Item Image URL</label>
				<div class="col-sm-10">          
					<input type="" class="form-control" placeholder="https://examplelink" name="itemimage" value="<?php 
					echo $row['itemImage']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Item Type</label>
				<div class="col-sm-10">          
					<select name="itemtype">
						<?php 
						$sql1 = "SELECT * from `type`;";
						$result1 = mysqli_query($conn, $sql1);
						$rows1 = $result1->fetch_all(MYSQLI_ASSOC);

						foreach ($rows1 as $row1) {
							echo "<option value='".$row1['type_ID']."'>".$row1['typeName']."</option>";
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
						$sql2 = "SELECT * from `status`;";
						$result2 = mysqli_query($conn, $sql2);
						$rows2 = $result2->fetch_all(MYSQLI_ASSOC);

						foreach ($rows2 as $row2) {
							echo "<option value='".$row2['status_ID']."'>".$row2['statusName']."</option>";
						}
						?>   
					</select>
				</div>
			</div>

			<input type="hidden" name="id" value="<?php echo $row['item_ID']?>">
			<button type="submit">Save Changes</button>
			<a href="index.php"><button type="button">Back</button></a>
		</form>
	</div>
	<?php
}
?>