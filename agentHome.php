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

$query3 = "select * from tenacyrequest";
$result3 = $con -> query($query3) or die("Query error");
$query4 = "select COUNT(RequestId) from response where Email='$email' GROUP BY RequestId";
$result4 = $con -> query($query4) or die("Query error");
$unresponsed=0;$request=0;$response=0;

foreach($result3 as $row)
		{			
         $request++;		
	    }
foreach($result4 as $row)
		{			
         $response++;		
	    }
$unresponsed = $request - $response;

if(isset($_POST['search'])==true){
	$sProp=$_POST['sProp'];
	$location = "";
	if(isset($_POST['location'])){
    $loc=$_POST['location'];
    foreach($loc as $row){
		$location = $location .','.$row;
	}
	}
        
	$sBudget=$_POST['sBudget'];
	
	
	$queryS = "select * from tenacyrequest where PropertyType='$sProp' OR Location = '$location' OR Budget = '$sBudget'
    OR Location Like '$location%'  OR Location Like '%$location%' 
    
    ";
	$result = $con -> query($queryS) or die("Query error");
}
else{
	$query = "select * from tenacyrequest";
	$result = $con -> query($query) or die("Query error");
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
	        <!-- select2 -->
    <link href="css/select/select2.min.css" rel="stylesheet">

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
        <!--Start Content -->
        <!-- Divider -->
            <div class="hr5" style="margin-top:30px;"></div>
        <!--All Request Container -->
        <div id="content">
        <div class="container">
        <div class="row">
            <h4 class="classic-title"><span>All Requests by Tenants</span></h4>
			<form role="form" name="" class="contact-form" id="contact-form" method="post" autocomplete="off">
			                    <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Search By Property Type:</label>
                                    <select class="form-control" name="sProp">
                                        <option value="">Choose option</option>
                                        <option value="1">HDB</option>
                                        <option value="2">Private Property</option>
                                    </select>
                                </div>
                            </div>
					<div class="col-sm-3">
                      <div class="form-group">
                      <label class="control-label">Search by Location</label>
                        <select class="select_multiple_location form-control" id="location" name="location[]" multiple="multiple">
                            <optgroup label="Select your location">
							<option value="">Choose any</option>
                                
                            <option value="D01 Boat Quay / Raffles Place / Marina">D01 Boat Quay / Raffles Place / Marina</option>
                                
                            <option value="D02 Chinatown / Tanjong Pagar">D02 Chinatown / Tanjong Pagar</option>
                                
                            <option value="D03 Alexandra / Commonwealth">D03 Alexandra / Commonwealth</option>
                                
                            <option value="D04 Harbourfront / Telok Blangah">D04 Harbourfront / Telok Blangah</option>
                                
                            <option value="D05 Buona Vista / West Coast / Clementi New Town">D05 Buona Vista / West Coast / Clementi New Town</option>
                                
                            <option value="D06 City Hall / Clarke Quay">D06 City Hall / Clarke Quay</option>
                                
                            <option value="D07 Beach Road / Bugis / Rochor">D07 Beach Road / Bugis / Rochor</option>
                                
                            <option value="D08 Farrer Park / Serangoon Rd">D08 Farrer Park / Serangoon Rd</option>
                                
                            <option value="D09 Orchard / River Valley">D09 Orchard / River Valley</option>
                                
                            <option value="D10 Tanglin / Holland / Bukit Timah">D10 Tanglin / Holland / Bukit Timah</option>
                                
                            <option value="D11 Newton / Novena">D11 Newton / Novena</option>
                                
                            <option value="D12 Balestier / Toa Payoh">D12 Balestier / Toa Payoh</option>
                                
                            <option value="D13 Macpherson / Potong Pasir">D13 Macpherson / Potong Pasir</option>
                                
                            <option value="D14 Eunos / Geylang / Paya Lebar">D14 Eunos / Geylang / Paya Lebar</option>
                                
                            <option value="D15 East Coast / Marine Parade">D15 East Coast / Marine Parade</option>
                                
                            <option value="D16 Bedok / Upper East Coast">D16 Bedok / Upper East Coast</option>
                                
                            <option value="D17 Changi Airport / Changi Village">D17 Changi Airport / Changi Village</option>
                                
                            <option value="D18 Pasir Ris / Tampines">D18 Pasir Ris / Tampines</option>
                                
                            <option value="D19 Hougang / Punggol / Sengkang" >D19 Hougang / Punggol / Sengkang</option>
                                
                            <option value="D20 Ang Mo Kio / Bishan / Thomson">D20 Ang Mo Kio / Bishan / Thomson</option>
                                
                            <option value="D21 Clementi Park / Upper Bukit Timah">D21 Clementi Park / Upper Bukit Timah</option>
                                
                            <option value="D22 Boon Lay / Jurong / Tuas">D22 Boon Lay / Jurong / Tuas</option>
                                
                            <option value="D23 Dairy Farm / Bukit Panjang / Choa Chu Kang">D23 Dairy Farm / Bukit Panjang / Choa Chu Kang</option>
                                
                            <option value="D24 Lim Chu Kang / Tengah">D24 Lim Chu Kang / Tengah</option>
                                
                            <option value="D25 Admiralty / Woodlands">D25 Admiralty / Woodlands</option>
                                
                            <option value="D26 Mandai / Upper Thomson">D26 Mandai / Upper Thomson</option>
                                
                            <option value="D27 Sembawang / Yishun">D27 Sembawang / Yishun</option>
                                
                            <option value="D28 Seletar / Yio Chu Kang">D28 Seletar / Yio Chu Kang</option>
                            </optgroup>
                        </select>
                      </div>
                    </div>
					<div class="col-sm-3">
					
                    <div class="form-group">
                      <label class="control-label"> Search by Budget:</label>
                        <div class="controls">
                            <select class="form-control" name="sBudget">
                                <option value="">Choose option</option>
                                <option value="0-$1500">0-$1500</option>
                                <option value="$1500-$2000">$1500-$2000</option>
                                <option value="$2000-$2500">$2000-$2500</option>
                                <option value="$2500-$3000">$2500-$3000</option>
                                <option value="$3000-$4000">$3000-$4000</option>
                                <option value="$4000+">$4000+</option>
                            </select>
                        </div>
                    </div>
                    </div> 
					<div class="col-sm-3">
                        <button type="submit" id="search" class="btn-system btn-large" name="search" style="margin-top:25px;">Search</button>
                        <div id="success" style="color:#34495e;"></div>
                        </div>
			</form>

	<table class="table">
  <thead class="thead-inverse">
    <tr>	
      <th>RId</th>
      <th>Race</th>
	  <th>Pax</th>
	  <th>Occupation</th>
	  <th>Relationship</th>
      <th>ImmigrationStatus</th>
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
	  <td><a href="agentResponse.php?id=<?php echo $row['RequestId']; ?>">Response</a></td>

    </tr>
	 <?php
	  }
	  ?>
  </tbody>
