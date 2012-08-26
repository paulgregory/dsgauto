<?php

// Connect to MSSQL server
$con = mssql_connect(MSSQL_HOST,MSSQL_USER,MSSQL_PASS) 
    or die('Could not connect to MS SQL server');
 
// Select a database:
mssql_select_db(MSSQL_NAME) 
    or die('Could not select a database: '.MSSQL_NAME);
