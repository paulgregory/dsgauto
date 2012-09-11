<?php

########### Articles ############
function sqlArticle($aURL){
$sqlArticle = 
"SELECT 
	*
FROM 
	". TBL_ARTICLES ."
WHERE 
	(". TBL_ARTICLES .".url = '$aURL')";
return $sqlArticle;
}

$sqlGetArticles = 
"SELECT
	". TBL_ARTICLES .".title,
	". TBL_ARTICLES .".url
FROM
	". TBL_ARTICLES ."
ORDER BY
	". TBL_ARTICLES .".title";

function updateArticle($Title, $Body, $URL, $Description, $ID){
$updateArticle = 
"UPDATE 
	".TBL_ARTICLES."
SET 
	title = '".$Title."', 
	body = '".$Body."',
	url = '".$URL."',
	description = '".$Description."'
WHERE 
	id = '".$ID."'";
return $updateArticle;
}
function addArticle($Title, $Body, $URL, $Description){
$addArticle = 
"INSERT INTO
	".TBL_ARTICLES."
	(title, body, url, description)
VALUES
	('$Title', '$Body', '$URL', '$Description')";
return $addArticle;
}
############ images ################
function addImage($smallName, $largeName, $imageName){
$addImage = 
"INSERT INTO
	".TBL_IMAGES."
	(small, large, name)
VALUES
	('$smallName', '$largeName', '$imageName')";
return $addImage;
}
############ Deals #################

function getVehicleType($dealID){
$sqlDeal=
"SELECT
	".TBL_DEALS.".vehicleType
FROM
	".TBL_DEALS."
WHERE
	(".TBL_DEALS.".id = '$dealID')";
return $sqlDeal;
}

function sqlDealGet($dealID, $Car, $Enabled){	
$tblBrands;
$tblModels;
$tblDerivs;

if($Car){
	$tblBrands = TBL_BRANDS;
	$tblModels = TBL_MODELS;
	$tblDerivs = TBL_DERIVS;
}
else{
	$tblBrands = TBL_VANBRANDS;
	$tblModels = TBL_VANMODELS;
	$tblDerivs = TBL_VANDERIVS;
}


$sqlDealGet=
"SELECT
	".$tblBrands.".brand,
	".$tblBrands.".id AS brandID,
	".$tblModels.".model,
	".$tblModels.".id AS modelID,
	".$tblDerivs.".derivative,
	".$tblDerivs.".id AS derivID,
	".TBL_DEALS.".*
FROM
	".TBL_DEALS."
	INNER JOIN ".$tblDerivs." ON (".TBL_DEALS.".vehicleID = ".$tblDerivs.".id)
	INNER JOIN ".$tblModels." ON (".$tblDerivs.".modelID = ".$tblModels.".id)
	INNER JOIN ".$tblBrands." ON (".$tblModels.".brandID = ".$tblBrands.".id)
WHERE
";
if ($dealID > 0)
	$sqlDealGet .= "(".TBL_DEALS.".id = $dealID)";
else
	$sqlDealGet .= "(".TBL_DEALS.".enabled = $Enabled)";
$sqlDealGet .=
"ORDER BY
	".TBL_DEALS.".monthly_payment";
return $sqlDealGet;
}

function sqlCapDealGet($dealID, $Car, $Enabled = 1){
  if($Car){
	  $tblDerivs = TBL_CAP_CAR;
  }
  else{
	  $tblDerivs = TBL_CAP_VAN;
  }

  $sqlDealGet=
    "SELECT 
		  Manufacturer AS brand, 
		  ModelShort AS model, 
		  DerivativeLong As derivative, 
		  ".TBL_DEALS.".* 
		FROM 
		  ".TBL_DEALS."
		INNER JOIN 
		  ".$tblDerivs." ON (vehicleID = CAPID) 
		WHERE ";
  if ($dealID > 0)
	  $sqlDealGet .= "(".TBL_DEALS.".id = $dealID) ";
  else
	  $sqlDealGet .= "(".TBL_DEALS.".enabled = $Enabled) ";

  $sqlDealGet .= "ORDER BY ".TBL_DEALS.".monthly_payment";
  return $sqlDealGet;
}

