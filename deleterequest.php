<?php
/// authentication code
session_start(); 
if( !isset($_SESSION['Id']) )
{
	echo "<script language='javascript'>window.location.href='blkadmin.php';</script>";
}
else{
    if($_SESSION['user']=="agent"){
        header("Location: agentHome.php");
		exit;
    }
    if($_SESSION['user']=="tenant"){
        header("Location: tenantHome.php");
		exit;
    }
}
?>
<?php
include("db/opendb.php");
if( isset($_GET['id']) == TRUE)
	{
		$id = $_GET['id'];
		$query1 = "delete from response where RequestId ='" . $id . "'";
		$query = "delete from tenacyrequest where RequestId ='" . $id . "'";
		$con -> query($query1) or die("delete error");
		$con -> query($query) or die("delete error");
		echo "<script language = \"javascript\" type = \"text/javascript\">
		window.location.href=\"request.php\"; </script>";		
	}
?>