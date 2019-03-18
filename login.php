<?php
ob_start();
session_start();
require_once 'db_connect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
	header("Location: admin_panel.php");
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

  $res=mysqli_query($conn, "SELECT user_ID, email, userPassword FROM user WHERE userName='$name'");
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row
  
  if( $count == 1 && $row['userPassword']==$password ) {
  	$_SESSION['user'] = $row['user_ID'];
  	header("Location: admin_panel.php");
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
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		#form {
			display: flex;
			flex-direction: column;
			margin: 0 auto;
			width: 35%;
		}

		h1 {
			text-align: center;
		}
	</style>
</head>
<body>
<header id="header" class="">
	
</header><!-- /header -->

	<h1>Sign In</h1>

	<?php
	if ( isset($errMSG) ) {
		echo $errMSG; ?>

		<?php
	}
	?>

	<form id="form" method="POST">
		<input type="text" name="name" value="" placeholder="Insert Username">
		<span><?php echo $nameError; ?></span>
		<input type="password" name="pass" placeholder="Insert Password">
		<span><?php echo $passError; ?></span>
		<button type="submit" class="btn btn-block btn-primary" name="btn-signin">Sign In</button>
		<a href="registration.php">Sign Up Here...</a>
	</form>


</body>
</html>
<?php ob_end_flush(); ?>