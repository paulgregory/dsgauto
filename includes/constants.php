<?php

switch($_SERVER['SERVER_NAME'])
{ 
	case 'dsg.dev':
	{
		// Paul's localhost
		define("UPLOAD_DIR", '/uploads/');
		// MySQL database
    define("DB_HOST", "localhost");
		define("DB_USER", "root");
		define("DB_PASS", "root");
		define("DB_NAME", "dsgac");
		// MS SQL Database config
		define('MSSQL_HOST', 'ec2-46-137-67-195.eu-west-1.compute.amazonaws.com');
		define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
		define("MSSQL_PASS", "mub4cr3at1ve()");
		define("MSSQL_NAME", "CAPEnhanced");
		break;
  }
	case 'dsg.monki.info':
	{
		// Monki staging
		define("UPLOAD_DIR", '/uploads/');
		// MySQL database
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "zAwEj5SegEz4");
    define("DB_NAME", "dsgac");
		// MSSQL Database config
		define('MSSQL_HOST', 'ec2-46-137-67-195.eu-west-1.compute.amazonaws.com');
		define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
		define("MSSQL_PASS", "mub4cr3at1ve()");
		define("MSSQL_NAME", "CAPEnhanced");
    break;
  }
	case 'localhost':
	{
		// Localhost testing environment
		define("UPLOAD_DIR", '\\uploads\\');
		// MySQL database
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "root");
    define("DB_NAME", "dsgac");
		// MSSQL Database config
		define('MSSQL_HOST', 'ec2-46-137-67-195.eu-west-1.compute.amazonaws.com');
		define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
		define("MSSQL_PASS", "mub4cr3at1ve()");
		define("MSSQL_NAME", "CAPEnhanced");
		
    break;
  }
  default:
	{
		// Production
		define("UPLOAD_DIR", '\\uploads\\');
		// MySQL database
    define("DB_HOST", "databasehost.dsgfs.com");
		define("DB_USER", "services");
		define("DB_PASS", "d15hcl0th");
		define("DB_NAME", "dsgac");
		// MSSQL Database config
		define('MSSQL_HOST', 'ec2-46-137-67-195.eu-west-1.compute.amazonaws.com');
		define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
		define("MSSQL_PASS", "mub4cr3at1ve()");
		define("MSSQL_NAME", "CAPEnhanced");
  }
}

//tables
define("TBL_BRANDS", "tblcarbrands");
define("TBL_MODELS", "tblcarmodels");
define("TBL_DERIVS", "tblcarderivs");
define("TBL_DEALS", "tbldeals");

define("TBL_CAP_CAR", "tblcapcars");
define("TBL_CAP_VAN", "tblcapvans");

define("TBL_ARTICLES", "tblarticles");
define("TBL_USERS", "tblusers");
define("TBL_IMAGES", "tblvehicleimages");
define("TBL_TESTIMONIALS", "tbltestimonials");

define("TBL_VANBRANDS", "tblvanbrands");
define("TBL_VANMODELS", "tblvanmodels");
define("TBL_VANDERIVS", "tblvanderivs");
define("TBL_VANDEALS", "tblvandeals");

define("TBL_BRAND_NOTES", "tblbrandnotes");
define("TBL_RATE_BOOK", "tblratebook");

/* Utility Functions */

// Encode manufacturers and models etc to make them safe for a URL
function dsg_encode($str, $clean_up = FALSE) {
	$return = $str;
	// Throw away useless characters to make a neater url
	if ($clean_up) {
		$delete = array('[', ']', '(', ')', ',', '+');
		$return = str_replace($delete, '', $return);
	}
	
	$return = strtolower(trim($return));
	$return = str_replace('+', '--', $return);
	$return = str_replace('/', '__', $return);
	$return = str_replace(' ', '_', $return);
	
	return $return;
}

// Decode strings previously enocoded with dsg_encode
function dsg_decode($str) {
	$return = strtoupper(trim($str));
	$return = str_replace('--', '+', $return);
	$return = str_replace('__', '/', $return);
	$return = str_replace('_', ' ', $return);
	
	return $return;
}

// Provide a function to format vehicle price with VAT or not depending on the finance type
function cap_format_price($decimal, $finance = 'business') {
	global $VAT;
	
	$prefix = '&pound;';
	
	if ($finance == 'personal') {
		$vat_multiplier = $VAT;
		$decimal *= $vat_multiplier;
		$postfix = ' <span class="vat">inc VAT</span>';
	}
	else {
		$postfix = ' <span class="vat">+VAT</span>';
	}
	
	$number = number_format($decimal, 2, '.', ',');
	
	return $prefix.$number.$postfix;
}

// Takes in 'FORD FOCUS 1.6 [TDI/DIESEL]' and returns 'ford+focus+1.6+tdi+diesel'
function sanitiseUrlPart($part) {
	$glue = '_';
	$delete = array('[', ']', '(', ')', ','); // delete these characters
	$replace = array(' ', '/', '\\'); // replace these with the glue character
	
	$sanitised = str_replace($delete, '', trim($part));
	$sanitised = str_replace('+', '%2B', $sanitised);
	$sanitised = str_replace($replace, $glue, $sanitised);
	$sanitised = urlencode(strtolower($sanitised));
	
	return $sanitised;
}

// Build a readable URL for the search results page
// EG: /car-leasing/personal/land+rover/range+rover+evoque
function search_page_url($manufacturer, $model, $vtype = 'car', $finance = 'business') {
	$url = $vtype.'-leasing/'.$finance.'/'.dsg_encode($manufacturer).'/'.dsg_encode($model);
	return $url;
}

// Build a readable URL for the vehicle detail page
// EG: /car-leasing/personal/land+rover/range+rover+evoque/land+rover+range+rover+evoque+2.2+sd4+dynamic+3dr+auto+lux+pack/51571
function vehicle_url($manufacturer, $model, $deriv, $capid, $vtype = 'car', $finance = 'business') {
	$url = $vtype.'-leasing/'.$finance.'/'.dsg_encode($manufacturer).'/'.dsg_encode($model).'/'.dsg_encode($deriv, TRUE).'/'.$capid;
	return $url;
}
