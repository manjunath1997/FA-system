
<?php
	
	if ($_SESSION['type']=='student'){
		$file='student';
	}
	else if($_SESSION['type']=='fa'){
		$file='fastudent';
	}
	else if($_SESSION['type']=='hod'){
		$file='hodstudent';
	}
	if (isset($_POST['editstudentgrades'])){ #Action to be done to edit marks
	
		$servername='localhost';
		$sqlname='root';
		$sqlpassword='rohith';
		$conn= new mysqli($servername, $sqlname, $sqlpassword);
		if ($conn->connect_error){
			die("connection failed : ".$conn->connect_error);
		}
		
		while ($row=$result->fetch_assoc()){
			
			$rowid=$row['Semno'].$row['Course_Code'];
			$semno=$row['Semno'];
			$course=$row['Course_Code'];
			$sectionsql= "SELECT `FA_System`.`Section`.`Section_id` FROM `FA_System`.`Register`, `FA_System`.`Section` WHERE `FA_System`.`Register`.`Semno`='$semno' AND `FA_System`.`Register`.`Section_id`=`FA_System`.`Section`.`Section_id` AND `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Section`.`Course_Code`='$course' ";
			$secresult=$conn->query($sectionsql);
			$secrow=$secresult->fetch_assoc();
			$section=$secrow['Section_id'];
			$n=$rowid.'Marks_T1';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Marks_T1`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
			$n=$rowid.'Marks_T2';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Marks_T2`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
			$n=$rowid.'Assignments';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Assignments`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
			$n=$rowid.'Quizes';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Quizes`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
			$n=$rowid.'Project';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Project`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
			$n=$rowid.'Grade';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Grade`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
			$n=$rowid.'Attendance';
			$updatesql= "UPDATE `FA_System`.`Register` SET `FA_System`.`Register`.`Attendance`='$_POST[$n]' WHERE `FA_System`.`Register`.`Roll_Number`='$student' AND `FA_System`.`Register`.`Section_id`='$section' ";
			$conn->query($updatesql);
		
		
		}
		
		unset($_POST['editstudentgrades']);
		
		header('Location:'.$file.'grades.php');
		
	}
	else{ #To display the form for editing marks
	echo '<form action='.$file.'grades.php method="POST">';
	$tabletype=array();
	$rollno=$_SESSION['username'];
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	
	$sql="SELECT r.`Semno`, sc.`Semester`, c.`Course_Code`, c.`Course_Name`, c.`Credits`, r.`Marks_T1`, r.`Marks_T2`, r.`Assignments`, r.`Quizes`,r.`Project`, r.`Grade`, r.`Attendance` FROM `FA_System`.`Student` AS s, `FA_System`.`Register` AS r, `FA_System`.`Course` AS c, `FA_System`.`Section` AS sc WHERE s.`Roll_Number`=r.`Roll_Number` AND r.`Section_id`=sc.`Section_id` AND sc.`Course_Code`=c.`Course_Code` AND s.`Roll_Number`='$student' ORDER BY r.`Semno`, c.`Course_Code` ";
	$result=$conn->query($sql);

	while ($row=$result->fetch_assoc()){
	
		$rowid=$row['Semno'].$row['Course_Code'];
		
		echo '<tr>';
		echo "<td>$row[Semno]</td>";
		echo "<td>$row[Semester]</td>";
		echo "<td>$row[Course_Code]</td>";
		echo "<td>$row[Course_Name]</td>";
		echo "<td>$row[Credits]</td>";
		$n=$rowid.'Marks_T1';
		#echo $n;
		echo "<td> <input type='text' size='5' name=$n value='$row[Marks_T1]'>  </td>";
		$n=$rowid.'Marks_T2';
		
		echo "<td> <input type='text' size='5' name=$n value='$row[Marks_T2]'>  </td>";
		$n=$rowid.'Assignments';
		echo "<td> <input type='text' size='5' name=$n value='$row[Assignments]'>  </td>";
		$n=$rowid.'Quizes';
		echo "<td> <input type='text' size='5' name=$n value='$row[Quizes]'>  </td>";
		$n=$rowid.'Project';
		echo "<td> <input type='text' size='5' name=$n value='$row[Project]'>  </td>";
		$n=$rowid.'Grade';
		echo "<td> <input type='text' size='1' name=$n value='$row[Grade]'>  </td>";
		$n=$rowid.'Attendance';
		echo "<td> <input type='text' size='1' name=$n value='$row[Attendance]'>  </td>";
				
		echo '</tr>';
		
	}
	echo '<input type="submit" name="editstudentgrades" value="Update Grades"></form>';
	}
?>

