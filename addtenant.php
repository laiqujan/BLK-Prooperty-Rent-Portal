<?php
/// authentication code
session_start(); 
$msg="";
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
if(isset($_POST['tenantSignUp'])==true){
	
	$name=$_POST['name'];
	
    $emailid=$_POST['email'];
	$email = strtolower($emailid);
    
    $pass=$_POST['pass'];
    // password encrypt using SHA256();
    $password = hash('sha256', $pass);
    
	$phone=$_POST['phone'];	
	$insert="insert into tenant(Name,Email,PhoneNumber,Password)                    
	values(:Name,:Email,:PhoneNumber,:Password)";
	try
    {
		$stmt=$con->prepare($insert);
		$stmt->bindParam(':Name',$name);
		$stmt->bindParam(':Email',$email);
		$stmt->bindParam(':PhoneNumber',$phone);
		$stmt->bindParam(':Password',$password);
		$stmt->execute();
        $errTyp = "success";
        $errMSG = "Successfully registered";
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
    <title>BLK 1 Singapore | Add Tenant</title>
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
                                <a href="#"><?php
		                                    echo $_SESSION["Id"]; ?></a>
                                <ul class="dropdown">
								<li>
                                        <a href="adminResetPassword.php">ChangePassword</a>
                                    </li>
                                    <li>
                                        <a href="adminlogout.php">logOut</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Posts</a>
                                   <ul class="dropdown">
                                  <li>
                                        <a href="request.php">Requests</a>
                                    </li>
                                    <li>
                                        <a href="response.php">Response</a>
                                    </li>
                                </ul>
                            </li>
                            
							<li>
                                <a  href="#">Agents</a>
                                <ul class="dropdown">
                                    <li>
                                        <a class="active" href="viewagents.php">View/Edit</a>
                                    </li>
                                    <li>
                                        <a href="addagent.php">Add</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Tenants</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="viewtenants.php">View/Edit</a>
                                    </li>
                                    <li>
                                        <a href="addtenant.php">Add</a>
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
                                <a href="#"><?php
		                                    echo $_SESSION["Id"]; ?></a>
                                <ul class="dropdown">
								<li>
                                        <a href="adminResetPassword.php">ChangePassword</a>
                                    </li>
                                    <li>
                                         <a href="adminlogout.php">logOut</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="#">Posts</a>
                              <ul class="dropdown">
                                    <li>
                                        <a href="request.php">Requests</a>
                                    </li>
                                    <li>
                                        <a href="response.php">Response</a>
                                    </li>
                                </ul>
                            </li>
                          <li>
                                <a href="#">Agents</a>
                                <ul class="dropdown">
                                    <li>
                                        <a class="active" href="viewagents">View/Edit</a>
                                    </li>
                                    <li>
                                        <a href="addagent.php">Add</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Tenants</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="viewtenants.php">View/Edit</a>
                                    </li>
                                    <li>
                                        <a href="addtenant.php">Edit</a>
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
                        <h2>Add Tenant</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#">Admin Home</a></li>
                            <li>Add Tenant</li>
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
                <h4 class="classic-title"><span>Add Tenant By Admin</span></h4>
                <!-- Start Contact Form -->
                <form role="form" class="contact-form" name="addTenantForm" id="contact-form" method="post" autocomplete="off" onSubmit="return addTenantValidation();">
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
                  <label class="control-label">First Name:</label>
                <div class="controls">
                  <input type="text" placeholder="First Name" name="name">
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
                        <div class="col-sm-12">
                        <button type="submit" id="submit" 
						class="btn-system btn-large" name="tenantSignUp">Add</button>
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
    </div>
    <!-- End Container -->
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>