function sqlCapGetDeals($Car){
  if($Car){
	  $tblDerivs = TBL_CAP_CAR;
  }
  else{
	  $tblDerivs = TBL_CAP_VAN;
  }

  $sqlDealGet=
    "SELECT 
		  Manufacturer AS brand, 
		  ModelShort AS model, 
		  DerivativeLong As derivative, 
		  ".TBL_DEALS.".* 
		FROM 
		  ".TBL_DEALS."
		INNER JOIN 
		  ".$tblDerivs." ON (vehicleID = CAPID) 
		WHERE ";
  if ($dealID > 0)
	  $sqlDealGet .= "(".TBL_DEALS.".id = $dealID) ";
  else
	  $sqlDealGet .= "(".TBL_DEALS.".enabled = 1) ";

  $sqlDealGet .= "ORDER BY ".TBL_DEALS.".monthly_payment";
  return $sqlDealGet;
}

function updateDeal($dealID, $notes, $profile1, $profile2, $initialPayment, $monthlyPayment, $term, $annualMileage, $docFee, $Enabled, $business, $personal, $imageID, $financeType, $finalPayment, $SpecialOffer){
$updateDeal = 
"UPDATE 
	".TBL_DEALS."
SET 
	notes = '$notes', 
	profile1 = '$profile1', 
	profile2 = '$profile2', 
	initial_payment = '$initialPayment', 
	monthly_payment = '$monthlyPayment', 
	monthly_payments = '$term', 
	annual_mileage = '$annualMileage', 
	doc_fee = '$docFee', 
	enabled = '$Enabled', 
	business = '$business', 
	personal = '$personal', 
	imageID = '$imageID', 
	financeType = '$financeType', 
	final_payment = '$finalPayment',
	special_offer = '$SpecialOffer'
WHERE 
	id = '$dealID'";
return $updateDeal;
}

function addDeal($VehicleType, $VehicleID, $Notes, $Profile1, $Profile2, $InitialPayment, $MonthlyPayment, $Term, $AnnualMileage, $DocFee, $Enabled, $Business, $Personal, $ImageID, $FinanceType, $FinalPayment, $SpecialOffer){
$addDeal = 
"INSERT INTO
	".TBL_DEALS."
	(vehicleType, vehicleID, notes, profile1, profile2, initial_payment, monthly_payment, monthly_payments, annual_mileage, doc_fee, enabled, business, personal, imageID, financeType, final_payment, special_offer)
VALUES
	('$VehicleType', '$VehicleID', '$Notes', '$Profile1', '$Profile2', '$InitialPayment', '$MonthlyPayment', '$Term', '$AnnualMileage', '$DocFee', '$Enabled', '$Business', '$Personal', '$ImageID', '$FinanceType', '$FinalPayment', '$SpecialOffer')";
return $addDeal;
}

function deleteDeal($ID) {
$sqlDeleteDeal = "
DELETE
FROM
".TBL_DEALS."
WHERE
	".TBL_DEALS.".id = '$ID'";
return $sqlDeleteDeal;
}

$sqlSpecialOffer = 
"SELECT
	*
FROM
	".TBL_DEALS."
WHERE
	".TBL_DEALS.".special_offer = '1'
LIMIT 1";


function sqlGetDeals() {
$sqlGetDeals = 
"SELECT 
	*
FROM
	".TBL_DEALS."
ORDER BY
	".TBL_DEALS.".monthly_payment";
	return $sqlGetDeals;
}

$sqlCarBrand = 
"SELECT DISTINCT
	".TBL_BRANDS.".brand,
	".TBL_BRANDS.".id
