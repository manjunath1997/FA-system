
<?php
	include('admin.php');
?>

<?php
	if(isset($_POST['deleteuser'])){
	
			$user=$_POST['username'];
			$type=$_POST['type'];
			$deletesql="DELETE FROM `FA_System`.`Login` WHERE `FA_System`.`Login`.`id`='".$user."' AND `FA_System`.`Login`.`type`='".$type."'";
			$servername='localhost';
			$sqlname='root';
			$sqlpassword='rohith';
			
			$conn= new mysqli($servername, $sqlname, $sqlpassword);
			
			if ($conn->connect_error){
				die("connection failed : ".$conn->connect_error);
			}
			
			$result=$conn->query($deletesql);
			$message='User deleted succesfully';
			unset($_POST['deleteuser']);
	}
	
?>
<article>
<?php echo $message; ?>
<br>
<form action='deleteuser.php' method='POST'>
	
Login id:		<input type='text' name='username' required><br>
Type:			<select name='type' required>
				<option value='student'>Student</option>
				<option value='fa'>FA</option>
				<option value='hod'>HOD</option>
				<option value='admin'>Admin</option>
			</select><br>
			<input type='submit' name='deleteuser' value='deleteuser'><br>
</form>
</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>

</div>

</body>
</html>

