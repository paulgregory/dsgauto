<?php
session_start();
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		if(isset($_GET['imageID']))
		{
			include('includes/constants.php');
			include('includes/sql.php');
			include('includes/dbConnect.php');
			$imageID = $_GET['imageID'];
			$qryImages = mysql_query(getImage($imageID), $dbConnect);
			$strOut = "";
			if($qryImages)
			{
				$rstImage = mysql_fetch_array($qryImages);
				$loc = $rstImage['small'];
				echo "images/vehicles/" . $loc;
			}
		}
	}
}

?>