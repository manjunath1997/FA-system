<?php include('fa.php'); ?>
<article>

<form action='fastudentdetails.php' method='POST'>
Roll No:<input type='text' name='studentno' >
	<input type='submit' name='getstudent' value='getstudent'>
</form>

<?php if(isset($_POST['getstudent'])){
	$_SESSION['studentno']=$_POST['studentno'];
	$_SESSION['check']=true;} ?>

<form action="fastudentdetails.php" method="POST">	<!--input type="submit" name="editdetails" value='editdetails'-->
<?php
	if(isset($_SESSION['studentno'])){
	if(!isset($_POST['editdetails'])){
	echo '<input type="submit" name="editdetails" value="editdetails">';
	}
	}
?>
</form>
<?php echo $_SESSION['message']; ?>
<table>
	<!--tr>
	<th>Name</th>
	<th>Value</th>
	</tr-->
<?php
	if ($_SESSION['check']==true){
	echo "<tr><th>Name</th>	<th>Value</th></tr>";
	$rollno=$_SESSION['studentno'];
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	
	$sql="SELECT * FROM `FA_System`.`Student` WHERE `FA_System`.`Student`.`Roll_Number`='".$rollno."'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$col=array_keys($row);
	
	if (isset($_POST['editdetails']) || isset($_POST['editstudentdetails'])){
		
		$student=$_SESSION['studentno'];
		include('editstudentdetails.php');
	}
	else{
	
	foreach ($col as $val){	
		
		echo '<tr><td>'.$val.'</td> <td>'.$row[$val].'</td></tr>';
	}
	}
	}
?>
</table>





</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>
</div>
</body>
</html>

