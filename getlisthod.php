<?php
	include("hod.php");
?>

<article>

<div class='border'>
	<h3> Students from a particular area </h3>
	<form action='getlistactionhod.php' method='POST'>
		Area: <input type='text' name='area' >
		      <input type='submit' name='q1' value='Get_List'><br>
	</form>
	<br>
</div>
<br>
<div class='border'>
	<h3> Students with R Grades </h3>
	<form action='getlistactionhod.php' method='POST'>
		<!--input type='text' name='area' -->
		<input type='submit' name='q2' value='Get_List'><br>
	</form>
	<br>
</div>
<br>
<div class='border'>
	<h3> Students having CGPA between specified range </h3>
	<form action='getlistactionhod.php' method='POST'>
	From:	<input type='text' name='low' value=0 >
	To:	<input type='text' name='high' value=10 >
		<input type='submit' name='q3' value='Get_List'><br>
	</form>
	<br>
</div>
<br>
<div class='border'>
	<h3> Students having backlogs </h3>
	<form action='getlistactionhod.php' method='POST'>
	Students having backlogs in <select name='sno'>
					<option value='all'>all</option>
					<option value=1>1</option>
					<option value=2>2</option>
					<option value=3>3</option>
					<option value=4>4</option>
					<option value=5>5</option>
					<option value=6>6</option>
					<option value=7>7</option>
					<option value=8>8</option>
					</select> Semester(s)
		<input type='submit' name='q4' value='Get_List'><br>
	</form>
	<br>
</div>
<br>


</article>

<footer>Copyright &copy; National Institute of Technology Calicut</footer>
</div>
</body>
</html>

