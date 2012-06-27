<?php
function getDeals()
{
	include('dbConnect.php');
	$qryDeal = mysql_query(sqlGetDeals() ,$dbConnect);
	$count = 1; //3 colums if last one no margin-right
	$strDeals = "";
	$i=1;
	if($qryDeal)
	while ($rstDeal = mysql_fetch_array($qryDeal))
	{
		$strDealID = $rstDeal['id'];
		$strVehicleID = $rstDeal["vehicleID"];
		$strVehicleType = $rstDeal["vehicleType"];
		$qryVehicle = mysql_query(getVehicle($strVehicleType ,$strVehicleID) ,$dbConnect);
		$rstVehicle = mysql_fetch_array($qryVehicle);			
		$strBrand = $rstVehicle["brand"];
		$strModel = $rstVehicle["model"];
		$monthlyPayment = $rstDeal['monthly_payment'];
		$profile1 = $rstDeal['profile1'];
		$financeType = $rstDeal['financeType'];
		$imageID = $rstDeal['imageID'];
		$qryImage = mysql_query(getImage($imageID),$dbConnect);
		if($qryImage){
			$rstImage = mysql_fetch_array($qryImage);
			$imageLoc = $rstImage['small'];
		}
		$fType ="";
		if($financeType)
			$fType="hire";
		else
			$fType="lease";
		$class = "";
		$offer = "";
		if($strVehicleType){
			$class = "carDealBox";
			$offer = "car";
		}
		else{
			$class = "vanDealBox";
			$offer = "van";
		}
		$strDerivative = $rstVehicle["derivative"];
		$strD = explode(' ', $rstVehicle["derivative"]);
		$strDeriv = "";
		if (count($strD) >= 5)
		{
			for($x = 0; $x < 5; $x ++)
			{
				$strDeriv .= $strD[$x] . " ";
				if(strlen($strD[$x]) > 9)
					$x = 5;
			}
			$strDeriv .= "...";
		}
		else
		 $strDeriv = $strDerivative;
		
		if($strBrand != "BMW")
			$strBrand = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["brand"]))); 
		$strModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["model"])));
		if($rstDeal['special_offer'] == 0)
		{
		if ($count%3 == 0) {
			$class .= " rowLast";
			$count = 0;
		}
		
		$strDeals .= "
				<div class=\"$class\">
					<div class=\"dealContainer\">
						<span class=\"$offer\"></span>
						<span class=\"$fType\"></span>
						<span class=\"description\">$strBrand $strModel $strDeriv</span>
						<a href=\"/car_leasing-business-contract_hire-".$strBrand."-".$strDealID.".html\">
							<img class=\"carImage\" src=\"images/vehicles/$imageLoc\" title=\"$strBrand $strModel $strDerivative\" alt=\"$strBrand $strModel $strDerivative\"/>
						</a>
						<div class=\"price\">&pound;$monthlyPayment
							<small> + VAT per month</small>
							<small>$profile1</small>
						</div>									
						<div class=\"buttons\">
							<a class=\"info\" href=\"car_leasing-business-contract_hire-".$strBrand."-".$strDealID.".html\" title=\"Get more info on $strBrand $strModel $strDerivative\" >More Info</a>
							<a class=\"quote\" href=\"/car_leasing-business-get_quote-$strDealID.html\" title=\"Get a quote for $strBrand $strModel $strDerivative\">Quote Now</a>
						</div>
					</div>
				</div>";
		$i ++;
		$count ++;
	}
	}
	return $strDeals;
}