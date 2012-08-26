<?php

require_once('capConfig.php');
require_once('mssqlConnect.php');

function run_mssql_query($sql) {
	$result = @mssql_query($sql);
	if (mssql_num_rows($result)) {
		return $result;
	}
	else {
		return FALSE;
	}
}

function run_mysql_query($sql) {
	$result = mysql_query($sql);
	if (mysql_num_rows($result)) {
		return $result;
	}
	else {
		return FALSE;
	}
}

// MSSQL
// Return all current derivatives for a range name (text name, not ID)
// To be 'current' there has to be an active price for that deriv
function derivs_by_range_name($range_name) {
	$sql = "SELECT tblCAPMod.ModelDesc, vieCAPDerivativesAndCodes.DerivDescription, vieCAPDerivativesAndCodes.CAPID, tblNVDPrices.BasicPrice, tblNVDPrices.VAT, tblNVDPrices.Delivery ".
		"FROM vieCAPDerivativesAndCodes INNER JOIN ".
		"tblCAPMod ON vieCAPDerivativesAndCodes.ModelCode = tblCAPMod.ModelCode INNER JOIN ".
		"tblNVDPrices ON vieCAPDerivativesAndCodes.CAPID = tblNVDPrices.CAPIDNumber INNER JOIN ".
		"tblCAPRanges ON tblCAPMod.RangeCode = tblCAPRanges.RangeCode ".
		"WHERE DateOptionEffectiveTo IS NULL ".
		"AND RangeName = '$range_name' ".
		"ORDER BY tblCAPMod.ModelDesc, vieCAPDerivativesAndCodes.DerivDescription";
		
	return run_mssql_query($sql);
}

// MSSQL
// Return basic information for a single vehicle for a given CAPID
// This query makes sure the price being returned is the latest one
// If there is no active price then we assume the deriv is no longer available
function vehicle_by_capid($capid) {
	$sql = "SELECT TOP 1 * ".
		"FROM vieCAPDerivativesAndCodes INNER JOIN ".
		"tblCAPMod ON vieCAPDerivativesAndCodes.ModelCode = tblCAPMod.ModelCode INNER JOIN ".
		"tblNVDPrices ON vieCAPDerivativesAndCodes.CAPID = tblNVDPrices.CAPIDNumber INNER JOIN ".
		"tblCAPMan ON vieCAPDerivativesAndCodes.ManCode = tblCAPMan.ManCode INNER JOIN ".
		"tblNVDModelYear ON vieCAPDerivativesAndCodes.CAPID = tblNVDModelYear.CAPID INNER JOIN ".
		"tblCAPRanges ON tblCAPMod.RangeCode = tblCAPRanges.RangeCode ".
		"WHERE DateOptionEffectiveTo IS NULL ".
		"AND vieCAPDerivativesAndCodes.CAPID = $capid";
		
	return run_mssql_query($sql);
}

// MSSQL
// Get the list of standard equipment for the vehicle deriv defined by $capid
function vehicle_standard_equipment($capid) {
	$sql = "SELECT CAPIDNumber, tblNVDStandardEquipment.OptionCode, CatCode, LongDesc ".
	       "FROM tblNVDStandardEquipment INNER JOIN ".
	       "tblNVDDictionaryOption ON tblNVDStandardEquipment.OptionCode = tblNVDDictionaryOption.OptionCode ".
	       "WHERE DateOptionEffectiveTo IS NULL ".
	       "AND CAPIDNumber = $capid ".
	       "ORDER BY CatCode, LongDesc";
	
	return run_mssql_query($sql);
}

// MSSQL
function vehicle_options($capid) {
	$sql = "SELECT CAPIDNumber, tblNVDOptions.OptionCode, CatCode, CategoryDesc, LongDesc ".
	       "FROM tblNVDOptions INNER JOIN ".
	       "tblNVDDictionaryOption ON tblNVDOptions.OptionCode = tblNVDDictionaryOption.OptionCode INNER JOIN ".
	       "tblNVDDictionaryCategory ON tblNVDDictionaryOption.CatCode = tblNVDDictionaryCategory.CategoryCode ".
	       "WHERE DateOptionEffective_To IS NULL ".
	       "AND CAPIDNumber = $capid ".
	       "ORDER BY CategoryDesc, LongDesc";

	return run_mssql_query($sql);
}

// MYSQL
// Get a list of derivatives and their rate book values for a given internal model number
// The internal model number is NOT the CAP Model ID but the DSG ID number from the tblcarmodels table
// This assumes a Mileage of 10000 and a term of 36
// Note: this will only return a deriv if a price is found
function derivs_by_int_model($model_number) {
	$sql = "SELECT DISTINCT capID as 'CAPID', model as 'ModelDesc', derivative as 'DerivDescription', CO2, P11D, FinanceRental, ServiceRental, EffectiveRentalValue FROM tblcarderivs AS d, tblratebook AS c ".
	       "WHERE d.enabled = 1 ".
		     "AND d.capID = c.CAP_Id ".
		     "AND modelID = $model_number ".
		     "AND Mileage = 10000 ".
		     "AND Term = 36 ".
		     "ORDER BY derivative ASC";

	return run_mysql_query($sql);
}

// MYSQL
// Get a deriv rate book values
// This assumes a Mileage of 10000 and a term of 36
function deriv_finance($capid) {
	$sql = "SELECT CO2, P11D, FinanceRental, ServiceRental, EffectiveRentalValue FROM tblcarderivs AS d, tblratebook AS c ".
	       "WHERE d.capID = '$capid' ".
		     "AND d.capID = c.CAP_Id ".
		     "AND Mileage = 10000 ".
		     "AND Term = 36 ".
		     "ORDER BY derivative ASC";

	return run_mysql_query($sql);
}

function cap_format_price($decimal, $finance = 'business') {
	if ($finance == 'personal') {
		$vat_multiplier = (1 + (VAT_AMOUNT / 100));
		$decimal *= $vat_multiplier;
	}
	return number_format($decimal, 2, '.', '');
}

?>