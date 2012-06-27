<?php
		if( isset($_GET['brand']) )
		{
			$enabled = $_GET['enabled'];
			$brandName = $_GET['brand'];
			include('/includes/constants.php');
			include('/includes/dbConnect.php');
			include('/includes/sql.php');
			$strModels = "";
			$qryBrand = mysql_query(getEnabledModels($brandName, $enabled),$dbConnect);
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand['model']))); 
				$strModels .= "<option>".$strModel."</option>";
			}
			echo $strModels;
		}

?>