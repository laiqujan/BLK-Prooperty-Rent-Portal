<?php 

if(isset($_POST['submitRq'])){
    $req = "req";
    $type=$_POST['type'];	
	$budget=$_POST['budget'];
    session_start();
    $_SESSION['types']=$type;	
    $_SESSION['budgets']=$budget;
    
    if(isset($_POST['locationIn'])){
        $loc=$_POST['locationIn'];
        $location = "";
        foreach($loc as $row)
            $location = $location .','.$row;
        
        header("Location: tenantLogin.php?id=$req&type=$type&budget=$budget&location=$location");
		exit;
    }
     $_SESSION['locations']=$location;
}


?>
  <!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    <!-- Basic -->
   <?php $title="Home";?>
	<title> <?php echo $title ;?></title>
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
    <script type="text/javascript" src="js/validation.js"></script>
    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
    <!-- Full Body Container -->
    <div id="container">

        <!-- Start Header Section -->
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
                                <a class="active" href="index.php">Home</a>
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
                                <a href="#">Agent Login / Register</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="agentLogin.php">Log In</a>
                                    </li>
                                    <li>
                                        <a href="agentRegistration.php">Sign Up</a>
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
                        <a class="active" href="index.php">Home</a>
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
                        <a href="#">Agent Login / Register</a>
                        <ul class="dropdown">
                            <li>
                                <a href="agentLogin.php">Log In</a>
                            </li>
                            <li>
                                <a href="agentRegistration.php">Sign Up</a>
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
   <div>

        <!-- Start Content -->
        <div id="content">
		            <!-- Start Find Property Content -->
            <div id="content" style="background-color:#b0c8f3;">
                <div class="container">

                    <!-- Page Content -->
                    <div class="page-content">

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span style="color:black;font-weight:bold;">Find Property</span></h4>

                        <!-- Start Contact Form -->
                        <form role="form" class="contact-form" id="contact-form" method="post" name="indexForm" onSubmit="return indexValidation();">

                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" style="color:black;font-weight:bold;">Property Type:</label>
                                    <select class="form-control" style="color:black;" name="type">
                                        <option value="0">Choose option</option>
                                        <option value="1" selected>HDB</option>
                                        <option value="2">Private property</option>
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" style="color:black;font-weight:bold;">Budget:</label>
                                    <select class="form-control" style="color:black;" name="budget">
                                        <option value="0">Choose option</option>
                                        <option value="0-$1500" selected>0-$1500</option>
                                        <option value="$1500-$2000">$1500-$2000</option>
                                        <option value="$2000-$2500">$2000-$2500</option>
                                        <option value="$2500-$3000">$2500-$3000</option>
                                        <option value="$3000-$4000">$3000-$4000</option>
                                        <option value="$4000+">$4000+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                      <div class="form-group">
                      <label class="control-label" style="color:black;font-weight:bold;">Location</label>&nbsp;<label class="control-label" id="locationInLBL" name="locationInLBL"></label>
                        <select class="select_multiple_location form-control" id="locationIn" name="locationIn[]" multiple="multiple">
                            <optgroup label="Select your location">
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
                            <option value="D19 Hougang / Punggol / Sengkang">D19 Hougang / Punggol / Sengkang</option>
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
                            <div class="col-sm-12">
                                <button class="btn-system btn-large" name="submitRq" style="margin-left:40%;margin-top:5px;" type="submit">Submit Request</button>
                                <div id="success" style="color:#34495e;"></div>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="hr5" style="margin-top:150px;"></div>
                    </div>
                </div>
            </div>
			<!-- End Find Property Content -->

            <!-- Start Video Content -->
            <div id="content">
                <div class="container">


                    <!-- Page Content -->
                    <div class="col-md-4 page-content">

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>Rent with $0 Agent Fee</span></h4>

                        <!-- Some Text -->
                        <p>Find your next property for rent without paying any agent fee whatsover. 
The process is as easy and hassle free. You just have to submit a request above, and agents will contact you with available properties. 
Watch the video on the right to learn more. </p>

                        <!-- Divider -->
                        <div class="hr5" style="margin-top:5px;"></div>

                        <!-- Accordion -->
                        <div class="panel-group" id="accordion">

                            <!-- Start Accordion 1 -->
                            <div class="panel panel-default">
                                <!-- Toggle Heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-4" class="collapsed">
                                             Is it totally free?
                                        </a>
                                    </h4>
                                </div>
                                <!-- Toggle Content -->
                                <div id="collapse-4" class="panel-collapse collapse in">
                                    <div class="panel-body">
			
                                   Yes. There is no agent fee. The only fee you would have to pay is legally payable stamping fee.
                                    </div>
                                </div>
                            </div>
                            <!-- End Accordion 3 -->
                            <!-- Start Accordion 2 -->
                            <div class="panel panel-default">
                                <!-- Toggle Heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-5" class="collapsed">
                                             Why is it free?
                                        </a>
                                    </h4>
                                </div>
                                <!-- Toggle Content -->
                                <div id="collapse-5" class="panel-collapse collapse">
                                    <div class="panel-body">The agents represent the landlords and hence are paid commission from the landlord. 
We don't charge you (or agents) any fee for using the services provided by this website..</div>
                                </div>
                            </div>
                            <!-- End Accordion 3 -->
                            <!-- Start Accordion 3 -->
                            <div class="panel panel-default">
                                <!-- Toggle Heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-6" class="collapsed">
                                             Do I get agent service?
                                        </a>
                                    </h4>
                                </div>
                                <!-- Toggle Content -->
                                <div id="collapse-6" class="panel-collapse collapse">
                                    <div class="panel-body">The agents represent and work for the agent. We can arrange a CEA registered agent to assist you if needed. Please see our FAQ. </div>
                                </div>
                            </div>
                            <!-- End Accordion 3 -->

                        </div>
                        <!-- End Accordion -->

                    </div>
                    <!-- End Page Content-->
                    <!--Sidebar-->
                    <div class="col-md-8">
                        <!-- Video Widget -->
                        <div class="widget">
                            <h4><span class="head-line"></span></h4>
                            <div>
                                <video width="800" height="450" controls autoplay >
                                <source src="video/Home_2.mp4" type="video/mp4">
								 <script>
                                 var video = document.currentScript.parentElement;
                                 video.volume = 0;
                                  </script>
                                </video>
                            </div>
                        </div>

                    </div>
                    <!--End sidebar-->
                </div>
            </div>
            <!-- End Video Content -->

            <!-- Start Content -->
            <div id="content" style="background-color:#fbe9e9;">
                <div class="container">

                    <!-- Page Content -->
                    <div class="page-content">

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span style="color:black;font-weight:bold;">Join Us as Agent</span></h4>

                        <!-- Start Contact Form -->
                        <form role="form" class="contact-form" id="contact-form" method="post">

                            <div class="col-sm-8">
                                <!-- Some Text -->
                                <p style="color:black;">
								Do you have available rental properties? Are you looking for tenants? Are you representing owners?
If yes, Signup for free and start connecting with tenants today.</br> 

Our service is totally free (No membership/listing fees whatsoever). Join us Now!
Please note that the tenants do NOT pay any commission. 
 </p>
                            </div>
                            <div class="col-sm-4">
                                <a href="tenantRegistration.php" class="btn-system btn-large" style="margin-left:40%;margin-top:5px;">Sign Up Now</a>
                                <div id="success" style="color:#34495e;"></div>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="hr5" style="margin-top:100px;"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content -->

        <!-- Start Footer -->
        <footer style="margin-top:-60px;">
            <div class="container">

                <!-- row -->
                <!-- Start Copyright -->
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
        