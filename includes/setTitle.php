<?php
function getTitle() {
	include('includes/dbConnect.php');
	$title = "";
	if(isset($_GET['stype']))
	{
		switch ($_GET['stype'])
		{
			case "article":
				if (isset($_GET['aURL']))
					$aURL = $_GET['aURL'];
				else
					$aURL = 0;
				$qryArticle = mysql_query(sqlArticle($aURL),$dbConnect);
				if ($qryArticle)
				while ($rstArticle = mysql_fetch_array($qryArticle))
				{
					$strTitle = $rstArticle['title'];
					$title .= "$strTitle";
				}
				break;
			case "deals":
				$title .= "Car Leasing, Contract Hire and Van Leasing from DSG Auto Contracts";
				break;
			case "specials":
				$title .= "Car Leasing, Contract Hire and Van Leasing from DSG Auto Contracts";
				break;
			case "deal":
				if(isset($_GET['did']))
				{
					$did = $_GET['did'];
					$qryDeal = mysql_query(sqlDealGet($did, true, 1),$dbConnect);
					while ($rstDeal = mysql_fetch_array($qryDeal))
					{
						$did = $rstDeal['id'];
						$strVehicleID = $rstDeal["vehicleID"];
						$strVehicleType = $rstDeal["vehicleType"];
						$qryVehicle = mysql_query(getVehicle($strVehicleType ,$strVehicleID) ,$dbConnect);
						$rstVehicle = mysql_fetch_array($qryVehicle);			
						$strBrand = $rstVehicle["brand"];
						$strModel = $rstVehicle["model"];
						$strDeriv = $rstVehicle["derivative"];
						if($strBrand != "BMW")
							$strBrand = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["brand"]))); 
						$strModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["model"])));
					$title .= " | " .$strBrand . " " . $strModel . " " . $strDeriv;
					}	
				};
				break;
			case "contactus":
				if(isset($_GET['level']))
				{
					switch($_GET['level'])
					{
						case "phoneme":
							$title .= "Contact Us";
							break;
						case "getquote":
							$title .= "Get A Quote";
							break;
						case "applyonline":
							$title .= "Apply Online";
							break;
						case "custtest":
							$title .= "Testimonial";
							break;
					}
				}
				else
					$title .= "Contact Us";
				break;
			case "sitemap":
				$title .= "Site Map";
				break;
				
			case "vehiclesearch": // search results
        $title .= "Search results for " . htmlspecialchars($_GET['brandSelection']) . ' ' . htmlspecialchars($_GET['modelSelection']) . ' | DSG Auto Contracts';
        $title = str_replace('+', ' ', $title);
        break;
      case "vehicledetails": // search results
        $capid = intval($_GET['capid']);
			  $vtype = ($_GET['vehicleType'] == 'car')? 'car' : 'van'; // a form of query sanitisation
			  $qryVehicle = mysql_query(vehicleInfoAndFinance($capid, $vtype));
			  if ($vehicle = mysql_fetch_assoc($qryVehicle)) {
          $title .= "Vehicle finance details for " . htmlspecialchars($vehicle['Manufacturer']) . ' ' . htmlspecialchars($vehicle['ModelShort']) . ' ' . htmlspecialchars($vehicle['DerivativeLong']) . ' | DSG Auto Contracts';
          $title = str_replace('+', ' ', $title);
        }
        else {
	        $title .= "Problem retrieving vehicle info";
        }
        break;
				
			default:;
		}
	}
	if(isset($_GET['admin']))
	{
		$title .= "Administration";
	}
	
	return $title;
}
?>