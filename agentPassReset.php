<?php
/// authentication code
session_start(); 
if( !isset($_SESSION['Id']) )
{
	echo "<script language='javascript'>window.location.href='agentLogin.php';</script>";
}
else{
    if($_SESSION['user']=="tenant"){
        header("Location: tenantHome.php");
		exit;
    }
    if($_SESSION['user']=="admin"){
        header("Location: adminhome.php");
		exit;
    }
}
include("db/opendb.php");
$email = $_SESSION['Id'];
$pass = isset($_POST['password']) == TRUE ? trim($_POST['password']) : "";
$password = hash('sha256', $pass);
	if( isset($_POST['Reset']))
	{	
		$query = "Update agent SET Password='" . $password . "'
		where Email='" . $email . "'";	
        $sql = "select * from agent where Email='" . $email . "'";	
        
		try
		{
			$stmt  = $con -> prepare($query);
			$stmt -> execute();
            $result = $con->query($sql);	
		foreach($result as $row)
		{			
         $FirstName=$row['FirstName'];		 
	    }
            
$name = "BLK 1 SG";
$message = "Dear ".$FirstName.",
We wish to inform you that your login password has been changed as you requested.
You may login to your account using the new password. Please contact us at support@blk1sg.com if you didnt request for a password reset. 
You may access our online services provided from our website at http://www.blk1sg.com.
Thank you for using our services. 
";
$subject = "Notification for Login Password Change";

$to = $email;
$message = 'FROM: '.$name.' Message: '.$message;
$headers = 'From: support@blk1sg.com' . "\r\n";
 
if (filter_var($to, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
mail($to, $subject, $message, $headers); //This method sends the mail.
            
            
$errMSG="Password updated Successfully..!!";
			
		}
		catch(PDOException $e)
		{
			
			$errMSG =  $e -> getMessage();		
	        
			
		}
	}
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    <!-- Basic -->
    <title>BLK 1 Singapore | <?php echo $_SESSION["Id"]; ?></title>
    <!-- Define Charset -->
    <meta charset="utf-8">
		<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Page Description and Author -->
    <meta name="description" content="BLK 1 Singapore | Property Rental">
    <meta name="author" content="Rapto Tech">
    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" media="screen">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">
    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">
    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/colors/green.css" title="green" media="screen" />

    <!-- Margo JS  -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.migrate.js"></script>
    <script type="text/javascript" src="js/modernizrr.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/jquery.appear.js"></script>
    <script type="text/javascript" src="js/count-to.js"></script>
    <script type="text/javascript" src="js/jquery.textillate.js"></script>
    <script type="text/javascript" src="js/jquery.lettering.js"></script>
    <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.parallax.js"></script>
    <script type="text/javascript" src="js/jquery.slicknav.js"></script>
    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>

    <!-- Container -->
    <div id="container">

        <!-- Start Header -->
        <div class="hidden-header"></div>
        <header class="clearfix">
            <!-- Start  Logo & Naviagtion  -->
            <div class="navbar navbar-default navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Stat Toggle Nav Link For Mobiles -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" 
						data-target=".navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        <a class="navbar-brand" href="adminhome.php">
                            <img alt="" src="images/margo2.png" style="margin-top:-10px;">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="agentHome.php">Home</a>
                            </li>
                            <li>
                                <a href="#"><?php echo $_SESSION["Id"]; ?></a>
                                <ul class="dropdown">
								<li>
                                        <a href="agentPassReset.php">ChangePassword</a>
                                    </li>
                                    <li>
                                        <a href="adminlogout.php">logOut</a>
                                    </li>
									
                                </ul>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
                <!-- Mobile Menu Start -->
                <ul class="wpb-mobile-menu">
                    <li>
                        <a href="agentHome.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><?php echo $_SESSION["Id"]; ?></a>
                        <ul class="dropdown">
						<li>
                                        <a href="agentPassReset.php">ChangePassword</a>
                                    </li>
                            <li>
                                <a href="adminlogout.php">logOut</a>
                            </li>
							<a href="agentPassReset.php">ChangePassword</a>
                        </ul>
                    </li>
                </ul>
                <!-- Mobile Menu End -->
            </div>
            <!-- End Header Logo & Naviagtion -->

        </header>
        <!-- End Header -->
        
        <!-- Start Page Banner -->
        <div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2><?php echo $_SESSION["Id"]; ?></h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#">Home</a></li>
                            <li>Agent PasswordReset</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
          <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Agent Password Reset</span></h4>
                <!-- Start Contact Form -->
                <form role="form" class="contact-form" id="contact-form" method="post"
				autocomplete="off">
                    <?php
			if ( isset($errMSG) ) {
				
				?>
                    <div class="col-sm-12">
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                    </div>
                <?php
			}
			?>
                  <div class="col-sm-12">
              <div class="form-group">
                  <label class="control-label">New Password:</label>
                <div class="controls">
                  <input type="password" placeholder="Password" name="password">
                </div>
              </div>
                  </div>
                    <div class="col-sm-4">
                        <button type="submit" id="Reset" 
						class="btn-system btn-large" name="Reset">Reset</button>
                        <div id="success" style="color:#34495e;"></div>
                    </div>      
            </form>
                <!-- End Contact Form -->
            <div class="col-md-8">
        </div>
            </div>
          </div>
        </div>
        </div>
      
        <!-- Divider -->
        <div class="hr1" style="margin-bottom:50px;"></div>
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>