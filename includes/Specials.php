<?php
	$qrySO = mysql_query($sqlSpecialOffer, $dbConnect);
	$rstSO = mysql_fetch_array($qrySO);
	$sodid = $rstSO['id'];
	$vehicleType = $rstSO['vehicleType'];
	$Car;
	$dealSpecialOffer = "";
	if($vehicleType == '1')
		$Car = true;
	else
		$Car = false;
	$qrySpecialOffer = mysql_query(sqlDealGet($sodid, $Car, 1), $dbConnect);
	if($qrySpecialOffer)
	{
		$rstSpecialOffer = mysql_fetch_array($qrySpecialOffer);
		$vehicleID = $rstSO['vehicleID'];
		$qryVehicle = mysql_query(getVehicle($Car ,$vehicleID) ,$dbConnect);
		$rstVehicle = mysql_fetch_array($qryVehicle);			
		$strBrand = $rstVehicle["brand"];
		$strModel = $rstVehicle["model"];
		$initialPayment = $rstSO['initial_payment'];
		$monthlyPayment = $rstSO['monthly_payment'];
		$term = $rstSO['monthly_payments'];
		$annualMileage = $rstSO['annual_mileage'];
		$docFee = $rstSO['doc_fee'];
		$profile1 = $rstSO['profile1'];
		$profile2 = $rstSO['profile2'];
		$financeType = $rstSO['financeType'];
		$notes = $rstSO['notes'];
		$business = $rstSO['business'];
		$personal = $rstSO['personal'];
		$imageID = $rstSO['imageID'];
		$finalPayment = $rstSO['final_payment'];
		$imageID = $rstSO['imageID'];
		$qryImage = mysql_query(getImage($imageID),$dbConnect);
		if($qryImage){
			$rstImage = mysql_fetch_array($qryImage);
			$imageLoc = $rstImage['large'];
		}
		$fType ="";
		if($financeType)
			$fType="hire";
		else
			$fType="lease";
		$offer = "";
		if($Car){
			$offer = "car";
		}
		else{
			$offer = "van";
		}
		$strDerivative = $rstVehicle["derivative"];
		$strD = explode(' ', $rstVehicle["derivative"]);
		$strDeriv = "";
		for($x = 0; $x < 3; $x ++)
		{
			if (count($strD) > $x)
				$strDeriv .= $strD[$x] . " ";
		}
		if($strBrand != "BMW")
			$strBrand = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["brand"]))); 
		$strModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["model"])));
		$dealSpecialOffer = "
			<div class=\"dealContainer\">
				<h2>Special Offer of the Week</h2>
				<span class=\"$offer\"></span>
				<span class=\"$fType\"></span>
				<span class=\"description\">$strBrand<br />$strModel $strDeriv</span>
				<a href=\"/car_leasing-business-contract_hire-".$strBrand."_".$strModel."-".$sodid.".html\">
					<img class=\"carImage\" src=\"images/vehicles/$imageLoc\" title=\"$strBrand $strModel $strDerivative\" alt=\"$strBrand $strModel $strDerivative\"/>
				</a>
				<div class=\"price\">&pound;$monthlyPayment
					<small> + VAT per month</small>
					<small><br />$profile1</small>
				</div>									
				<div class=\"buttons\">
					<a class=\"info\" href=\"car_leasing-business-contract_hire-".$strBrand."-".$sodid.".html\" title=\"Get more info on $strBrand $strModel $strDerivative\" >More Info</a>
					<a class=\"quote\" href=\"/car_leasing-business-get_quote-$sodid.html\" title=\"Get a quote for $strBrand $strModel $strDerivative\">Quote Now</a>
				</div>
		</div>";
	}
?>
<div id="whyDSG">
<h2>Why use DSG Auto Contracts?</h2>
<ul style="font-weight: bold; color: #DB2A34">
	<li>Competitive deals</li>
	<li>Honest service</li>
	<li>Professional advice</li>
	<li>Reliable people</li>
	<li>Established since 2003</li> 
</ul>
<p style="margin-top: 10px">We have competitive deals on car leasing, van leasing and contract hire. We have some of the cheapest car and van business or personal contract hire, finance lease and contract purchase (PCP) deals in the UK. 
Ordering your new car with DSG is easy, our personal service will ensure you enjoy the whole process.</p>
</div>
<div id="specialOffer">
	<?php echo $dealSpecialOffer; ?>
</div>
<div id="deals">
<?php
	include('getDeals.php');
	echo getDeals();
?>
<p class="dealsText">
	All the special offer car and van leasing deals on this page are displayed and offered for Business Users Only and Exclude VAT. 
	Personal Contract Hire is also available – Click on More Info. Visit <a target="_blank" href="http://www.newcar4me.com">www.newcar4me.com</a> for Personal Contract Purchase deals. 
</p>
</div>