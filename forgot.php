<html>

<body>


<?php
	if(isset($_POST['submit'])){
		if($_POST['pass']==$_POST['repass']){
			$user=$_POST['username'];
			$password=$_POST['pass'];
			$type=$_POST['type'];
			$hashpass=hash('sha256',$password);
			$addsql="UPDATE `FA_System`.`Login` SET `FA_System`.`Login`.`password` = '$hashpass' WHERE `FA_System`.`Login`.`id` = '$user' AND `FA_System`.`Login`.`type` = '$type' ";
			$servername='localhost';
			$sqlname='root';
			$sqlpassword='rohith';
			
			$conn= new mysqli($servername, $sqlname, $sqlpassword);
			
			if ($conn->connect_error){
				die("connection failed : ".$conn->connect_error);
			}
			
			$result=$conn->query($addsql);
			#echo $addsql;
			$message="Password Updated succesfully <br><a href='index.php'> Click here </a> to login";
			unset($_POST['submit']);
		}
		else{
			$message='Passwords do not match';
		}
	}
	
	
?>

<br><br><br><br><br>

<div border=1>
<div style="text-align:center" >
<h2> Forgot Password? </h2>
<?php echo $message; ?>
<form action='forgot.php' method='POST'>
	<input type=text name=username placeholder=Username required><br>
	<input type=password name=pass placeholder=Password required><br>
	<input type=password name=repass placeholder="Re Enter Password" required><br>
Type:	<select name=type raquired>
		<option value=student>student</option>
		<option value=fa>Faculty Advisor</option>
		<option value=hod>HOD</option>
		<option value=admin>admin</option>
	</select>
	<br>
	<input type=submit name=submit value=Submit>
</form>
	<hr>
</div>
</div>
</body>
</html>