FROM
	".TBL_BRANDS."
WHERE
	".TBL_BRANDS.".enabled = 1
ORDER BY
	".TBL_BRANDS.".brand";

$sqlCapCarBrand = 
	"SELECT 
	  DISTINCT c.Manufacturer AS brand
	FROM 
	  ".TBL_CAP_CAR." AS c 
	INNER JOIN 
	  ".TBL_RATE_BOOK." AS r ON c.CAPID = CAP_Id 
	INNER JOIN 
	  ".TBL_BRANDS." AS b ON c.Manufacturer = b.brand 
	AND
	  b.enabled = 1
	ORDER BY
	  c.Manufacturer ASC";
	
$sqlCapVanBrand = 
	"SELECT 
	  DISTINCT c.Manufacturer AS brand
	FROM 
	  ".TBL_CAP_VAN." AS c 
	INNER JOIN 
	  ".TBL_RATE_BOOK." AS r ON c.CAPID = CAP_Id 
	INNER JOIN 
	  ".TBL_VANBRANDS." AS b ON c.Manufacturer = b.brand 
	AND
	  b.enabled = 1
	ORDER BY
	  c.Manufacturer ASC";

function getBrandFromId($Car, $ID){
$brandTable = "";
if($Car)
	$brandTable = TBL_BRANDS;
else
	$brandTable = TBL_VANBRANDS;
	
$sqlBrand = 
"SELECT DISTINCT
	".$brandTable.".brand
FROM
	".$brandTable."
WHERE
	".$brandTable.".id = '$ID'
LIMIT 1";
return $sqlBrand;
}

function getModelFromId($Car, $ID){
$modelTable = "";
if($Car)
	$modelTable = TBL_MODELS;
else
	$modelTable = TBL_VANMODELS;
	
$sqlModel = 
"SELECT DISTINCT
	".$modelTable.".model
FROM
	".$modelTable."
WHERE
	".$modelTable.".id = '$ID'
LIMIT 1";
return $sqlModel;
}

function getDerivFromId($Car, $ID){
$modelTable = "";
if($Car)
	$modelTable = TBL_DERIVS;
else
	$modelTable = TBL_VANDERIVS;
	
$sqlModel = 
"SELECT DISTINCT
	".$modelTable.".derivative
FROM
	".$modelTable."
WHERE
	".$modelTable.".id = '$ID'
LIMIT 1";
return $sqlModel;
}

function getDerivFromCapid($Car, $capid){
$derivTable = "";
if($Car)
	$derivTable = TBL_CAP_CARS;
else
	$derivTable = TBL_CAP_VANS;
	
$sqlDeriv = 
"SELECT DISTINCT
	".$derivTable.".DerivativeLong as derivative
FROM
	".$derivTable."
WHERE
	".$derivTable.".CAPID = '$capid'
LIMIT 1";
return $sqlDeriv;
}

$sqlVanBrand = 
"SELECT DISTINCT
	".TBL_VANBRANDS.".brand,
	".TBL_VANBRANDS.".id
FROM
	".TBL_VANBRANDS."
WHERE
	".TBL_VANBRANDS.".enabled = 1
ORDER BY
	".TBL_VANBRANDS.".brand";
	
$sqlEnabledBrand = 
"SELECT DISTINCT
	".TBL_BRANDS.".brand,
	".TBL_BRANDS.".id,
	".TBL_BRANDS.".enabled
FROM
	".TBL_BRANDS."
ORDER BY
	".TBL_BRANDS.".brand";
	
$sqlEnabledVanBrand =
"SELECT DISTINCT
	".TBL_VANBRANDS.".brand,
	".TBL_VANBRANDS.".id,
	".TBL_VANBRANDS.".enabled
FROM
	".TBL_VANBRANDS."
ORDER BY
	".TBL_VANBRANDS.".brand";
	
