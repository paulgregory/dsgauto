<?php
	session_start();

	$_SESSION['dsgauto'] = true;
	if(!isset($_SESSION['vtype']))
	{
		$_SESSION['vtype'] = 'car';
		$vtype = $_SESSION['vtype'];
	}
	else
		$vtype = $_SESSION['vtype'];
			
	error_reporting(1);
	
	require_once("includes/dbConnect.php");
  require_once("includes/init.php");
  require_once("includes/URLFunc.php");
 	require_once("includes/generateHeader.php");
	require_once("includes/Functions.php");
	require_once("includes/Menu.php");
	require_once('includes/sql.php');
	require_once('includes/setTitle.php');
	
	// Process Vehicle Search
	$form_error = false;
	if (isset($_POST['stype']) && $_POST['stype'] == 'vehiclesearch') {
		$_SESSION['search_finance_type'] = $_POST['financeType'];
		$_SESSION['search_vehicle_type'] = $_POST['vehicleType'];
		$_SESSION['search_brand'] = $_POST['brand'];
		$_SESSION['search_model'] = $_POST['modelSelection'];
		
		// validate the post
		if (($_POST['financeType'] == 'personal' || $_POST['financeType'] == 'business') && ($_POST['vehicleType'] == 'car' || $_POST['vehicleType'] == 'van') && $_POST['brand'] !== '0' && $_POST['modelSelection'] !== '0') {
			$url = search_page_url($_POST['brand'], $_POST['modelSelection'], $_POST['vehicleType'], $_POST['financeType']);	
			// Redirect to an aliased URL
			header( 'Location: /'.$url);
		}
		else {
			$form_error = 'Please select a vehicle type, make and model';
		}
	}
	else {
		/*
		// Maybe we should unset the session when the search page is loaded normally??
		unset($_SESSION['search_finance_type']);
		unset($_SESSION['search_vehicle_type']);
		unset($_SESSION['search_brand']);
		unset($_SESSION['search_model']);
		*/
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo getTitle(); ?></title>
  <meta name="description" content="Car leasing, contract hire and lease purchase for business or personal use. Cheap van and company car leasing deals on all vehicles with great service." />
  <meta name="keywords" content="car leasing, car leasing uk, company car leasing, cheap, car lease, UK, personal, business, car finance, vehicle finance, lease cars, vehicle leasing, contract hire uk, leasing a car, leasing cars, personal car leasing, commercial vehicles, van leasing, van lease, vehicle leasing uk, contract hire, car leasing companies, renault, vauxhall, citroen, bmw" />
  <meta name="rating" content="Safe For Kids" />
  <meta name="google-site-verification" content="vS3ghjZwpmOOqaEb6YUQj2HRtZ8EP5ofAqvT8HdyKhs" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/favicon.ico" type="image/vnd.microsoft.icon" /><link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />
  <link rel="stylesheet" href="/css/style.css?v=3">
  <script type="text/javascript" src="/js/libs/jquery-1.5.1.min.js"></script>
  <script src="/js/libs/modernizr-1.7.min.js"></script>
  <script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
</head>
<body>

  <div id="container">
    <header>
   <?php include ('Header.php'); ?>

    	</div>
		
		<?php include ('navBar.php'); ?>
        
    

    </header>

<div id="main" role="main">
<?php include ("Content.php"); ?>


</div>  <!--! end of #main -->

<div id="footer">
				<?php include ("Footer.php");?>
			</div>
    

  </div> <!--! end of #container -->
  
  <!-- google code -->
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-3586219-1");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>
	<script type="text/javascript">stLight.options({publisher: "ur-f4c8371d-a27a-2b21-5295-7b55a8523c6"});</script>
	<script>
	var options={ "publisher": "ur-f4c8371d-a27a-2b21-5295-7b55a8523c6", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "linkedin", "email", "sharethis"]}};
	var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
	</script>
</body>
</html>