</table></div>
        </div>
            </div>
        <!--All Request Container -->
        
        <!--Response Container -->
        <div class="container" style="margin-top:30px;">
        <div class="row">
            <h4 class="classic-title"><span>Response</span></h4>
            <?php include("db/opendb.php"); 
	$query = "select * from response where Email = '$email'";
	$result = $con -> query($query) or die("Query error");
	?> 
	<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>RequestId</th>
      <th>ResponseId</th>
      <th>Email</th>
	  <th>Price</th>
	  <th>PropertyDetails</th>
	  <th>ContractTerm</th>
      <th>Pincode</th>
      <th>URL</th>
      <th>Price Negotiable</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
   <?php 
	  foreach($result as $row)
	  {
	  ?>
    <tr>	
      <td><?php echo $row['RequestId']; ?></td>
	  <td><?php echo $row['ResponseId']; ?></td>
	  <td><?php echo $row['Email']; ?></td>
	  <td><?php echo $row['Price']; ?></td>
	  <td><?php echo $row['PropertyDetails']; ?></td>
	  <td><?php echo $row['ContractTerm']; ?></td>
	  <td><?php echo $row['Pincode']; ?></td>
	  <td><a href="<?php echo $row['Url']; ?>" target="_blank"><?php echo $row['Url']; ?></a></td>
	  <td><?php if($row['PriceNegotiable']=='1'){ echo "Yes";} else{echo "No";}  ?></td>
      <td><?php if($row['Status']=="pending"){ echo "pending"; } else if($row['Status']=="accepted"){ ?><a href="viewTenantDetails.php?id=<?php echo $row['RequestId']; ?>" name="accept" class="">View Tenant Details</a> <?php } ?></td>
	  <td><a href="removeresponse.php?id=<?php echo $row['ResponseId']; ?>">Remove</a></td>
	
	</tr>
	 <?php
	  }
	  ?>
  </tbody>
</table>
        </div>
        </div>
        <!--Response Container -->
        <!-- Divider -->
        <div class="hr1" style="margin-bottom:50px;"></div>
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script type="text/javascript" src="js/script.js"></script>
	        <!-- select2 -->
    <script src="js/select/select2.full.js"></script>
    <!-- select2 -->
    <script>
        $(document).ready(function() {
            $(".select2_single").select2({
                placeholder: "Select a state",
                allowClear: true
            });
            $(".select2_group").select2({});
            $(".select2_multiple").select2({
                maximumSelectionLength: 4,
                placeholder: "Choose At least one",
                allowClear: true
            });
            $(".select_multiple_location").select2({
                maximumSelectionLength: 6,
                placeholder: "Choose At least one (max 6)",
                allowClear: true
            });
        });
    </script>
  <!-- /select2 -->
</body>

</html>