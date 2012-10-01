<?php

switch($_SERVER['SERVER_NAME'])
{ 
	case 'dsg.dev':
	{
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
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "zAwEj5SegEz4");
    define("DB_NAME", "dsgac");
		// MS SQL Database config
		define('MSSQL_HOST', 'ec2-46-137-67-195.eu-west-1.compute.amazonaws.com');
		define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
		define("MSSQL_PASS", "mub4cr3at1ve()");
		define("MSSQL_NAME", "CAPEnhanced");
    break;
  }
  default:
	{
		// Production
    define("DB_HOST", "databasehost.dsgfs.com");
		define("DB_USER", "services");
		define("DB_PASS", "d15hcl0th");
		define("DB_NAME", "dsgac");
		// MS SQL Database config
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
	$glue = '+';
	$delete = array('[', ']', '(', ')', ','); // delete these characters
	$replace = array(' ', '/', '\\'); // replace these with the glue character
	
	$santised = str_replace($delete, '', trim($part));
	$santised = str_replace($replace, $glue, $santised);
	$santised = strtolower($santised);
	
	return $santised;
}

// Build a readable URL for the search results page
// EG: /car-leasing/personal/land+rover/range+rover+evoque
function search_page_url($manufacturer, $model, $vtype = 'car', $finance = 'business') {
	$url = $vtype.'-leasing/'.$finance.'/'.sanitiseUrlPart($manufacturer).'/'.sanitiseUrlPart($model);
	return $url;
}

// Build a readable URL for the vehicle detail page
// EG: /car-leasing/personal/land+rover/range+rover+evoque/land+rover+range+rover+evoque+2.2+sd4+dynamic+3dr+auto+lux+pack/51571
function vehicle_url($manufacturer, $model, $deriv, $capid, $vtype = 'car', $finance = 'business') {
	$url = $vtype.'-leasing/'.$finance.'/'.sanitiseUrlPart($manufacturer).'/'.sanitiseUrlPart($model).'/'.sanitiseUrlPart($deriv).'/'.$capid;
	return $url;
}
