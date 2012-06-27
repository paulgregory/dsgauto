<?php
session_start();
if (isset($_GET['vtype']))
{
	$vtype = $_GET['vtype'];
	include('includes/constants.php');
	include('includes/sql.php');
	include('includes/dbConnect.php');
	$strBrandList = "";
	switch($vtype)
	{
		case 'car':
			$qryBrand = mysql_query($sqlCarBrand,$dbConnect);
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strBrandName = $rstBrand["brand"];
				if($strBrandName != "BMW")
					$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
				$strBrandList .= "<li><h4><a class=\"brand\" href=\"/car_leasing-business-get_quote.html\" title=\"$strBrandName Online Quoting\">
								$strBrandName
							</a></h4></li>";
			}
		break;
		case 'van':
			$qryBrand = mysql_query($sqlVanBrand,$dbConnect);
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strBrandName = $rstBrand["brand"];
				if($strBrandName != "BMW")
					$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
				$strBrandList .= "<li><h4><a class=\"brand\" href=\"/car_leasing-business-get_quote.html\" title=\"$strBrandName Online Quoting\">
								$strBrandName
							</a></h4></li>";
			}
		break;
		default:;
	}
	echo $strBrandList;
}
else
{
echo "Error fetching brand list";
}
?>