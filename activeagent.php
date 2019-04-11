<?php
include("db/opendb.php");
if( isset($_GET['id']) == TRUE)
	{
		$id = $_GET['id'];
		$query = "UPDATE agent SET Status='active' where Email='" . $id . "'";
		$con -> query($query) or die("Update error");
		echo "<script language = \"javascript\" type = \"text/javascript\"> 
		window.location.href=\"viewagents.php\"; </script>";		
	}
?>