<?php
ob_start();
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

include("db/opendb.php");
$indexType="";
$indexBudget="";
$indexLocation ="";
$email=$_SESSION['Id'];
if( isset($_GET['id']) == TRUE){
        if($_GET['id'] == "req"){
        $indexType = $_GET['type'];
        $indexBudget = $_GET['budget'];
        $indexLocation = $_GET['location'];
        
    }
}



if(isset($_POST['submitRequest'])==true){
	
	$name=$_POST['name'];
	$race=$_POST['race'];
	$bedrooms=$_POST['bedrooms'];
	$pax=$_POST['pax'];
	$occupation=$_POST['occupation'];
	$type=$_POST['type'];	
	$budget=$_POST['budget'];
	$relation=$_POST['relation'];
    $immigration=$_POST['immigration'];
    
    if(isset($_POST['location'])){
        $loc=$_POST['location'];
        $location = "";
        foreach($loc as $row)
            $location = $location .','.$row;
        
        if(isset($_POST['furnishing'])){
            $furnish=$_POST['furnishing'];
            $furnishing = "";
            foreach($furnish as $row)
                $furnishing = $furnishing.','.$row;
            
            $comment=$_POST['comment'];
            $insert="insert into tenacyrequest(PropertyType,Email,Budget,Location,bedrooms,Name,Race,Pax,Occupation,Relationship,ImgrationStatus,Furnishing,Comments) values(:PropertyType,:Email,:Budget,:Location,:bedrooms,:Name,:Race,:Pax,:Occupation,:Relationship,:ImgrationStatus,:Furnishing,:Comments)";
            try
            {
                $stmt=$con->prepare($insert);
                $stmt->bindParam(':Email',$email);
                $stmt->bindParam(':PropertyType',$type);
                $stmt->bindParam(':Budget',$budget);
                $stmt->bindParam(':Location',$location);
				$stmt->bindParam(':bedrooms',$bedrooms);
                $stmt->bindParam(':Name',$name);
                $stmt->bindParam(':Race',$race);
                $stmt->bindParam(':Pax',$pax);
                $stmt->bindParam(':Occupation',$occupation);
                $stmt->bindParam(':Relationship',$relation);
                $stmt->bindParam(':ImgrationStatus',$immigration);
                $stmt->bindParam(':Furnishing',$furnishing);
                $stmt->bindParam(':Comments',$comment);
                $stmt->execute();
                $errTyp = "success";
                $errMSG = "Request Submitted Successfully";
            }
            catch(PDOException $e)
            {
                $errTyp = "danger";
                $errMSG = "Oops! Something went wrong.".$e;
                //$type .",". $budget .",". $name .",". $location .",". $race .",". $pax .",". $occupation .",". $relation .",". $immigration .",". $furnishing .",". $comment;
            }
            $con=NULL; 
        }
        else
        {
            $errTyp = "danger";
            $errMSG = "Oops! You missed some mandatory Fields.";
        }
    }
    else
    {
        $errTyp = "danger";
        $errMSG = "Oops! You missed some mandatory Fields.";
    }
}
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    <!-- Basic -->
    <title>BLK 1 Singapore | Tenancy Request</title>
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
    <!-- ion_range -->
    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />

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
                        <a class="navbar-brand" href="tenantHome.php">
                            <img alt="" src="images/margo2.png" style="margin-top:-10px;">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="tenantHome.php">Home</a>
                            </li>
                            <li>
                                <a href="tenancyRequest.php">New Request</a>
                            </li>
                            <li>
                                <a href="#"><?php echo $_SESSION["Id"]; ?></a>
                                <ul class="dropdown">
									<li>
                                        <a href="tenantPassReset.php">ChangePassword</a>
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
                                <a href="tenantHome.php">Home</a>
                            </li>
                            <li>
                                <a href="tenancyRequest.php">New Request</a>
                            </li>
                            <li>
                                <a href="#"><?php echo $_SESSION["Id"]; ?></a>
                                <ul class="dropdown">
									<li>
                                        <a href="tenantPassReset.php">ChangePassword</a>
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
                        <h2>Tenancy Request</h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumbs">
                            <li><a href="#">Home</a></li>
                            <li>Tenancy Request</li>
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
                <h4 class="classic-title"><span>Tenancy Request Form</span></h4>
                <!-- Start Contact Form -->
                <form role="form" name="tenancyRequestForm" class="contact-form"
				id="contact-form" method="post" autocomplete="off"
				onSubmit="return tenancyRequestValidation();">
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
                  <label class="control-label">Name: (Alphabets Only)</label>
                <div class="controls">
                  <input type="text" placeholder="Name" name="name">
                </div>
              </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Race: (Alphabets Only)</label>
                    <div class="controls">
                        <input type="text" placeholder="Race" name="race">
                    </div>
                    </div>
                    </div>
					 <div class="col-sm-12">
                    <div class="form-group">
                    <label class="control-label">Occupation:</label>
                    <div class="controls">
                        <input type="text" placeholder="Occupation" name="occupation">
                    </div>
                    </div>
                    </div>
					<div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">BedRooms:</label>
                        <select class="form-control" name="bedrooms">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Pax:</label>
                        <select class="form-control" name="pax">
                            <option value="0">Choose option</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="8+">8+</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Property Type:</label>
                                    <select class="form-control" name="type">
                                        <option value="0">Choose option</option>
                                        <option value="1" <?php if($indexType == "1" || $_SESSION['types']=="1"){echo "selected";}else{echo "";}?> >HDB</option>
                                        <option value="2" <?php if($indexType == "2" || $_SESSION['types']=="2"){echo "selected";}else{echo "";}?> >Private Property</option>
                                    </select>
                                </div>
                            </div>
                    <div class="col-sm-6">
					
                    <div class="form-group">
                      <label class="control-label">Budget:</label>
                        <div class="controls">
                            <select class="form-control" name="budget">
                                <option value="0">Choose option</option>
                                <option value="0-$1500" <?php if($indexBudget == "0-$1500" || $_SESSION['budgets']== "0-$1500"
                                                                ){echo "selected";}else{echo "";}?> >0-$1500</option>
                                <option value="$1500-$2000" <?php if($indexBudget == "$1500-$2000" || $_SESSION['budgets']== "$1500-$2000"
                                                                    ){echo "selected";}else{echo "";}?> >$1500-$2000</option>
                                <option value="$2000-$2500" <?php if($indexBudget == "$2000-$2500" || $_SESSION['budgets']== "$2000-$2500"
                                                                    ){echo "selected";}else{echo "";}?> >$2000-$2500</option>
                                <option value="$2500-$3000" <?php if($indexBudget == "$2500-$3000" || $_SESSION['budgets']== "2500-$3000"
                                                                    ){echo "selected";}else{echo "";}?> >$2500-$3000</option>
                                <option value="$3000-$4000" <?php if($indexBudget == "$3000-$4000" || $_SESSION['budgets']== "$3000-$4000"
                                                                    ){echo "selected";}else{echo "";}?> >$3000-$4000</option>
                                <option value="$4000+" <?php if($indexBudget == "$4000+"|| $_SESSION['budgets']== "$4000+"
                                                               ){echo "selected";}else{echo "";}?> >$4000+</option>
                            </select>
                        </div>
                    </div>
                    </div>  
                    <div class="col-sm-12">
                    <div class="form-group">
                    <label class="control-label">Relationship Between Tenants: (Alphabets Only)</label>
                    <div class="controls">
                        <input type="text" placeholder="Relationship Between Tenants - Family, Friends, Two Couples" name="relation">
                    </div>
                    </div>
                    </div>
                    
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Immigration status of tenants: (Alphabets Only)</label>
                        <div class="controls">
                            <input type="text" placeholder="Immigration status of tenants - citizen, ep, work permit, student pass" name="immigration">
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="form-group">
                      <label class="control-label">Location</label>&nbsp;<label class="control-label" id="locationLBL" name="locationLBL"></label>
                        <select class="select_multiple_location form-control" id="location" name="location[]" multiple="multiple">
                            <optgroup label="Select your location">
                                
                            <option value="D01 Boat Quay / Raffles Place / Marina" <?php if(strpos($indexLocation,"D01 Boat Quay / Raffles Place / Marina") !== false || $_SESSION['locations']=="D01 Boat Quay / Raffles Place / Marina"
                                                                                           ){echo "selected";}else{echo "";}?> >D01 Boat Quay / Raffles Place / Marina</option>
                                
                            <option value="D02 Chinatown / Tanjong Pagar" <?php if(strpos($indexLocation,"D02 Chinatown / Tanjong Pagar") !== false ||$_SESSION['locations']=="D02 Chinatown / Tanjong Pagar"
                                                                                  ){echo "selected";}else{echo "";}?> >D02 Chinatown / Tanjong Pagar</option>
                                
                            <option value="D03 Alexandra / Commonwealth" <?php if(strpos($indexLocation,"D03 Alexandra / Commonwealth" ) !== false ||$_SESSION['locations']=="D03 Alexandra / Commonwealth"
                                                                                 ){echo "selected";}else{echo "";}?> >D03 Alexandra / Commonwealth</option>
                                
                            <option value="D04 Harbourfront / Telok Blangah" <?php if(strpos($indexLocation,"D04 Harbourfront / Telok Blangah" ) !== false ||$_SESSION['locations']=="D04 Harbourfront / Telok Blangah"
                                                                                     ){echo "selected";}else{echo "";}?> >D04 Harbourfront / Telok Blangah</option>
                                
                            <option value="D05 Buona Vista / West Coast / Clementi New Town" <?php if(strpos($indexLocation,"D05 Buona Vista / West Coast / Clementi New Town") !== false ||$_SESSION['locations']=="D05 Buona Vista / West Coast / Clementi New Town"
                                                                                                      
                                                                                                     ){echo "selected";}else{echo "";}?> >D05 Buona Vista / West Coast / Clementi New Town</option>
                                
                            <option value="D06 City Hall / Clarke Quay" <?php if(strpos($indexLocation,"D06 City Hall / Clarke Quay") !== false
                            || $_SESSION['locations']=="D06 City Hall / Clarke Quay"                                                  
                                                                                
                                                                                ){echo "selected";}else{echo "";}?> >D06 City Hall / Clarke Quay</option>
                                
                            <option value="D07 Beach Road / Bugis / Rochor" <?php if(strpos($indexLocation,"D07 Beach Road / Bugis / Rochor") !== false || $_SESSION['locations']=="D07 Beach Road / Bugis / Rochor"
                                                                                    
                                                                                    ){echo "selected";}else{echo "";}?> >D07 Beach Road / Bugis / Rochor</option>
                                
                            <option value="D08 Farrer Park / Serangoon Rd" <?php if(strpos($indexLocation,"D08 Farrer Park / Serangoon Rd") !== false || $_SESSION['locations']=="D08 Farrer Park / Serangoon Rd"
                                                                                   
                                                                                   ){echo "selected";}else{echo "";}?> >D08 Farrer Park / Serangoon Rd</option>
                                
                            <option value="D09 Orchard / River Valley" <?php if(strpos($indexLocation,"D09 Orchard / River Valley") !== false||
                                $_SESSION['locations']=="D09 Orchard / River Valley"                                             
                                                                               ){echo "selected";}else{echo "";}?> >D09 Orchard / River Valley</option>
                                
                            <option value="D10 Tanglin / Holland / Bukit Timah" <?php if(strpos($indexLocation,"D10 Tanglin / Holland / Bukit Timah") !== false ||$_SESSION['locations']=="D10 Tanglin / Holland / Bukit Timah"
                                                                                        ){echo "selected";}else{echo "";}?> >D10 Tanglin / Holland / Bukit Timah</option>
                                
                            <option value="D11 Newton / Novena" <?php if(strpos($indexLocation,"D11 Newton / Novena") !== false
                                                ||$_SESSION['locations']=="D11 Newton / Novena"
                                                                        ){echo "selected";}else{echo "";}?> >D11 Newton / Novena</option>
                                
                            <option value="D12 Balestier / Toa Payoh" <?php if(strpos($indexLocation,"D12 Balestier / Toa Payoh") !== false
                                     ||$_SESSION['locations']=="D12 Balestier / Toa Payoh"
                                                                              ){echo "selected";}else{echo "";}?> >D12 Balestier / Toa Payoh</option>
                                
                            <option value="D13 Macpherson / Potong Pasir" <?php if(strpos($indexLocation,"D13 Macpherson / Potong Pasir") !== false ||$_SESSION['locations']=="D13 Macpherson / Potong Pasir"
                                                                                  
                                                                                  ){echo "selected";}else{echo "";}?> >D13 Macpherson / Potong Pasir</option>
                                
                            <option value="D14 Eunos / Geylang / Paya Lebar" <?php if(strpos($indexLocation,"D14 Eunos / Geylang / Paya Lebar") !== false ||$_SESSION['locations']=="D14 Eunos / Geylang / Paya Lebar"
                                                                                     ){echo "selected";}else{echo "";}?> >D14 Eunos / Geylang / Paya Lebar</option>
                                
                            <option value="D15 East Coast / Marine Parade" <?php if(strpos($indexLocation,"D15 East Coast / Marine Parade") !== false ||$_SESSION['locations']=="D15 East Coast / Marine Parade"
                                                                                   
                                                                                   ){echo "selected";}else{echo "";}?> >D15 East Coast / Marine Parade</option>
                                
                            <option value="D16 Bedok / Upper East Coast" <?php if(strpos($indexLocation,"D16 Bedok / Upper East Coast") !== false
                                   ||$_SESSION['locations']=="D15 East Coast / Marine Parade"
                                                                                 ){echo "selected";}else{echo "";}?> >D16 Bedok / Upper East Coast</option>
                                
                            <option value="D17 Changi Airport / Changi Village" <?php if(strpos($indexLocation,"D17 Changi Airport / Changi Village") !== false ||$_SESSION['locations']=="D17 Changi Airport / Changi Village"
                                                                                        
                                                                                        ){echo "selected";}else{echo "";}?> >D17 Changi Airport / Changi Village</option>
                                
                            <option value="D18 Pasir Ris / Tampines" <?php if(strpos($indexLocation,"D18 Pasir Ris / Tampines") !== false
                                           ||$_SESSION['locations']=="D18 Pasir Ris / Tampines"                                 
                                                                             ){echo "selected";}else{echo "";}?> >D18 Pasir Ris / Tampines</option>
                                
                            <option value="D19 Hougang / Punggol / Sengkang" <?php if(strpos($indexLocation,"D19 Hougang / Punggol / Sengkang") !== false ||$_SESSION['locations']=="D19 Hougang / Punggol / Sengkang"
                                                                                     
                                                                                     ){echo "selected";}else{echo "";}?> >D19 Hougang / Punggol / Sengkang</option>
                                
                            <option value="D20 Ang Mo Kio / Bishan / Thomson" <?php if(strpos($indexLocation,"D20 Ang Mo Kio / Bishan / Thomson") !== false ||$_SESSION['locations']=="D20 Ang Mo Kio / Bishan / Thomson"
                                                                                      
                                                                                      ){echo "selected";}else{echo "";}?> >D20 Ang Mo Kio / Bishan / Thomson</option>
                                
                            <option value="D21 Clementi Park / Upper Bukit Timah" <?php if(strpos($indexLocation,"D21 Clementi Park / Upper Bukit Timah") !== false||$_SESSION['locations']=="D21 Clementi Park / Upper Bukit Timah"
                                                                                          ){echo "selected";}else{echo "";}?> >D21 Clementi Park / Upper Bukit Timah</option>
                                
                            <option value="D22 Boon Lay / Jurong / Tuas" <?php if(strpos($indexLocation,"D22 Boon Lay / Jurong / Tuas") !== false
                                ||$_SESSION['locations']=="D22 Boon Lay / Jurong / Tuas" 
                                                                                 ){echo "selected";}else{echo "";}?> >D22 Boon Lay / Jurong / Tuas</option>
                                
                            <option value="D23 Dairy Farm / Bukit Panjang / Choa Chu Kang" <?php if(strpos($indexLocation,"D23 Dairy Farm / Bukit Panjang / Choa Chu Kang") !== false||$_SESSION['locations']=="D23 Dairy Farm / Bukit Panjang / Choa Chu Kang"
                                                                                                   ){echo "selected";}else{echo "";}?> >D23 Dairy Farm / Bukit Panjang / Choa Chu Kang</option>
                                
                            <option value="D24 Lim Chu Kang / Tengah" <?php if(strpos($indexLocation,"D24 Lim Chu Kang / Tengah") !== false
                                                              ||$_SESSION['locations']=="D24 Lim Chu Kang / Tengah"               
                                                                              ){echo "selected";}else{echo "";}?> >D24 Lim Chu Kang / Tengah</option>
                                
                            <option value="D25 Admiralty / Woodlands" <?php if(strpos($indexLocation,"D25 Admiralty / Woodlands") !== false
                                                    ||$_SESSION['locations']== "D25 Admiralty / Woodlands"                        
                                                                              ){echo "selected";}else{echo "";}?> >D25 Admiralty / Woodlands</option>
                                
                            <option value="D26 Mandai / Upper Thomson" <?php if(strpos($indexLocation,"D26 Mandai / Upper Thomson") !== false
                                                    ||$_SESSION['locations']=="D26 Mandai / Upper Thomson"                          
                                                                               ){echo "selected";}else{echo "";}?> >D26 Mandai / Upper Thomson</option>
                                
                            <option value="D27 Sembawang / Yishun" <?php if(strpos($indexLocation,"D27 Sembawang / Yishun") !== false
                                                            ||$_SESSION['locations']=="D27 Sembawang / Yishun"
                                                                           ){echo "selected";}else{echo "";}?> >D27 Sembawang / Yishun</option>
                                
                            <option value="D28 Seletar / Yio Chu Kang" <?php if(strpos($indexLocation,"D28 Seletar / Yio Chu Kang") !== false
                                                            ||$_SESSION['locations']=="D28 Seletar / Yio Chu Kang"
                                                                               ){echo "selected";}else{echo "";}?> >D28 Seletar / Yio Chu Kang</option>
                            </optgroup>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="form-group">
                      <label class="control-label">Furnishing</label>&nbsp;<label class="control-label" id="furnishingLBL" name="furnishingLBL"></label>
                        <select class="select2_multiple form-control" name="furnishing[]" multiple="multiple">
                            <optgroup label="Select from below">
                            <option value="Fully Furnished">Fully Furnished</option>
                            <option value="Partial Furnished">Partial Furnished</option>
                            <option value="Unfurnished">Unfurnished</option>
                          </optgroup>
                        </select>
                      </div>
                    </div>
                <div class="col-sm-12">
                <div class="form-group">
                <label class="control-label">Comment:</label>
                <div class="controls">
                <textarea rows="7" placeholder="Message (Optional)" name="comment"></textarea>
                </div>
                </div>
                </div>
                <div class="col-sm-12">
                <button type="submit" id="submit" class="btn-system btn-large" name="submitRequest">Submit</button>
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
        

        <!-- Start Footer -->
        <footer style="margin-top:-60px;">
            <div class="container">
                <div class="row footer-widgets">
                    <!-- Start Contact Widget -->
                    <div class="col-md-6">
                        <div class="footer-widget contact-widget">
                            <h4><img src="images/margo.png" class="img-responsive" alt="Footer Logo" /></h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                            <ul>
                                <li><span>Phone Number:</span> +01 234 567 890</li>
                                <li><span>Email:</span> company@company.com</li>
                                <li><span>Website:</span> www.yourdomain.com</li>
                            </ul>
                        </div>
                    </div>
                    <!-- .col-md-6 -->
                    <!-- End Contact Widget -->
                    <!-- Start Subscribe & Social Links Widget -->
                    <div class="col-md-3">
                        <div class="footer-widget mail-subscribe-widget">
                            <h4>Get in touch<span class="head-line"></span></h4>
                            <p>Join our mailing list to stay up to date and get notices about our new releases!</p>
                            <form class="subscribe">
                                <input type="text" placeholder="mail@example.com">
                                <input type="submit" class="btn-system" value="Send">
                            </form>
                        </div>
                    </div>
                    <!-- .col-md-3 -->
                    <div class="col-md-3">
                        <div class="footer-widget social-widget">
                            <h4>Follow Us<span class="head-line"></span></h4>
                            <ul class="social-icons">
                                <li>
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                                </li>
                                <li>
                                    <a class="linkdin" href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a class="flickr" href="#"><i class="fa fa-flickr"></i></a>
                                </li>
                                <li>
                                    <a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                                </li>
                                <li>
                                    <a class="instgram" href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a class="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a>
                                </li>
                                <li>
                                    <a class="skype" href="#"><i class="fa fa-skype"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- .col-nd-3 -->
                    <!-- End Subscribe & Social Links Widget -->
                </div>
                <!-- row -->
                <!-- Start Copyright -->
                <div class="copyright-section">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; 2016 BLK 1 Singapore - All Rights Reserved <a href="">Rapto Tech</a> </p>
                        </div>
                        <div class="col-md-6">
                            <ul class="footer-nav">
                                <li><a href="#">Sitemap</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contact</a></li>
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
    <!-- select2 -->
    <script src="js/select/select2.full.js"></script>
    <!-- range slider -->
  <script src="js/ion_range/ion.rangeSlider.min.js"></script>
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
    <!-- ion_range -->
  <script>
    $(function() {
      $("#range_26").ionRangeSlider({
        type: "double",
        min: 0,
        max: 100000,
        step: 10000,
        grid: true,
        grid_snap: true
      });
    });
  </script>
  <!-- /ion_range -->
</body>

</html>