<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
	header("Location: home.php");
	exit;
}

if ( isset($_SESSION['admin'])!="" ) {
	header("Location: index.php");
	exit;
}
$error = false;

if( isset($_POST['btn-signin']) ) {

 // prevent sql injections/ clear user invalid inputs
	$name = trim($_POST['name']);
	$name = strip_tags($name);
	$name = htmlspecialchars($name);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

	if(empty($name)){
		$error = true;
		$nameError = "Please enter your username.";
	} 

	if(empty($pass)){
		$error = true;
		$passError = "Please enter your password.";
	}

 // if there's no error, continue to login
	if (!$error) {

  $password = hash('sha256', $pass); // password hashing

  $res=mysqli_query($conn, "SELECT user_ID, email, userPassword,rules FROM user WHERE userName='$name'");
  $row = $res->fetch_assoc();
  $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row
  
  if( $count == 1 && $row['userPassword']==$password ) {
  	// admin login
  	if($row["rules"] == "admin"){
  		$_SESSION['admin'] = $row['user_ID'];
  		header("Location : index.php");
  	} else {
  		// user login
  		$_SESSION['user'] = $row['user_ID'];
  		header("Location: home.php");
  	}
  	
  } else {
  	$errMSG = "Incorrect Credentials, Try again...";
  }
  
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
<header class="header" class="">
	<h1>Login</h1>
</header><!-- /header -->

	

	<?php
	if ( isset($errMSG) ) {
		echo $errMSG; ?>

		<?php
	}
	?>

	<form class="form" method="POST">
		<input type="text" name="name" value="" placeholder="Insert Username"><br>
		<span><?php echo $nameError; ?></span>
		<input type="password" name="pass" placeholder="Insert Password"><br>
		<span><?php echo $passError; ?></span>
		<button type="submit" class="btn btn-block btn-primary" name="btn-signin">Sign In</button>
		<a href="registration.php">Sign Up Here...</a>
	</form>
	<footer class="footer">
		
	</footer>

</div>
</body>
</html>
<?php ob_end_flush(); ?>