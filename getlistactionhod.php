<?php
	include("hod.php");
?>
<article>

<?php 
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	$hod=$_SESSION['username'];
?>

<!--form action='getlist.php' method='POST'>
	<input type='submit' name='clear' value='clear'>
</form-->	
<a href='getlisthod.php'> <button type='button'> Clear </button> </a>	

<?php
	#students from specific area
	if(isset($_POST['q1'])){
		
		$area=$_POST['area'];
		$sql1="SELECT s.`Roll_Number`, s.`Name` FROM `FA_System`.`Student` AS s,`FA_System`.`Faculty_Advisor` AS f, `FA_System`.`Hod` AS h WHERE s.`Permanent_Address`LIKE '%$area%' AND s.`Department_Code`=h.`Department_Code` AND h.`hod_Code`='$hod' ORDER BY s.`Roll_Number` ";
		$result=$conn->query($sql1);
		echo "<table><tr><th>Rollno</th><th>Name</th></tr>";
		while($row=$result->fetch_assoc()){
			echo "<tr><td>".$row[Roll_Number]."</td><td>".$row[Name]."</td></tr>";
		}
		echo '</table>';
	}
	
	#students with R grades
	elseif (isset($_POST['q2'])){
		
		$sql2="SELECT s.`Roll_Number`, s.`Name`, r.`Semno`, c.`Course_Code`, c.`Course_Name`,r.`Grade`  FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc ,`FA_System`.`Faculty_Advisor` AS f, `FA_System`.`Hod` AS h WHERE s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND r.`Grade`='R' AND s.`Department_Code`=h.`Department_Code` AND h.`hod_Code`='$hod' ORDER BY s.`Roll_Number` ";
		$result=$conn->query($sql2);
		echo "<table><tr><th>Roll Number</th><th>Name</th><th>Sem No</th><th>Course Code</th><th>Course Name</th><th>Grade</th></tr>";
		while($row=$result->fetch_assoc()){
			echo "<tr><td>".$row[Roll_Number]."</td><td>".$row[Name]."</td><td>".$row[Semno]."</td><td>".$row[Course_Code]."</td><td>".$row[Course_Name]."</td><td>".$row[Grade]."</td></tr>";
		}
		echo "</table>";
		
	}
	
	#students between a range of cgpa
	elseif (isset($_POST['q3'])){
		
		$low=$_POST['low'];
		$high=$_POST['high'];
		$sql3= "SELECT s.`Roll_Number`, s.`Name`, s.`CGPA` FROM `FA_System`.`Student` AS s,`FA_System`.`Hod` AS h WHERE (s.`CGPA` BETWEEN $low AND $high) AND s.`Department_Code`=h.`Department_Code` AND h.`hod_Code`='$hod' ORDER BY s.`Roll_Number` ";
		$result=$conn->query($sql3);
		echo "<table><tr><th>Rollno</th><th>Name</th><th>CGPA</th></tr>";
		while($row=$result->fetch_assoc()){
			echo "<tr><td>".$row[Roll_Number]."</td><td>".$row[Name]."</td><td>".$row[CGPA]."</td></tr>";
		}
		echo '</table>';
	
	}
	
	#Students having backlogs
	elseif (isset($_POST['q4'])){
		
		$sno=$_POST['sno'];
		
		$sql4a="SELECT s.`Roll_Number`, s.`Name`, r.`Semno`, c.`Course_Code`, c.`Course_Name`, r.`Grade` FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc, `FA_System`.`Hod` AS h WHERE s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND (r.`Grade`='F' OR r.`Grade`='W') AND s.`Department_Code`=h.`Department_Code` AND h.`hod_Code`='$hod' AND (s.`Roll_Number`, s.`Name`, c.`Course_Code`, c.`Course_Name`) NOT IN (SELECT s.`Roll_Number`, s.`Name`, c.`Course_Code`, c.`Course_Name` FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc WHERE s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND r.`Grade`!='F' AND r.`Grade`!='W' AND s.`Faculty_Advisor_Code`='VP') ORDER BY r.`Semno` ";
		$sql4b="SELECT s.`Roll_Number`, s.`Name`, r.`Semno`, c.`Course_Code`, c.`Course_Name`, r.`Grade` FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc,`FA_System`.`Hod` AS h WHERE r.`Semno`=$sno AND s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND (r.`Grade`='F' OR r.`Grade`='W') AND s.`Department_Code`=h.`Department_Code` AND h.`hod_Code`='$hod' AND (s.`Roll_Number`, s.`Name`, c.`Course_Code`, c.`Course_Name`) NOT IN (SELECT s.`Roll_Number`, s.`Name`, c.`Course_Code`, c.`Course_Name` FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc WHERE s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND r.`Grade`!='F' AND r.`Grade`!='W' AND s.`Faculty_Advisor_Code`='VP') ORDER BY r.`Semno` ";
		
		
		if ($sno=='all'){
			$sql4=$sql4a;
		}
		else{
			$sql4=$sql4b;
		}
		
		$result=$conn->query($sql4);
		echo "<table><tr><th>Rollno</th><th>Name</th><th>Sem No</th><th>Course Code</th><th>Course Name</th><th>Grade</th></tr>";
		while($row=$result->fetch_assoc()){
			echo "<tr><td>".$row[Roll_Number]."</td><td>".$row[Name]."</td><td>".$row[Semno]."</td><td>".$row[Course_Code]."</td><td>".$row[Course_Name]."</td><td>".$row[Grade]."</td></tr>";
		}
		echo '</table>';
	
	}
	
?>


</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>
</div>
</body>
</html>

