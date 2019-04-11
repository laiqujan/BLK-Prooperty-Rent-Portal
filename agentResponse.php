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
$requestId = $_GET['id'];

$query3 = "select * from tenacyrequest";
$result3 = $con -> query($query3) or die("Query error");
$query4 = "select COUNT(RequestId) from response where Email='$email' GROUP BY RequestId";
$result4 = $con -> query($query4) or die("Query error");
$unresponsed=0;$request=0;$response=0;$temp=0;

foreach($result3 as $row)
		{			
         $request++;		
	    }
foreach($result4 as $row)
		{			
         $response++;
	    }
$unresponsed=$request-$response;
if(isset($_POST['sendResponse'])==true){
    
	$price=$_POST['price'];
	$detail=$_POST['detail'];
	$term=$_POST['term'];
	$pincode=$_POST['pincode'];
	$url=$_POST['url'];
    $priceNego=$_POST['priceNego'];
    $status="pending";
	$insert="insert into response(RequestId,Email,Price,PropertyDetails,ContractTerm,Pincode,URL,PriceNegotiable,Status)                    
	values(:RequestId,:Email,:Price,:PropertyDetails,:ContractTerm,:Pincode,:URL,:PriceNegotiable,:Status)";
	try
    {
		$stmt=$con->prepare($insert);
		$stmt->bindParam(':RequestId',$requestId);
		$stmt->bindParam(':Email',$email);
		$stmt->bindParam(':Price',$price);
		$stmt->bindParam(':PropertyDetails',$detail);
        $stmt->bindParam(':ContractTerm',$term);
		$stmt->bindParam(':Pincode',$pincode);
        $stmt->bindParam(':URL',$url);
        $stmt->bindParam(':PriceNegotiable',$priceNego);
        $stmt->bindParam(':Status',$status);
		$stmt->execute();
        $errTyp = "success";
        $errMSG = "Response submitted successfully"; 
           // Send Email Notification
$q = "select Email from tenacyrequest where RequestId ='$requestId'";
$res = $con -> query($q) or die("Query error");
        foreach($res as $row){
            $tenantEmail = $row['Email'];
        }
        
    
        $q1 = "select Name from tenant where Email ='$tenantEmail'";
  $res1 = $con -> query($q1) or die("Query error");
        foreach($res1 as $row1){
            $tname = $row1['Name'];
        }
        
        
$name = "BLK 1 SG";
$message = "Dear ".$tname.",
We wish to inform you that you have received a response for your request posted. 
Please check the responses by logging to your account at http://www.blk1sg.com/tenantLogin.php
If you have already found your property, please remove your listing by logging to your account. 
We would like to remind you again that agents are not supposed to collect any commission from the you.
If the response you received is not genuine or if the agent tried to collect commission from you, please report the agent at http://www.blk1sg.com/contactus.php or by sending an email to support@blk1sg.com
Warmest regards,
Blk1 Singapore Team
";
$subject = "Response received for your request";

$to = $tenantEmail;
$message = 'FROM: '.$name.' Message: '.$message;
$headers = 'From: support@blk1sg.com' . "\r\n";
 
if (filter_var($to, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
mail($to, $subject, $message, $headers); //This method sends the mail.
$errMSG = "Response submitted successfully, Email Notification Sent to the Tenant."; 
}else{
$errMSG = "Oops! Something went wrong.";
}     


	}
	catch(PDOException $e)
    {
        $errTyp = "danger";
        $errMSG = "Oops! Something went wrong.";
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
    <!-- icheck CSS style -->
    <link href="css/icheck/flat/red.css" rel="stylesheet">

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
                        <a class="navbar-brand" href="agentHome.php">
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
                            <li>Agent Home</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        <!--Start Content-->
        <div class="content">
            <div class="container">
		    <div class="row" style="text-align:center; margin-top:30px;">
			<div class="col-md-4">
			<h1 style="color:silver">Total Requests</h1>
			<h1><?php echo $request; ?></h1>
			</div>
			<div class="col-md-4">
			<h1 style="color:silver">Responsed Requests</h1>
			<h1><?php echo $response; ?></h1>	
			</div>
            <div class="col-md-4">
			<h1 style="color:silver">Unresponsed Requests</h1>
			<h1><?php echo $unresponsed; ?></h1>
			</div>
			</div>
			</div>
        </div>
        <!-- -->
        <!-- Divider -->
            <div class="hr5" style="margin-top:30px;"></div>
        <!--All Request Container -->
        <div class="container" style="margin-top:30px;">
        <div class="row">
            <h4 class="classic-title"><span>Request Details</span></h4>
    <?php include("db/opendb.php"); 
	$query = "select * from tenacyrequest where RequestId ='$requestId'";
	$result = $con -> query($query) or die("Query error");
	?> 
	<table class="table">
  <thead class="thead-inverse">
    <tr>	
      <th>RequestId</th>
      <th>Email</th>
      <th>Name</th>
      <th>Race</th>
	  <th>Pax</th>
	  <th>Occupation</th>
	  <th>Relationship</th>
      <th>ImgrationStatus</th>
      <th>PropertyType</th>
      <th>Budget</th>
	  <th>Location</th>
      <th>Furnishing</th>
	  <th>Comments</th>
    </tr>
  </thead>
  <tbody>
   <?php 
	  foreach($result as $row)
	  {
	  ?>
    <tr>	
      <td><?php echo $row['RequestId']; ?></td>
      <td><?php echo $row['Email']; ?></td>
	  <td><?php echo $row['Name']; ?></td>
	  <td><?php echo $row['Race']; ?></td>
	  <td><?php echo $row['Pax']; ?></td>
	  <td><?php echo $row['Occupation']; ?></td>
	  <td><?php echo $row['Relationship']; ?></td>
	  <td><?php echo $row['ImgrationStatus']; ?></td>
	  <td><?php if($row['PropertyType']=='1'){ echo "HDB";} else{echo "Private Property";} ?></td>
	  <td><?php echo $row['Budget']; ?></td>
	  <td><?php echo $row['Location']; ?></td>
	  <td><?php echo $row['Furnishing']; ?></td>
	  <td><?php echo $row['Comments']; ?></td>
    </tr>
	 <?php
	  }
	  ?>
  </tbody>
</table></div>
        </div>
        <!--All Request Container -->
        <!--All Request Container -->
        <div class="container" style="margin-top:30px;">
        <div class="row">
            <h4 class="classic-title"><span>Response</span></h4>
                            <!-- Start Contact Form -->
                <form role="form" class="contact-form" name="agentResponseForm" id="contact-form" method="post" autocomplete="off" onSubmit="return agentResponseValidation();">
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
                  <label class="control-label">Price:</label>
                <div class="controls">
                  <input type="text" placeholder="Monthly rental" name="price">
                </div>
              </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Property Details:</label>
                    <div class="controls">
                        <input type="text" placeholder="Nearby Amenities, Distance to MRT etc" name="detail">
                    </div>
                    </div>
                    </div>
                    
                    <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Contract Term:</label>
                        <div class="controls">
						<input type="text" placeholder="Contract term in months" name="term">
                        </div>
                    </div>
                    </div> 
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">ZIP code:</label>
                    <div class="controls">
                        <input type="text" placeholder="ZIP code" name="pincode">
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Property URL: (Optional)</label>
                    <div class="controls">
                        <input type="text" placeholder="URL of the property listing if you have listed anywhere else" name="url">
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">Price Negotiable:</label>
                        <div class="controls">
                            Yes : <input type="radio" class="flat" name="priceNego" value="1" checked="" required /> 
                            No : <input type="radio" class="flat" name="priceNego" value="0" />
                        </div>
                    </div>
                    </div> 
                <div class="col-sm-12">
                <button type="submit" id="submit" class="btn-system btn-large" name="sendResponse">Send</button>
                <div id="success" style="color:#34495e;"></div>
                </div>
            </form>
                <!-- End Contact Form -->
        </div>
        </div>
        <!--All Request Container -->
        <!-- Divider -->
        <div class="hr1" style="margin-bottom:50px;"></div>
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script type="text/javascript" src="js/script.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>
</body>

</html>