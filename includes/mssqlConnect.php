<?php

// Connect to MSSQL server
$con = mssql_connect(MSSQL_HOST,MSSQL_USER,MSSQL_PASS) 
    or die('Could not connect to MS SQL server. Error: '.mssql_get_last_message());
 
// Select a database:
mssql_select_db(MSSQL_NAME) 
    or die('Could not select a database. Error: '.mssql_get_last_message());
