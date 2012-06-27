<?php
//URL Functions for the building of User-friendly URL Strings
function customerTypeURL($custType)
{  
	//Retrieves valid User-Friendly URL for Given Customer Type
	include("dbConnect.php");
	$sqlCustTypeURL = "SELECT * FROM `tblCustomerType` WHERE `CustomerTypeId` = $custType";
	$qryCustTypeURL = mysql_query($sqlCustTypeURL,$dbConnect);
	$rstCustTypeURL = mysql_fetch_array($qryCustTypeURL);
	return $rstCustTypeURL["CustomerTypeURL"];
}

function financeTypeURL($finType)
{  
	//Retrieves valid User-Friendly URL for given Finance Type
	include("dbConnect.php");
	$sqlFinTypeURL = "SELECT * FROM tblFinance WHERE FinanceID = $finType";
	$qryFinTypeURL = mysql_query($sqlFinTypeURL,$dbConnect);
	$rstFinTypeURL = mysql_fetch_array($qryFinTypeURL);
	return $rstFinTypeURL["FinanceTypeURL"];
}

function exceptionTypeURL($excType)
{  
	//Retrieves valid User-Friendly URL for given Exception Type
	include("dbConnect.php");
}

function cleanURL($urlstring)
{
	//Cleans a string for use in a URL i.e. removes Special Characters
	$urlstring =  ereg_replace ("[[:space:]?/\\()\.]", "_", $urlstring);
	$urlstring =  ereg_replace ("\[", "_", $urlstring);
	$urlstring =  ereg_replace ("\]", "_", $urlstring);
	$urlstring = str_replace("[", "_", $urlstring);
	return str_replace("]","_", $urlstring);
}

function getFinanceTypeFromID($ftype)
{
	//Returns Finance Type Name from an FTYPE ID
	include("dbConnect.php");
	$sqlGetFinanceTypeFromID = "SELECT * FROM tblFinance WHERE FinanceID = $ftype";
	$qryGetFinanceTypeFromID = mysql_query($sqlGetFinanceTypeFromID, $dbConnect);
	$rstGetFinanceTypefromID = mysql_fetch_array($qryGetFinanceTypeFromID);
	return $rstGetFinanceTypefromID['FinanceDesc'];
}

function  titleCase($string)  {
	$len=strlen($string);
	$i=0;
	$last= "";
	$new= "";
	$string=strtoupper($string);
	while  ($i<$len):
		$char=substr($string,$i,1);
		if  (ereg( "[A-Z]",$last)):
			$new.=strtolower($char);
		else:
			$new.=strtoupper($char);
		endif;
		$last=$char;
		$i++;
	endwhile;
	return($new);
}
?>