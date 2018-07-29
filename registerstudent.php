
<?php
	include("student.php");
?>



<?php
	if(isset($_POST['register'])){

			$course=$_POST['course'];
			$faculty=$_POST['faculty'];
			$year=$_POST['year'];
			$sem=$_POST['sem'];
			$semno=$_POST['semno'];
			#$coursesql="SELECT * FROM `FA_System`.`Course` WHERE `FA_System`.`Course`.`Course_Code`='".$course."'";
			$sectionsql= "SELECT * FROM `FA_System`.`Section` WHERE `FA_System`.`Section`.`Course_Code`='$course' AND `FA_System`.`Section`.`Faculty_Code`='$faculty' AND `FA_System`.`Section`.`Year`='$year' AND `FA_System`.`Section`.`Semester`='$sem'";
			
			
			$servername='localhost';
			$sqlname='root';
			$sqlpassword='rohith';
			
			$conn= new mysqli($servername, $sqlname, $sqlpassword);
			
			if ($conn->connect_error){
				die("connection failed : ".$conn->connect_error);
			}
			unset($_POST['register']);
			$result=$conn->query($sectionsql);
			if ($result->num_rows == 0){
				$message="invalid Details";
			}
			else{
				$row=$result->fetch_assoc();
				$section=$row['Section_id'];
				$rollno=$_SESSION['username'];
				$registersql="INSERT INTO `FA_System`.`Register`(`Roll_Number`,`Section_id`,`Semno`) VALUES ('$rollno','$section','$semno')";
				$result1=$conn->query($registersql);
				$message="Registered succesfully ";
			}
		
	}
	#echo $message;
	
?>

<article>
<?php echo $message; ?>
<form action='registerstudent.php' method='POST'>

Sem Number:	<input type='number' name='semno' required><br>
Course id:	<input list="course" name="course">
			<datalist id="course">
				<?php 
				$servername='localhost';
				$sqlname='root';
				$sqlpassword='rohith';
				$conn= new mysqli($servername, $sqlname, $sqlpassword);
				if ($conn->connect_error){
					die("connection failed1 : ".$conn->connect_error);
				}
				$coursesql="SELECT * FROM `FA_System`.`Course`";
				$result=$conn->query($coursesql);
				
				while($row=$result->fetch_assoc()){
					echo "<option value=".$row['Course_Code'].">".$row['Course_Code']."-".$row['Course_Name']."</option>";
				
				}
				
				?>
			</datalist>
		<br>
Faculty Code:	<input type='text' name='faculty' required><br>
Year:		<input type='number' name='year' required><br>
Semester:	<select name='sem' required>
			<option value='monsoon'>Monsoon</option>
			<option value='winter'>Winter</option>
		</select><br>
		<input type='submit' name='register' value='register'><br>
</form>

</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>
</div>
</body>
</html>


