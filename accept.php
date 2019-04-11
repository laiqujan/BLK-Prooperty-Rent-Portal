<?php 
session_start(); 
if( !isset($_SESSION['Id']) )
{
	echo "<script language='javascript'>window.location.href='tenantLogin.php';</script>";
}
else{
    if($_SESSION['user']=="agent"){
        header("Location: agentHome.php");
		exit;
    }
    if($_SESSION['user']=="admin"){
        header("Location: adminhome.php");
		exit;
    }
}
?>
<?php 

include("db/opendb.php");
    $responseId = $_GET['id'];
    $status = "accepted";
    $query = "Update response SET Status='".$status."' where ResponseId='".$responseId."'";			
		try
		{
			$stmt  = $con -> prepare($query);
			$stmt -> execute();
            
            
        $sql = "select Email from response where ResponseId='".$responseId."'";
		$result = $con->query($sql);	
		foreach($result as $row)
		{			
         $email=$row['Email'];		 
	    }
            
        $sql1 = "select FirstName from agent where Email='".$email."'";
		$result1 = $con->query($sql1);	
		foreach($result1 as $row1)
		{			
         $FirstName=$row['FirstName'];		 
	    }
            
            
            
        
$name = "BLK 1 SG";
$message = "Dear ".$FirstName.",
We wish to inform you that your response has been accepted by one of the tenants. 
Please check the contact details of the user by logging into http://www.blk1sg.com/agentLogin.php
We would like to remind you again that you are not supposed to collect any commission from the tenant. Trying to do so may get your account banned. 
If you need any assistance, please email support@blk1sg.com
Warmest regards,
Blk1 Singapore Team 
";
$subject = "Response received for your request";

$to = $email;
$message = 'FROM: '.$name.' Message: '.$message;
$headers = 'From: support@blk1sg.com' . "\r\n";
 
if (filter_var($to, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
mail($to, $subject, $message, $headers); //This method sends the mail.
            
            
            
            
            
            echo "<script language='javascript' type='text/javascript'>window.location.href='agentHome.php';</script>";
		}
		catch(PDOException $e)
		{
			$msg =  $e -> getMessage();
            echo $msg;
		}


?>