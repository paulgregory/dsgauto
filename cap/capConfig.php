<?php

// Set the current VAT amount
define('VAT_AMOUNT', 20);

// MS SQL Database config
define('MSSQL_HOST', 'ec2-46-137-67-195.eu-west-1.compute.amazonaws.com');
define("MSSQL_USER", "AMAZONA-HMIH3E4\Muba");
define("MSSQL_PASS", "mub4cr3at1ve()");
define("MSSQL_NAME", "CAPEnhanced");

// Provide a function to format vehicle price with VAT or not depending on the finance type
function cap_format_price($decimal, $finance = 'business') {
	if ($finance == 'personal') {
		$vat_multiplier = (1 + (VAT_AMOUNT / 100));
		$decimal *= $vat_multiplier;
	}
	return number_format($decimal, 2, '.', ',');
}
