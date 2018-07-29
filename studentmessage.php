<?php include("student.php"); ?>

<article>
<table style="border-style:none">


<?php
	$servername='localhost';
	$sqlname='root';
	$sqlpassword='rohith';
	$conn= new mysqli($servername, $sqlname, $sqlpassword);
	if ($conn->connect_error){
		die("connection failed : ".$conn->connect_error);
	}
	
	$msgsql="SELECT `FA_System`.`Messages`.`Date`, `FA_System`.`Messages`.`Message` FROM `FA_System`.`Messages`, `FA_System`.`Student` WHERE `FA_System`.`Student`.`Roll_Number`='$username' AND `FA_System`.`Student`.`Faculty_Advisor_Code`=`FA_System`.`Messages`.`Faculty_Advisor_Code` ";
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

