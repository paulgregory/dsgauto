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
	$qrySpecialOffer = mysql_query(sqlCapDealGet($sodid, $Car, 1), $dbConnect);
	if($qrySpecialOffer)
	{
		$rstSpecialOffer = mysql_fetch_array($qrySpecialOffer);
		$vehicleID = $rstSO['vehicleID'];
		$qryVehicle = mysql_query(getCapVehicle($Car ,$vehicleID) ,$dbConnect);
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
				<span class=\"description\">$strBrand $strModel $strDeriv</span>
				<a href=\"/car_leasing-business-contract_hire-".$strBrand."_".$strModel."-".$sodid.".html\">
					<img class=\"carImage\" src=\"images/vehicles/$imageLoc\" title=\"$strBrand $strModel $strDerivative\" alt=\"$strBrand $strModel $strDerivative\"/>
				</a>
				<div class=\"price\">&pound;$monthlyPayment
					<small> + VAT per month</small>
					<small>$profile1</small>
				</div>									
				<div class=\"buttons\">
					<a class=\"info\" href=\"car_leasing-business-contract_hire-".$strBrand."-".$sodid.".html\" title=\"Get more info on $strBrand $strModel $strDerivative\" >More Info</a>
					<a class=\"quote\" href=\"/car_leasing-business-get_quote-$sodid.html\" title=\"Get a quote for $strBrand $strModel $strDerivative\">Quote Now</a>
				</div>
		</div>";
	}
?>

<div style="margin: auto; height: 314px; overflow: hidden">
	<?php include ('Slider.php'); ?>
    </div> <!--! end of slider -->

<!-- Search Bar -->

<div id="SearchBar">
	<?php include ('SearchBarCap.php'); ?>
	</div>

<h1 class="front-title">Welcome to DSG Auto Contracts</h1>
<h2>Your first point of contact for all car leasing, van leasing and contract hire</h2>
<ul id="main_list">
<li>Business Contract Hire, Personal Contract Hire, PCP, Lease Purchase and Finance Lease all available</li>
<li>Flexible Business and Personal car leasing deals</li>
<li>Finance arranged through the UK's largest vehicle finance funders.  Members of the BVRLA</li>
<li>Optional car and van maintenance available on all products</li>
<li>Established since 2003 with over 3000 happy customers, we are a part of the DSG Financial Services Group</li>
</ul><p>We are an independent contract hire, car and van leasing and finance brokerage based in Stockport, Manchester.</p>
<p>DSG Auto Contracts has provided competitive contract hire and car leasing deals throughout the UK since 2003 and are a proud member of the DSG Financial Services Group. We are confident we can help you find and finance your new or used company car, business or personal use vehicle(s).</p>
<p>Whether you are looking for; car leasing, van leasing, business car leasing, personal car leasing or contract hire, we are confident we can find you the best solution from our panel of vehicle finance funders. These partnerships continue our commitment to provide you with our Best Price First Time policy, searching and finding the most suitable, competitive and comprehensive  deal.</p>

<div id="box_container">

<a href="/car_leasing-business-articles-meet_the_team.html" class="box">
<img src="images/box1.jpg" alt="About DSG Auto Contracts" >
<h2>About DSG</h2>
<p>Find out more about our award winning business and why we believe in Absolute Excellence</p>
</a>

<a href="/car_leasing-business-articles-testimonials.html" class="box">
<img src="images/box2.jpg" alt="DSG Auto Contracts Testimonials" >
<h2>Testimonials</h2>
<p>Over 3000 happy customers since 2003, find out what real customers think about DSG Auto Contracts Ltd</p>
</a>

<a href="/car_leasing-business-articles-GAP_insurance.html" class="box">
<img src="images/box3.jpg" alt="Asset Protection from DSG Auto Contracts" >
<h2>Protection</h2>
<p>We offer competitive rates on GAP and Return to Invoice insurance to protect you and your asset</p>
</a>

<a href="/car_leasing-newsletter-subscribe.html" class="last">
<img src="images/box4.jpg" alt="Subscribe to our Contract Hire and Car Leasing Deals" >
<h2>Subscribe</h2>
<p>Never miss out on a great contract hire deal.  Leave your email address now and we'll keep in touch</p>
</a>

</div> <!--! end of #box_container -->