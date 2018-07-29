
<?php
	include('admin.php');
?>

<?php
	if(isset($_POST['adduser'])){
		if($_POST['newpassword']==$_POST['newrepassword']){
			$newuser=$_POST['newusername'];
			$newpassword=$_POST['newpassword'];
			$newtype=$_POST['type'];
			$hashpass=hash('sha256',$newpassword);
			$addsql="INSERT INTO `FA_System`.`Login`(`id`,`type`,`password`) VALUES ('".$newuser."','".$newtype."','".$hashpass."')";
			$servername='localhost';
			$sqlname='root';
			$sqlpassword='rohith';
			
			$conn= new mysqli($servername, $sqlname, $sqlpassword);
			
			if ($conn->connect_error){
				die("connection failed : ".$conn->connect_error);
			}
			
			$result=$conn->query($addsql);
			$message='User added succesfully';
			unset($_POST['adduser']);
		}
		else{
			$message='Passwords do not match';
		}
	}
	echo $message;
	
?>
<article>
<br>
<form action='adduser.php' method='POST'>
	
Login id:		<input type='text' name='newusername' required><br>
Password:		<input type='password' name='newpassword' required><br>
ReEnter Password:	<input type='password' name='newrepassword' required><br>
Type:			<select name='type' required>
				<option value='student'>Student</option>
				<option value='fa'>FA</option>
				<option value='hod'>HOD</option>
				<option value='admin'>Admin</option>
			</select><br>
			<input type='submit' name='adduser' value='adduser'><br>
</form>
</article>
<footer>Copyright &copy; National Institute of Technology Calicut</footer>

</div>

</body>
</html>

