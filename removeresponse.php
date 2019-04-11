
<?php
include("db/opendb.php");
if( isset($_GET['id']) == TRUE)
	{
		$id = $_GET['id'];
		$query = "delete from response where ResponseId ='" . $id . "'";
		$con -> query($query) or die("delete error");
		echo "<script language = \"javascript\" type = \"text/javascript\"> 
		window.location.href=\"agentHome.php\"; </script>";		
	}
?>