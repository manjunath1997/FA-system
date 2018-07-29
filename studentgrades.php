<?php include("student.php"); ?>

<article>


<form action="studentgrades.php" method="POST">	<!--input type="submit" name="editdetails" value="editdetails"-->
<?php
	if(!isset($_POST['editgrades'])){
	echo '<input type="submit" name="editgrades" value="editgrades">';
	}
?>
</form>
<?php echo $message; ?>

<div style="overflow-x:scroll">
<table >
	<tr>
	<th>Sem no</th>
	<th>Sem</th>
	<th>Course Code</th>
	<th>Course Name</th>
	<th>Credits</th>
	<th>T1 Marks</th>
	<th>T2 Marks</th>
	<th>Assign</th>
	<th>Quizes</th>
	<th>Project</th>
	<th>Grade</th>
	<th>Attendance</th>
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
	
	$sql="SELECT r.`Semno`, sc.`Semester`, c.`Course_Code`, c.`Course_Name`, c.`Credits`, r.`Marks_T1`, r.`Marks_T2`, r.`Assignments`, r.`Quizes`,r.`Project`, r.`Grade`, r.`Attendance` FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc WHERE s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND s.`Roll_Number`='$rollno' ORDER BY r.`Semno`, c.`Course_Code` ";
	$result=$conn->query($sql);
	#$row=$result->fetch_assoc();
	#$col=array_keys($row);
	
	if (isset($_POST['editgrades']) || isset($_POST['editstudentgrades'])){
		
		$student=$_SESSION['username'];
		
		include('editstudentgrades.php');
		#header("Location:editstudentgrades.php");
		
	}
	else{
	
	
	while ($row=$result->fetch_assoc()){
		$col=array_keys($row);
		echo '<tr>';
		foreach ($col as $val){
			echo '<td>'.$row[$val].'</td>';
		}
		echo '</tr>';
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


