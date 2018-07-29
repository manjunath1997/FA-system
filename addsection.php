
<?php
	include('admin.php');
?>


<?php
	if(isset($_POST['addsection'])){

			$course=$_POST['course'];
			$faculty=$_POST['faculty'];
			$year=$_POST['year'];
			$sem=$_POST['sem'];
			#$coursesql="SELECT * FROM `FA_System`.`Course` WHERE `FA_System`.`Course`.`Course_Code`='".$course."'";
			$sectionsql="INSERT INTO `FA_System`.`Section`(`Course_Code`,`Faculty_Code`,`Year`,`Semester`) VALUES ('".$course."','".$faculty."','".$year."','".$sem."')";
			$servername='localhost';
			$sqlname='root';
			$sqlpassword='rohith';
			
			$conn= new mysqli($servername, $sqlname, $sqlpassword);
			
			if ($conn->connect_error){
				die("connection failed : ".$conn->connect_error);
			}
			
			$result=$conn->query($sectionsql);
			
			$message="Section added succesfully";
			unset($_POST['addsection']);
		
	}
	echo $message;
	
?>
<article>
<br>
<form action='addsection.php' method='POST'>
	
Course id:	<!--input type='text' name='course' required><br-->
		<!--select name='course' required>
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
		</select-->
		<input list="course" name="course">
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
		<input type='submit' name='addsection' value='addsection'><br>
</form>
</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>

</div>

</body>
</html>

