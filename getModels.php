<?php
session_start();
if (isset($_SESSION['dsgauto']))
{
	if( isset($_GET['vtype']) && isset($_GET['brandID']) )
	{
		include('includes/constants.php');
		include('includes/sql.php');
		include('includes/dbConnect.php');
		
		$vtype = $_GET['vtype'];
		$brandID = dsg_decode($_GET['brandID']);
		$strModels = "";
		
		$qryModels = "";
		switch($vtype)
		{
			case 'car':
				$qryModels = mysql_query(getCapModels($brandID, 1, true),$dbConnect);
				break;
			case 'van':
				$qryModels = mysql_query(getCapModels($brandID, 1, false),$dbConnect);
				break;
			default:; 
		}
		if($qryModels)
		{
			$strModels = "Please Select:0";
			while ($rstBrand = mysql_fetch_array($qryModels))
			{
				$strModelID = dsg_encode($rstBrand['model']);
				$strModel = $rstBrand['model']; 
				$strModels .= ",$strModel:$strModelID";
			}
		}
		if(!empty($strModels))
			echo $strModels;
		else
			echo "No models found";
	}
}
?>