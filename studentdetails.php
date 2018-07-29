<?php include("student.php"); ?>

<article>


<form action="studentdetails.php" method="POST">	<!--input type="submit" name="editdetails" value="editdetails"-->
<?php
	if(!isset($_POST['editdetails'])){
	echo '<input type="submit" name="editdetails" value="editdetails">';
	}
?>
</form>
<?php echo $_SESSION['message']; ?>
<div style="overflow-x:scroll">
<table >
	<tr>
	<th>Name</th>
	<th>Value</th>
	</tr>
<?php
	$rollno=$_SESSION['username'];
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	
	$sql="SELECT * FROM `FA_System`.`Student` WHERE `FA_System`.`Student`.`Roll_Number`='$rollno'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	#$test=
	if (!isset($row)){
		$createsql="INSERT INTO `FA_System`.`Student`(`Roll_Number`, `Faculty_Advisor_Code`) VALUES ('$rollno', 'VP') ";
		#echo $sql.'<br>'.$createsql;
		$conn->query($createsql);
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
	}
		
	
	$col=array_keys($row);
	
	
	if (isset($_POST['editdetails']) || isset($_POST['editstudentdetails'])){
		
		$student=$rollno;
		include('editstudentdetails.php');
	}
	else{
	
	foreach ($col as $val){	
		
		echo '<tr><td>'.$val.'</td> <td>'.$row[$val].'</td></tr>';
	}
	}
?>
</table>
</div>
</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>
</div>
</body>
</html>

