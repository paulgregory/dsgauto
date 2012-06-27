<?php

// IMPORTANT: TDS Setup
// http://howtogetitworking.com/2008/05/28/mac-connecting-to-mssql-server-on-mac/


// http://www.jonasjohn.de/snippets/php/mssql-example.htm

/*
** Connect to database:
*/

// Connect to the database (host, username, password)
$con = mssql_connect('ec2-54-247-133-62.eu-west-1.compute.amazonaws.com','AMAZONA-HMIH3E4\Muba','mub4cr3at1ve()') 
    or die('Could not connect to the server!');
 
// Select a database:
mssql_select_db('CAPEnhanced') 
    or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
$SQL = "SELECT * FROM vieCAPRanges WHERE ManCode = ".intval($_GET['mancode'])." ORDER BY RangeName ASC";
 
// Execute query:
$result = mssql_query($SQL)
    or die('A error occured: ' . mysql_error());

mssql_close($con);
 
$return = array();
if (mssql_num_rows($result)) {
	while ($row = mssql_fetch_assoc($result)) {
		$return[] = array('RangeCode' => $row['RangeCode'], 'RangeName' => $row['RangeName']);
	}
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
print json_encode($return);