function updateBrands($BrandID, $Enabled, $Car){
$tbl;
if ($Car)
	$tbl = TBL_BRANDS;
else
	$tbl = TBL_VANBRANDS;
$sqlBrandName = 
"UPDATE 
	".$tbl."
SET
	".$tbl.".enabled = '".$Enabled."'
WHERE
	".$tbl.".id = '".$BrandID."'";
return $sqlBrandName;
}

function updateModels($ModelID, $Enabled, $Car) {
$tbl;
if ($Car)
	$tbl = TBL_MODELS;
else
	$tbl = TBL_VANMODELS;
$sqlUpdateModel = 
"UPDATE 
	".$tbl."
SET
	".$tbl.".enabled = '".$Enabled."'
WHERE
	".$tbl.".id = '".$ModelID."'";
return $sqlUpdateModel;
}

function getEnabledModels($BrandID, $Enabled, $Car){
$tbl;
if ($Car)
	$tbl = TBL_MODELS;
else
	$tbl = TBL_VANMODELS;
$sqlModels= 
"SELECT 
	".$tbl.".model,
	".$tbl.".id
FROM
	".$tbl."
WHERE
	".$tbl.".brandID = '$BrandID' 
AND
	".$tbl.".enabled = '$Enabled'";
return $sqlModels;
}

function getCapModels($BrandID, $Enabled, $Car){

if ($Car) {
	$deriv_table = TBL_CAP_CAR;
	$model_table = TBL_MODELS;
}
else {
	$deriv_table = TBL_CAP_VAN;
	$model_table = TBL_VANMODELS;
}
	
$BrandID = str_replace('+', ' ', $BrandID);

$sqlModels= 
 "SELECT 
	  DISTINCT ModelShort AS model
	FROM 
	  ".$deriv_table." AS c 
	INNER JOIN 
	  ".TBL_RATE_BOOK." AS r ON c.CAPID = CAP_Id 
	INNER JOIN 
	  ".$model_table." AS m ON c.ModelShort = m.model 
	WHERE
	  c.Manufacturer = '".$BrandID."'
	AND
	  m.enabled = ".$Enabled."
	ORDER BY
	  c.ModelShort ASC";

  return $sqlModels;
}

function getEnabledDerivs($ModelID, $Enabled, $Car){
$tbl;
if ($Car)
	$tbl = TBL_DERIVS;
else
	$tbl = TBL_VANDERIVS;
$sqlDerivs = 
"SELECT 
	".$tbl.".derivative,
	".$tbl.".id
FROM
	".$tbl."
WHERE
	".$tbl.".modelID = '$ModelID' 
AND
	".$tbl.".enabled = '$Enabled'
ORDER BY
	".$tbl.".derivative";
return $sqlDerivs;
}

function getCapDerivs($ModelID, $Car){
	if ($Car)
		$tbl = TBL_CAP_CAR;
	else
		$tbl = TBL_CAP_VAN;

	$ModelID = str_replace('+', ' ', $ModelID);

	$sqlDerivs = 
	"SELECT 
		DISTINCT c.DerivativeLong as derivative,
	  c.CAPID
	FROM
		".$tbl." as c
	INNER JOIN
		".TBL_RATE_BOOK." AS r ON c.CAPID = r.CAP_Id 
	WHERE
		c.ModelShort = '$ModelID' 
	ORDER BY
		c.DerivativeLong";
		
	return $sqlDerivs;
}

function getModels($BrandName, $Car){
$tblBrands;
$tblModels;
if ($Car)
{
	$tblBrands = TBL_BRANDS;
	$tblModels = TBL_MODELS;
}
else
{
	$tblBrands = TBL_VANBRANDS;
	$tblModels = TBL_VANMODELS;
}
$sqlBrandName = 
"SELECT 
	".$tblModels.".model
FROM
	".$tblModels."
INNER JOIN ".$tblBrands." ON (".$tblModels.".brandID = ".$tblBrands.".id)
WHERE
	".$tblBrands.".brand = '$BrandName'";
return $sqlBrandName;
}

