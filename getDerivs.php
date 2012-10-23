<?php
session_start();
if (isset($_SESSION['dsgauto']))
{
	if( isset($_GET['vtype']) && isset($_GET['modelID']) )
	{
		include('includes/constants.php');
		include('includes/sql.php');
		include('includes/dbConnect.php');
		
		$vtype = $_GET['vtype'];
		$modelID = dsg_decode($_GET['modelID']);
		$strDerivs = "";
		
		$qryDerivs = "";
		switch($vtype)
		{
			case 'car':
				$qryDerivs = mysql_query(getCapDerivs($modelID, true),$dbConnect);
				break;
			case 'van':
				$qryDerivs = mysql_query(getCapDerivs($modelID, false),$dbConnect);
				break;
			default:; 
		}
		if($qryDerivs)
		{
			$strDerivs = "Please Select:0";
			while ($rstDerivs = mysql_fetch_array($qryDerivs))
			{
				$strDerivID = $rstDerivs['CAPID'];
				$strDeriv = $rstDerivs['derivative']; 
				$strDerivs .= ",$strDeriv:$strDerivID";
			}
		}
		if(!empty($strDerivs))
			echo $strDerivs;
		else
			echo "No derivatives found";
	}
}
?>