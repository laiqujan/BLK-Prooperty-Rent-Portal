<?php
include("db/opendb.php");
if( isset($_GET['id']) == TRUE)
	{
		$id = $_GET['id'];
		$query = "UPDATE tenant SET Status='suspended' where Email='" . $id . "'";
		$con -> query($query) or die("Update error");
		echo "<script language = \"javascript\" type = \"text/javascript\"> 
		window.location.href=\"viewtenants.php\"; </script>";		
	}
?>