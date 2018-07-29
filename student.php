<!DOCTYPE html>
<html>

<body>
<?php include("home.php"); ?>

<?php $username=$_SESSION['username']; 
	if($_SESSION['type']!='student'){
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
   <li> <a href="studenthome.php">Home</a></li>
<li><a href="studentdetails.php">Personal Details</a></li>
<li><a href="registerstudent.php">Course Registration</a></li>
<li><a href="studentgrades.php">Grade Card</a></li>
<li><a href="studentmessage.php">Read Messages</a></li-->
  </ul>
  
  <!--table class=menu>
  <tr><td><a href="studenthome.php">Home</a></td></tr>
  <a href="studentdetails.php"><tr><td>Personal Details</td></tr></a>
  </table-->
  
<form action="logout.php" method='POST'>
  <input name='logout' type="submit" value="logout">
</form> 

</nav>

