
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
	if (isset($_POST['editstudentdetails'])){
	
		$servername='localhost';
		$sqlname='root';
		$sqlpassword='rohith';
		$conn= new mysqli($servername, $sqlname, $sqlpassword);
		if ($conn->connect_error){
			die("connection failed : ".$conn->connect_error);
		}
		foreach($col as $val){
			
			$updatesql="UPDATE `FA_System`.`Student` SET `FA_System`.`Student`.`$val` = '$_POST[$val]' WHERE `FA_System`.`Student`.`Roll_Number` = '$student' ";
			
			$conn->query($updatesql);
		}
		
		
		unset($_POST['editstudentdetails']);
		
		header('Location:'.$file.'details.php');
		
	}
	else{
	echo '<form action='.$file.'details.php method="POST" enctype="multipart/form-data">';
	echo "<tr> <td>Photo</td> <td><input type='file' name='photo'></td></tr>";
	$tabletype=array();
	foreach($col as $val){

		echo "<tr><td>$val</td> <td><input type='text' name=$val value='$row[$val]'></td></tr>";
	}
	echo '<input type="submit" name="editstudentdetails" value="Update details"></form>';
	}
?>

