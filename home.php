<!DOCTYPE html>
<html>
<head>
<style>
div.container {
    width: 100%;
    /*position: relative;
    min-height:100%;*/
    border: 1px solid gray;
    
}

header {
    padding: 1em;
    color: black;
    background-color: DeepSkyBlue/*Azure*/;
    clear: left;
    text-align: center;
}
footer {
    /*position: absolute;*/
    padding: 1em;
    color: black;
    background-color: DeepSkyBlue;
    clear: left;
    text-align: center;
    /*bottom:0;*/
}


nav {
    float: left;
    max-width: 300px;
    min-height: 100%;
    padding: 1em;
    max-height: 5000px;
    border-right: 1px solid gray;
}
div.a {
    float: left;
    max-width: 0;
    margin: 0;
    padding: 0;
}


div.border {
	
	background-color: Whitesmoke;
	 border: 2px solid green;
   	 border-radius: 12px;
	padding-left: 50px;
	padding-top: 5px;
	padding-bottom: 5px;

}

nav ul {
    list-style-type: none;
    padding: 0;
}
   
nav ul a {
    text-decoration: none;
}

article {
    margin-left: 170px;
    /*border-left: 1px solid gray;*/
    padding: 1em;
    overflow: hidden;
}

table.message {
    font-family: green;
    overflow:scroll;
    boarder-style:none;
}

table {
    font-family: arial, green;
    border-collapse: collapse;
    /*width: 100%;*/
    overflow:scroll;
}


table.menu{
    font-family: green;
    /*width: 100%;*/
    overflow:scroll;
}

td, th {
    border: 1px solid black;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: Ghostwhite;
		}

tr:hover{background-color:Moccasin}

</style>
</head>

<body>


<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header("Location:index.php");
		exit;
	}
?>



<div class="container">

<header>
<div class="a">
 <div float="left">
    <img src="images/nitclogo.png" style="width:50px;height:65px;"alt="NITC Logo">
 </div >
</div> 
   <h1>NATIONAL INSTITUTE OF TECHNOLOGY CALICUT</h1>


</header>