function getVehicle($VehicleType, $VehicleID){
$tblBrands;
$tblModels;
$tblDerivs;

if($VehicleType){
	$tblBrands = TBL_BRANDS;
	$tblModels = TBL_MODELS;
	$tblDerivs = TBL_DERIVS;
}
else{
	$tblBrands = TBL_VANBRANDS;
	$tblModels = TBL_VANMODELS;
	$tblDerivs = TBL_VANDERIVS;
}
$getVehicle = 
"SELECT
	".$tblBrands.".brand,
	".$tblModels.".model,
	".$tblDerivs.".derivative
FROM
	".$tblDerivs."
	INNER JOIN ".$tblModels." ON (".$tblDerivs.".modelID = ".$tblModels.".id)
	INNER JOIN ".$tblBrands." ON (".$tblModels.".brandID = ".$tblBrands.".id)
WHERE
	(".$tblDerivs.".id = $VehicleID) LIMIT 1";
return $getVehicle;
}

function getCapVehicle($VehicleType, $capid){
  if($VehicleType){
	  $tblDerivs = TBL_CAP_CAR;
  }
  else{
	  $tblDerivs = TBL_CAP_VAN;
  }
  $getVehicle = 
  "SELECT
	  ".$tblDerivs.".Manufacturer as brand,
	  ".$tblDerivs.".ModelShort as model,
	  ".$tblDerivs.".DerivativeLong as derivative
  FROM
	  ".$tblDerivs."
  WHERE
	  (".$tblDerivs.".CAPID = $capid) LIMIT 1";
  return $getVehicle;
}

function addTestimonial($Name, $Vehicle, $Testimonial){
$sqlAddTest = 
"INSERT INTO 
	".TBL_TESTIMONIALS."
	(name, vehicle, testimonial)
VALUES
	('$Name', '$Vehicle', '$Testimonial')";
return $sqlAddTest;
}

$sqlGetTestimonials= 
"SELECT
	
	".TBL_TESTIMONIALS.".id,
	".TBL_TESTIMONIALS.".name,
	".TBL_TESTIMONIALS.".testimonial,
	".TBL_TESTIMONIALS.".vehicle
FROM
	".TBL_TESTIMONIALS."
ORDER BY
	RAND() LIMIT 1";

$sqlGetImageNames= 
"SELECT
	".TBL_IMAGES.".name,
	".TBL_IMAGES.".id
FROM
	".TBL_IMAGES."
ORDER BY
	".TBL_IMAGES.".name";
	
function getImage($ImageID){
$sqlGetImage= 
"SELECT
	".TBL_IMAGES.".small,
	".TBL_IMAGES.".large
FROM
	".TBL_IMAGES."
WHERE
	".TBL_IMAGES.".id = '$ImageID'";
return $sqlGetImage;
}

function derivsByModel($VehicleType, $ModelName) {
	if($VehicleType == 'cars'){
		$tblDerivs = TBL_CAP_CAR;
	}
	else{
		$tblDerivs = TBL_CAP_VAN;
	}
	
	$sql = 
	 "SELECT
		  d.CAPID,
		  d.Manufacturer,
		  d.ModelShort,
		  d.DerivativeLong AS Derivative,
		  r.P11D,
		  r.CO2,
		  r.BasicListPrice,
		  r.FinanceRental
		FROM 
		  ".$tblDerivs." as d, 
		  ".TBL_RATE_BOOK." as r 
		WHERE 
		  d.CAPID = r.CAP_ID 
		AND 
		  d.ModelShort = '".$ModelName."' 
		AND 
		  r.Mileage = 10000 
		AND 
		  r.Term = 36 
		ORDER BY 
		  d.DerivativeLong ASC";
		
	return $sql;

}

