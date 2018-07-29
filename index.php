<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 40%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: Grey;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 20%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 100px 18px;
    background-color: white;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 10%;
    border-radius: 10%;
}
n
.container {
    text-align: center;
    padding: 16px;
}

span.psw {
    text-align: center;
    float: center;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>

<?php
	session_start();
	if (isset($_POST['submit'])){
		
		if (isset($_POST['username']) && isset($_POST['type']) && isset($_POST['password'])){
			
			$username=$_POST['username'];
			$type=$_POST['type'];
			$password=$_POST['password'];
			
			
			$servername='localhost';
			$sqlname='root';
			$sqlpassword='rohith';
			
			$conn= new mysqli($servername, $sqlname, $sqlpassword);
			
			if ($conn->connect_error){
				die("connection failed : ".$conn->connect_error);
			}
			
			$sql="SELECT password FROM `FA_System`.`Login` WHERE id='".$username."' AND type='".$type."' ";
			
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			$pass=$row['password'];
			#echo $pass;
			
			if ($pass){
				
				if ($pass==hash('sha256',$password)){
				
					$_SESSION['login']=true;
					$_SESSION['username']=$username;
					$_SESSION['type']=$type;
				
					#header("Location:adminhome.php");
					if ($type=='admin'){
						header("Location:adminhome.php");
					}
					else if($type=='student'){
						header("Location:studenthome.php");
					}
					else if($type=='fa'){
						header("Location:fahome.php");
					}
					else if($type=='hod'){
						header("Location:hodhome.php");
					}
					
					exit;
				}
				else{
					$error="Invalid Password";
				}
			}
			else{
				$error="Invalid User";
			}
		}
		else{
			$error="Please enter a username and type";
		}
	}
	
?>

<body>

<h1 style="text-align:center;">Faculty Advisory System of NITC</h1><!--br-->
<div class="imgcontainer">
  	 <img src="images/nitclogo.png" alt="Avatar" class="avatar">
  </div>
  
<form action="index.php" method="POST">
   
<h3 style='text-align: center;'>Login</h3>
<div style='text-align: center;'>
<?php
	if (isset($error)){
		echo $error;
	}
?>
</div>
<br>
  <div class="container" style='text-align: center;'>
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" autocomplete autofocus required><br>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required><br>
	
     <label><b>login as</b></label>
     <input type="radio" name="type" value="student" checked> student
  <input type="radio" name="type" value="fa"> faculty advisor
  <input type="radio" name="type" value="hod"> HOD  
   <input type="radio" name="type" value="admin"> admin <br> 

    <button type="submit" name='submit'>Login</button><br>
    <a href="forgot.php"> Forgot Password? </a>
    
  </div>
    
</form>
<!--span class="psw">Forgot <a href="#">password?</a></span-->
</body>
</html>

