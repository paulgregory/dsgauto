<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		if( isset($_GET['brand']) )
		{
			$brandName = $_GET['brand'];
			include('includes/constants.php');
			include('includes/dbConnect.php');
			include('includes/sql.php');
			$strModels = "";
			$qryBrand = mysql_query(getModels($brandName),$dbConnect);
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand['model']))); 
				$strModels .= "<option>".$strModel."</option>";
			}
			echo $strModels;
		}
	}
}
?>