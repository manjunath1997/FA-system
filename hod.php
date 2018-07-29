<!DOCTYPE html>
<html>

<body>
<?php include("home.php"); ?>

<?php $username=$_SESSION['username']; 
	if($_SESSION['type']!='hod'){
		#if($_SESSION['type']!='student'){
			header("Location:".$_SESSION[type]."home.php");
		#}
		
	
	}
?>

  
<nav>
<div class="imgcontainer">
    <img src="images/<?php echo $_SESSION['username']; ?>" alt="User Photo" class="avatar" style="width:100px;height:120px;">
  </div>
  <ul>
   <li> <a href="hodhome.php">Home</a></li>
   <li><a href="hodstudentdetails.php">Student Details</a></li>
<li><a href="hodstudentgrades.php">Student Grades</a></li>
<li><a href="getlisthod.php">Students' List</a></li>
<!--li><a href="adduser.php">Add User</a></li>
<li><a href="deleteuser.php">Delete User</a></li>
<li><a href="addsection.php">Add Section</a></li>
<li><a href="addcourse.php">Add Course</a></li-->
  </ul>
<form action="logout.php" method='POST'>
  <input name='logout' type="submit" value="logout">
</form> 

</nav>

