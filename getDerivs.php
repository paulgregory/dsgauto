<?php
session_start();
if (isset($_SESSION['dsgauto']))
{
	if( isset($_GET['vtype']) && isset($_GET['modelID']) )
	{
		$vtype = $_GET['vtype'];
		$modelID = $_GET['modelID'];
		$strDerivs = "";
		include('includes/constants.php');
		include('includes/sql.php');
		include('includes/dbConnect.php');
		$qryDerivs = "";
		switch($vtype)
		{
			case 'cars':
				$qryDerivs = mysql_query(getCapDerivs($modelID, 1, true),$dbConnect);
				break;
			case 'vans':
				$qryDerivs = mysql_query(getCapDerivs($modelID, 1, false),$dbConnect);
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