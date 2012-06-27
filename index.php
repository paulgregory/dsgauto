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
	if (isset($_POST['vehicleType'])) {
		// validate the post
		if (($_POST['vehicleType'] == 'cars' || $_POST['vehicleType'] == 'vans') && intval($_POST['brand']) > 0 && intval($_POST['modelSelection']) > 0) {
			header( 'Location: /search_results-type_'.mysql_real_escape_string($_POST['vehicleType']).'-make_'.mysql_real_escape_string($_POST['brand']).'-model_'.mysql_real_escape_string($_POST['modelSelection']).'.html');
		}
		else {
			$form_error = 'Please select a make and model';
		}
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

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="icon" href="http://www.dsgauto.com/favicon.ico" type="image/vnd.microsoft.icon" /><link rel="shortcut icon" href="http://www.dsgauto.com/favicon.ico" type="image/vnd.microsoft.icon" />
  <!--<link rel="shortcut icon" href="http://www.dsgauto.com/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">-->


  <!-- CSS: implied media="all" -->
  <link rel="stylesheet" href="css/style.css?v=2">

  <!-- Uncomment if you are specifically targeting less enabled mobile browsers
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/libs/modernizr-1.7.min.js"></script>
  
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
</body>
</html>