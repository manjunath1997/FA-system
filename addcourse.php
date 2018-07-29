
<?php
	include('admin.php');
?>

<?php
	if(isset($_POST['addcourse'])){
		
		$course=$_POST['course'];
		$name=$_POST['name'];
		$credits=$_POST['credits'];
		$servername='localhost';
		$sqlname='root';
		$sqlpassword='rohith';
		$conn= new mysqli($servername, $sqlname, $sqlpassword);
		if ($conn->connect_error){
			die("connection failed1 : ".$conn->connect_error);
		}
		$coursesql="INSERT INTO `FA_System`.`Course`(`Course_Code`,`Course_Name`,`Credits`) VALUES ('".$course."','".$name."','".$credits."')";
		$result=$conn->query($coursesql);
		$message="Course added succesfully";
		unset($_POST['addcourse']);
	}
	
?>
<article>
<br>
<form action='addcourse.php' method='POST'>
	
Course id:	<input type='text' name='course' required><br>	
Course Name:	<input type='text' name='name' required><br>
Credits:	<input type='number' name='credits' required><br>
		<input type='submit' name='addcourse' value='addcourse'><br>
</form>

</article>
<footer>Copyright &copy; National Institute of Technology Calicut</footer>

</div>

</body>
</html>
