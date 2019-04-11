
<?php 

include("db/opendb.php");
session_start();
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
	if($_SESSION['user']=="admin"){
        header("Location: adminhome.php");
        exit;
    }
}
$msg="";
if(isset($_POST['login']))
{	
$userid =	$_POST['username'];
$pass = $_POST['password'];	
// password encrypt using SHA256();
$password = hash('sha256', $pass);
$sql = "select * from admin where UserName='$userid' and Password='$password'";
$ctr=0;
    $user="admin";
	try
	{
		$result = $con->query($sql);	
		foreach($result as $row)
		{			
         $ctr++;		
	    }
	}
	catch(PDOException $e)
	{
		$errTyp = "danger";
        $errMSG = "Something went wrong, try again later...";
	}
if($ctr == 0)
{
	$errTyp = "danger";
    $errMSG = "Invalid Username | Password.";
}
else
{
	$res = $con->query($sql);
	    //session_start();
		$_SESSION['Id']=$userid;	
		$_SESSION['user']=$user;	
		
    echo "<script language='javascript' type='text/javascript'>
	window.location.href='adminhome.php';</script>";
}
}	
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    <!-- Basic -->
    <title>BLK 1 Singapore | Admin Login</title>
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
            <!-- Start Page Banner -->
        <div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Admin Console</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#">Admin</a></li>
                            <li>Admin Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

    <!-- Container -->
    <div id="container"> 
        <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Admin Log In</span></h4>
                <!-- Start Contact Form -->
				 
                <form role="form" class="contact-form" id="contact-form" method="post">
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
                  <label class="control-label">Email:</label>
                <div class="controls">
                  <input type="text" placeholder="Email" id="username" name="username">
                </div>
              </div>
                </div>
                  <div class="col-sm-12">
              <div class="form-group">
                  <label class="control-label">Password:</label>
                <div class="controls">
                  <input type="password" placeholder="Password" id="password" name="password">
                </div>
              </div>
                  </div>
                    <div class="col-sm-4">
                        <button type="submit" id="login" name="login" class="btn-system btn-large">
						Log In</button>
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