<!DOCTYPE html>
<html>
<body>
<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header("Location:index.php");
	}
	else if (isset($_POST['logout']) ){
		unset($_SESSION['login']);
		session_destroy();
		
		header("Location:index.php");
		exit;
	}
?>

<a href="index.php">Click here to login again</a>

</body>
</html>
