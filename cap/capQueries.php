<?php

require_once('mssqlConnect.php');

function run_query($sql) {
	$result = @mssql_query($sql);
	if (mssql_num_rows($result)) {
		return $result;
	}
	else {
		return FALSE;
	}
}

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
		
	return run_query($sql);
}

// Return basic information for a single vehicle for a given CAPID
// This query makes sure the price being returned is the latest one
// If there is no active price then we assume the deriv is no longer available
function vehicle_by_capid($capid) {
	$sql = "SELECT TOP 1 * ".
		"FROM vieCAPDerivativesAndCodes INNER JOIN ".
		"tblCAPMod ON vieCAPDerivativesAndCodes.ModelCode = tblCAPMod.ModelCode INNER JOIN ".
		"tblNVDPrices ON vieCAPDerivativesAndCodes.CAPID = tblNVDPrices.CAPIDNumber INNER JOIN ".
		"tblCAPMan ON vieCAPDerivativesAndCodes.ManCode = tblCAPMan.ManCode INNER JOIN ".
		"tblCAPRanges ON tblCAPMod.RangeCode = tblCAPRanges.RangeCode ".
		"WHERE DateOptionEffectiveTo IS NULL ".
		"AND vieCAPDerivativesAndCodes.CAPID = $capid";
		
	return run_query($sql);
}

// Get the list of standard equipment for the vehicle deriv defined by $capid
function vehicle_standard_equipment($capid) {
	$sql = "SELECT CAPIDNumber, tblNVDStandardEquipment.OptionCode, CatCode, LongDesc ".
	       "FROM tblNVDStandardEquipment INNER JOIN ".
	       "tblNVDDictionaryOption ON tblNVDStandardEquipment.OptionCode = tblNVDDictionaryOption.OptionCode ".
	       "WHERE DateOptionEffectiveTo IS NULL ".
	       "AND CAPIDNumber = $capid ".
	       "ORDER BY CatCode, LongDesc";
	
	return run_query($sql);
}


?>