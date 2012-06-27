<?php
session_start();
if (isset($_GET['vtype']) && isset($_SESSION['dsgauto']))
{
	$vtype = $_GET['vtype'];
	$_SESSION['vtype'] = $vtype;
	include('includes/constants.php');
	include('includes/sql.php');
	include('includes/dbConnect.php');
	$strBrandList = "";
	$qryBrand = "";
	switch($vtype)
	{
		case 'cars':
			$qryBrand = mysql_query($sqlCarBrand,$dbConnect);
		break;
		case 'vans':
			$qryBrand = mysql_query($sqlVanBrand,$dbConnect);
		break;
		default: $qryBrand = mysql_query($sqlCarBrand,$dbConnect);
	}
	if($qryBrand)
	{
		$strBrandList = "Please Select:0";
		while ($rstBrand = mysql_fetch_array($qryBrand))
		{
			$strBrandID = $rstBrand["id"];
			$strBrandName = $rstBrand["brand"];
			if($strBrandName != "BMW")
				$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
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