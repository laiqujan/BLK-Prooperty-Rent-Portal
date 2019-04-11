<?php
ob_start();
session_start();

include("db/opendb.php");


// it will never let you open index(login) page if session is set
if ( isset($_SESSION['Id'])!="" ) {
    if($_SESSION['user']=="agent"){
        header("Location: agentHome.php");
		exit;
    }
    if($_SESSION['user']=="tenant"){
        header("Location: tenantHome.php");
        exit;
    }
}

if(isset($_POST['agentSignUp'])==true){
	
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
    // password encrypt using SHA256();
    $password = hash('sha256', $pass);
	$phone=$_POST['phone'];	
	$regNo=$_POST['regNo'];
	$agency=$_POST['agency'];
	$insert="insert into agent(FirstName,SurName,Email,PhoneNumber,RegistrationNo,AgencyName,Password)                    
	values(:FirstName,:SurName,:Email,:PhoneNumber,:RegistrationNo,:AgencyName,:Password)";
	try
    {
		$stmt=$con->prepare($insert);
		$stmt->bindParam(':FirstName',$name);
		$stmt->bindParam(':SurName',$surname);
		$stmt->bindParam(':Email',strtolower($email));
		$stmt->bindParam(':PhoneNumber',$phone);
		$stmt->bindParam(':RegistrationNo',$regNo);
        $stmt->bindParam(':AgencyName',$agency);
		$stmt->bindParam(':Password',$password);
		$stmt->execute();
		$errTyp = "success";
        $errMSG = "Successfully registered, You can login now";
		// Send Email Notification        
$Aname = "BLK 1 SG";
$message = "Dear ".$name.",
Welcome to Blk1 Singapore, we are extremely delighted to have you on-board with us.
Check the requests posted by potential clients by logging to your account at http://www.blk1sg.com/agentLogin.php 
Should you ever forget your password and need it reset, simply click on the 'Forgot Your Password?' button at the sign-in page.
Feel free to contact us at support@blk1sg.com should you need any assistance regarding your account. 
Warmest regards,
Blk1 Singapore Team
";
$subject = "Welcome to Blk1 Singapore";

$to = $email;
$message = 'FROM: '.$Aname.' Message: '.$message;
$headers = 'From: support@blk1sg.com' . "\r\n";
 
if (filter_var($to, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
mail($to, $subject, $message, $headers); //This method sends the mail.
}else{
	$errTyp = "danger";
$errMSG = "Oops! Something went wrong.";
}
    echo "<script language='javascript' type='text/javascript'>
	window.location.href='agentLogin.php';</script>";
        
	}
	catch(PDOException $e)
    {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...";
	}
	 $con=NULL; 
}
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    <!-- Basic -->
    <title>BLK 1 Singapore | Agent Registration</title>
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
    <script type="text/javascript" src="js/validation.js"></script>
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
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        <a class="navbar-brand" href="index.php">
                            <img alt="" src="images/margo2.png" style="margin-top:-10px;">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="index.php">Home</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="about.php">About Us</a>
                                    </li>
                                    <li>
                                        <a href="404.php">Contact</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="active" href="#">Agent Login / Register</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="agentLogin.php">Log In</a>
                                    </li>
                                    <li>
                                        <a class="active" href="agentRegistration.php">Sign Up</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Tenant Login / Register</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="tenantLogin.php">Log In</a>
                                    </li>
                                    <li>
                                        <a href="tenantRegistration.php">Sign Up</a>
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
                                <a href="home.php">Home</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="about.php">About Us</a>
                                    </li>
                                    <li>
                                        <a href="404.php">Contact</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="active" href="#">Agent Login / Register</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="agentLogin.php">Log In</a>
                                    </li>
                                    <li>
                                        <a  class="active" href="agentRegistration.php">Sign Up</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Tenant Login / Register</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="tenantLogin.php">Log In</a>
                                    </li>
                                    <li>
                                        <a href="tenantRegistration.php">Sign Up</a>
                                    </li>
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
                        <h2>Agent Registration</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#">Home</a></li>
                            <li>Agent Registration</li>
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
            <div class="col-md-8">
                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Agent Sign Up</span></h4>
                <!-- Start Contact Form -->
                <form role="form" name="agentRegForm" class="contact-form" id="contact-form" method="post" autocomplete="off" onSubmit="return agentRegValidation();">
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
              <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">Full Name:</label>
                <div class="controls">
                  <input type="text" placeholder="Full Name" name="name">
                </div>
              </div>
                    </div>
                    <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">Surname:</label>
                <div class="controls">
                  <input type="text" placeholder="Surname" name="Surname">
                </div>
              </div>
                    </div>
                  <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">E-mail:</label>
                <div class="controls">
                  <input type="email" class="email" placeholder="E-mail" name="email">
                </div>
              </div>
                  </div>
                    <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Phone Number:</label>
                <div class="controls">
                  <input type="tel" placeholder="Phone Number" name="phone">
                </div>
              </div>
                </div>
                    <div class="col-sm-12">
              <div class="form-group">
                  <label class="control-label">Password:</label>
                <div class="controls">
                  <input type="password" placeholder="Password" name="pass">
                </div>
              </div>
                  </div>
                <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">Registration No:</label>
                <div class="controls">
                  <input type="text" placeholder="CEA Registration Number" name="regNo">
                </div>
              </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                  <label class="control-label">Agency:</label>
                <div class="controls">
                  <input type="text" placeholder="Agency" name="agency">
                </div>
              </div>
                    </div>
                    <?php
	    $code=mt_rand();
		$_SESSION['captcha']=$code;
        ?>
		<div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">Please Insert CAPTCHA to verify you are Human:</label>
                <div class="controls">
                  <input type="text" name="captcha" placeholder="<?php echo $code; ?>" disabled style="border-color:blue; background-color:#eee;font-weight:bold;">
                </div>
              </div>
                  </div>
				   <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">CAPTCHA:</label>
                <div class="controls">
                  <input type="text" placeholder="CAPTCHA" name="recaptcha">
                </div>
              </div>
                    </div>
                    
                        <div class="col-sm-12">
                        <button type="submit" id="submit" class="btn-system btn-large" name="agentSignUp">Sign Up</button>
                        <div id="success" style="color:#34495e;"></div>
                        </div>
                    <div class="col-sm-12">
                        <label> Already a member? </label>
                        <a href="agentLogin.php">Log In</a></div>
                        
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
        

        <!-- Start Footer -->
        <footer style="margin-top:-60px;">
            <div class="container">
                
                <div class="copyright-section" style="margin-top:50px;">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; 2016 BLK 1 Singapore - All Rights Reserved <a href="">Rapto Tech</a> </p>
                        </div>
                        <div class="col-md-6 footer-widget social-widget">
                            <ul class="footer-nav social-icons">
                                <li><a href="404.php" style="color:white;">Contact</a></li>
                                <li><a href="FAQs.php" style="color:white;">FAQs</a></li>
                                <li><a href="policy.php" style="color:white;">Privacy Policy</a></li>
                                <li><a href="terms.php" style="color:white;">Terms of Use</a></li>
								<li>
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Copyright -->
            </div>
        </footer>
        <!-- End Footer -->
    </div>
    <!-- End Container -->
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>