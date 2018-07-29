<?php include("fa.php"); ?>

<article>

<form action="famessage.php" method='POST'>
	New Message:<textarea name='message' rows='7' cols='100' placeholder="Leave your Message Here"></textarea>
	<input type='submit' value='send' name='send'>
</form>
<br>
<br>

<?php if(isset($_POST['send'])){
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	$message=$_POST['message'];
	$date=date("l Y/m/d h:i:sa");
	
	$sendsql="INSERT INTO `FA_System`.`Messages` (`Date`, `Faculty_Advisor_Code`, `Message`) VALUES ('$date', '$username', '$message'); ";
	
	$result=$conn->query($sendsql);
	
	}
?>

<table class=message>

<?php
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	
	$msgsql="SELECT `FA_System`.`Messages`.`Date`, `FA_System`.`Messages`.`Message` FROM `FA_System`.`Messages` WHERE `FA_System`.`Messages`.`Faculty_Advisor_Code`='$username' ";
	$result=$conn->query($msgsql);
	if($result->num_rows==0){
		echo "No messages yet";
	}
	else{
	echo "<tr><th>Date and Time</th><th>Message</th></tr>";
	
	while($row=$result->fetch_assoc()){
		echo "<tr><td>".$row[Date]."</td><td>".$row[Message]."</td></tr>";
	}
	}
?>
</table>

</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>
</div>
</body>
</html>

