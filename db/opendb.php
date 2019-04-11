<?php 
$servername="localhost";
$username="root";
$pasword="";
$dbname="propertyrent";
try
{
	$con= new PDO("mysql:host=$servername;dbname=$dbname",$username,$pasword);
	//set the pdo to eroor mode in Exception
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//echo "Connection SucessFull";
	
}
catch(PDOException $e)
{
    echo $sql. "<br>".$e->getMessage();
}



?>