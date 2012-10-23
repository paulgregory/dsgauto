<?php
session_start();
if (isset($_GET['vtype']) && isset($_SESSION['dsgauto']))
{
	include('includes/constants.php');
	include('includes/sql.php');
	include('includes/dbConnect.php');
	
	$vtype = $_GET['vtype'];
	$_SESSION['vtype'] = $vtype;
	
	$strBrandList = "";
	$qryBrand = "";
	switch($vtype)
	{
		case 'car':
			$qryBrand = mysql_query($sqlCapCarBrand,$dbConnect);
		break;
		case 'van':
			$qryBrand = mysql_query($sqlCapVanBrand,$dbConnect);
		break;
		default: $qryBrand = mysql_query($sqlCapCarBrand,$dbConnect);
	}
	if($qryBrand)
	{
		$strBrandList = "Please Select:0";
		while ($rstBrand = mysql_fetch_array($qryBrand))
		{
			$strBrandID = dsg_encode($rstBrand["brand"]);
			$strBrandName = $rstBrand["brand"];
			$strBrandList .= ",$strBrandName:$strBrandID";
		}
	}
	if(!empty($strBrandList))
		echo $strBrandList;
	else
		echo "No brands found";
}
else
{
echo "Error fetching brand list";
}
?>