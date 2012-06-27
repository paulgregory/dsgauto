<?php

define('MSSQL_HOST', 'ec2-54-247-133-62.eu-west-1.compute.amazonaws.com');
define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
define("MSSQL_PASS", "mub4cr3at1ve()");
define("MSSQL_NAME", "CAPEnhanced");

// Connect to MSSQL server
$con = mssql_connect(MSSQL_HOST,MSSQL_USER,MSSQL_PASS) 
    or die('Could not connect to the server');
 
// Select a database:
mssql_select_db(MSSQL_NAME) 
    or die('Could not select a database: '.MSSQL_NAME);
