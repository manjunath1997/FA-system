<!DOCTYPE html>
<html>

<body>
<?php include("home.php"); ?>

<?php $username=$_SESSION['username'];
	if($_SESSION['type']!='fa'){
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
   <li> <a href="fahome.php">Home</a></li>
<li><a href="fastudentdetails.php">Student Details</a></li>
<li><a href="fastudentgrades.php">Student Grades</a></li>
<li><a href="getlist.php">Students' List</a></li>
<li><a href="famessage.php">Send Messages</a></li-->
  </ul>
<form action="logout.php" method='POST'>
  <input name='logout' type="submit" value="logout">
</form> 

</nav>

