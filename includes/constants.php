<?php

switch($_SERVER['SERVER_NAME'])
{ 
	case 'dsg.dev':
	{
    define("DB_HOST", "localhost");
		define("DB_USER", "root");
		define("DB_PASS", "root");
		define("DB_NAME", "dsgac");
		break;
  }
	case 'dsg.monki.info':
	{
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "zAwEj5SegEz4");
    define("DB_NAME", "dsgac");
    break;
  }
  default:
	{
		// Production
    define("DB_HOST", "databasehost.dsgfs.com");
		define("DB_USER", "services");
		define("DB_PASS", "d15hcl0th");
		define("DB_NAME", "dsgac");
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

?>