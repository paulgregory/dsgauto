<?php

/**
 * Generate the Meta data for the current page
 */
function generateHeader() {
	global $dbConnect;
		
	$t = "DSG Auto";
	$d = "Car Leasing, Contract Hire and Van Leasing specialist for business or personal use. Competitive contract hire and car leasing deals provided throughout the UK on all makes and models.";
	$k = "car leasing, car leasing uk, company car leasing, cheap, car lease, UK, personal, business, car finance, vehicle finance, lease cars, vehicle leasing, contract hire uk, leasing a car, leasing cars, personal car leasing, commercial vehicles, van leasing, van lease, vehicle leasing uk, contract hire, car leasing companies, renault, vauxhall, citroen, bmw";
	
	if(isset($_GET['stype']))
	{
		switch ($_GET['stype'])
		{
			// Home page
			case "deals":
				$t = "Car Leasing Deals, Contract Hire and Van Leasing from DSG Auto Contracts";
				$d = "Car Leasing, Contract Hire and Van Leasing specialist for business or personal use.  Competitive contract hire and car leasing deals provided throughout the UK on all makes and models.";
				break;
				
			// Special offers page
			case "specials":
				$t = "Car Leasing, Contract Hire and Van Leasing special offers from DSG Auto Contracts";
				$d = "Special Offer Car leasing and Van Leasing deals from DSG Auto Contracts";
				$k = "Car leasing deals, special offers, personal contract hire, business contract hire, company car leasing, cheap, car lease, car finance, vehicle leasing, personal car leasing, van leasing, van lease"; 
				break;
				
			// Administration pages
			case "admin":
				$t = "DSG Administration";
				$d = "DSG administration system - authorised users only";
				$k = ""; 
				break;
				
			// Contact Forms
			case "contactus":
				switch($_GET['level'])
				{
					case "phoneme":
						$t = "Contact Us | DSG Auto Contracts";
						break;
					case "getquote":
						$t = "Get A Quote | DSG Auto Contracts";
						break;
					case "applyonline":
					  $t = ($_GET['type'] == 'personal')? "Personal Finance Application Form | DSG Auto Contracts" : "Business Finance Application Form | DSG Auto Contracts";
						break;
					case "custtest":
						$t = "Testimonial | DSG Auto Contracts";
						break;
					default:
					  $t = "Contact Us | DSG Auto Contracts";
				}
				break;
				
			// Article pages
			case "article":
			  $aURL = (isset($_GET['aURL'])) ? $_GET['aURL'] : 0;
				$sql = sqlArticle($aURL);
				$qryArticle = mysql_query($sql, $dbConnect);
				if ($qryArticle) {
  				while ($rstArticle = mysql_fetch_array($qryArticle)) {
					  $t = $rstArticle['title'] . " | DSG Auto Contracts";
					  $d = $rstArticle['title'] . " - Competitive contract hire and car leasing deals provided throughout the UK on all makes and models.";
				  }
			  }
				break;
			
			// Deal pages
			case "deal":
				if(isset($_GET['did']))
				{
					$did = intval($_GET['did']);
					
					$qryVtype = mysql_query(getVehicleType($did));
					if ($qryVtype && mysql_num_rows($qryVtype) == 1) {
						$rstVtype = mysql_fetch_array($qryVtype);
						$vtype = $rstVtype['vehicleType'];
						$qryDeal = mysql_query(sqlCapDealGet($did, $vtype, 1), $dbConnect);

			      if ($qryDeal && mysql_num_rows($qryDeal)) {
				      while ($rstDeal = mysql_fetch_array($qryDeal)) {
					     	$strVehicleID = $rstDeal["vehicleID"];
								$strVehicleType = $rstDeal["vehicleType"];
								$qryVehicle = mysql_query(getCapVehicle($strVehicleType ,$strVehicleID) ,$dbConnect);
								$rstVehicle = mysql_fetch_array($qryVehicle);
								$strBrand = $rstVehicle["brand"];
								$strModel = $rstVehicle["model"];
								$strDeriv = $rstVehicle["derivative"];
								
							  $t = $strBrand . " " . $strModel;
							  $t = capitalise_brand($t);
							  $t .= ($vtype == 1)? " Car Leasing Special Offer" : " Van Leasing Special Offer";
							  $t .= " From DSG Auto Contracts";
							  $d = capitalise_brand($strBrand . " " . $strModel . " " . $strDeriv);
							  $d .= ($vtype == 1)? " Car Leasing Special Offer" : " Van Leasing Special Offer";
							  $d .= " From DSG Auto Contracts. Competitive contract hire and car leasing deals provided throughout the UK on all makes and models.";
							}
				    }
					}	
				};
				break;
				
      // Sitemap page
			case "sitemap":
				$t = "Site Map | DSG Auto Contracts";
				break;
				
			// Vehicle search results
			case "vehiclesearch":
			  $brand = capitalise_brand(str_replace('_', ' ', (htmlspecialchars($_GET['brandSelection']))));
			  $model = capitalise_brand(str_replace('_', ' ', (htmlspecialchars($_GET['modelSelection']))));
			  $vtype = htmlspecialchars($_GET['vehicleType']);
			  $vtypeUC = ucwords(htmlspecialchars($_GET['vehicleType']));
			
			  $brand_model = $brand . " " . $model;
        $t = "$brand_model $vtypeUC Leasing Deals and $brand_model Contract Hire | DSG Auto Contracts";
        $d = "$brand_model Personal or Business $vtypeUC Leasing Deals. Competitive contract hire and $vtype leasing deals provided throughout the UK on all makes and models.";
        $k = "$brand car leasing deals, $brand contract hire, $model";
        break;

      // Vehicle detail page
      case "vehicledetails":
        $capid = intval($_GET['capid']);
			  $vtype = ($_GET['vehicleType'] == 'car')? 'car' : 'van'; // a form of query sanitisation
			  $financeType = ($_GET['financeType'] == 'business')? 'Business finance deal' : 'Personal finance deal';
			  $qryVehicle = mysql_query(vehicleInfoAndFinance($capid, $vtype));
			
			  if ($vehicle = mysql_fetch_assoc($qryVehicle)) {
				  $brand = capitalise_brand($vehicle['Manufacturer']);
				  $model = capitalise_brand($vehicle['ModelShort']);
				  $deriv = $vehicle['DerivativeLong'];
				  $vtypeUC = ucwords($vtype);

          $t = "$brand $model $deriv Contract Hire and $vtypeUC Leasing deal | DSG Auto Contracts";
          $d = "$brand $model $deriv Personal or Business $vtypeUC Leasing Deal. Competitive contract hire and $vtype leasing deals provided throughout the UK on all makes and models.";
          $k = "$brand $model $deriv $vtype leasing deal, $brand contract hire, $model";
        }
        break;
		}
	}

	
	// Build header array
	$header['title'] = $t;
	$header['description'] = $d;
	$header['keywords'] = $k;
	
	return $header;
}
?>