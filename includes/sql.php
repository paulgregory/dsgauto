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
"SELECT DISTINCT
	".TBL_CAP_CAR.".Manufacturer as brand
FROM
	".TBL_CAP_CAR."
ORDER BY
	".TBL_CAP_CAR.".Manufacturer";
	
$sqlCapVanBrand = 
"SELECT DISTINCT
	".TBL_CAP_VAN.".Manufacturer as brand
FROM
	".TBL_CAP_VAN."
ORDER BY
	".TBL_CAP_VAN.".Manufacturer";

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
$tbl;
if ($Car)
	$tbl = TBL_CAP_CAR;
else
	$tbl = TBL_CAP_VAN;
	
$BrandID = str_replace('+', ' ', $BrandID);

$sqlModels= 
"SELECT DISTINCT 
	".$tbl.".ModelShort as model
FROM
	".$tbl."
WHERE
	".$tbl.".Manufacturer = '$BrandID'";
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

function getCapDerivs($ModelID, $Enabled, $Car){
$tbl;
if ($Car)
	$tbl = TBL_CAP_CAR;
else
	$tbl = TBL_CAP_VAN;
	
$ModelID = str_replace('+', ' ', $ModelID);
	
$sqlDerivs = 
"SELECT 
	".$tbl.".DerivativeLong as derivative,
	".$tbl.".CAPID
FROM
	".$tbl."
WHERE
	".$tbl.".ModelShort = '$ModelID' 
ORDER BY
	".$tbl.".DerivativeLong";
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