// Get vehicle info and rate book values given a capid and vtype
function vehicleInfoAndFinance($capid, $vtype) {
	if($vtype == 'car'){
		$tblDerivs = TBL_CAP_CAR;
	}
	else{
		$tblDerivs = TBL_CAP_VAN;
	}
	
	$sql = "SELECT CO2, P11D, FinanceRental, ServiceRental, EffectiveRentalValue, c.Manufacturer, ModelShort, ModelLong, DerivativeShort, DerivativeLong FROM ".$tblDerivs." AS c, tblratebook AS r ".
	       "WHERE c.CAPID = '$capid' ".
		     "AND c.CAPID = r.CAP_Id ".
		     "AND Mileage = 10000 ".
		     "AND Term = 36 ".
		     "LIMIT 1";

	return $sql;
}

function brandNotes($brand, $vtype) {
	$sql = "SELECT notes, imageid FROM ".TBL_BRAND_NOTES." WHERE brand = '".$brand."' AND vtype='".$vtype."'";
	return $sql;
}


// --------------- MSSQL Queries ---------------

// Get CAP imageID for a given CAPID
function capVehicleImage($capid) {
	$sql = "SELECT TOP 1 ImageID FROM tblNVDModelYear WHERE CAPID = $capid";
	
	return $sql;
}


// Return basic information for a single vehicle for a given CAPID
// This query makes sure the price being returned is the latest one
// If there is no active price then we assume the deriv is no longer available
function capVehicleInfo($capid) {
	$sql = "SELECT TOP 1 * ".
		"FROM vieCAPDerivativesAndCodes INNER JOIN ".
		"tblCAPMod ON vieCAPDerivativesAndCodes.ModelCode = tblCAPMod.ModelCode INNER JOIN ".
		"tblNVDPrices ON vieCAPDerivativesAndCodes.CAPID = tblNVDPrices.CAPIDNumber INNER JOIN ".
		"tblCAPMan ON vieCAPDerivativesAndCodes.ManCode = tblCAPMan.ManCode INNER JOIN ".
		"tblNVDModelYear ON vieCAPDerivativesAndCodes.CAPID = tblNVDModelYear.CAPID INNER JOIN ".
		"tblCAPRanges ON tblCAPMod.RangeCode = tblCAPRanges.RangeCode ".
		"WHERE DateOptionEffectiveTo IS NULL ".
		"AND vieCAPDerivativesAndCodes.CAPID = $capid";
		
	return $sql;
}

// Get a list of all the available options for this vehicle
function capVehicleOptions($capid) {
	$sql = "SELECT CAPIDNumber, tblNVDOptions.OptionCode, CatCode, CategoryDesc, LongDesc ".
	       "FROM tblNVDOptions INNER JOIN ".
	       "tblNVDDictionaryOption ON tblNVDOptions.OptionCode = tblNVDDictionaryOption.OptionCode INNER JOIN ".
	       "tblNVDDictionaryCategory ON tblNVDDictionaryOption.CatCode = tblNVDDictionaryCategory.CategoryCode ".
	       "WHERE DateOptionEffective_To IS NULL ".
	       "AND CAPIDNumber = $capid ".
	       "ORDER BY CategoryDesc, LongDesc";

	return $sql;
}

// Get the list of standard equipment for the vehicle deriv defined by $capid
function capVehicleStandardEquipment($capid) {
	$sql = "SELECT CAPIDNumber, tblNVDStandardEquipment.OptionCode, CatCode, LongDesc ".
	       "FROM tblNVDStandardEquipment INNER JOIN ".
	       "tblNVDDictionaryOption ON tblNVDStandardEquipment.OptionCode = tblNVDDictionaryOption.OptionCode ".
	       "WHERE DateOptionEffectiveTo IS NULL ".
	       "AND CAPIDNumber = $capid ".
	       "ORDER BY CatCode, LongDesc";
	
	return $sql;
}
