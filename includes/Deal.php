<?php

	$strDeal = "";
	if(isset($_GET['did']))
	{	
		$did = intval($_GET['did']);
		
		$qryVtype = mysql_query(getVehicleType($did));

		if ($qryVtype && mysql_num_rows($qryVtype) == 1) {
			$rstVtype = mysql_fetch_array($qryVtype);
			$vtype = $rstVtype['vehicleType'];
			
			$qryDeal = mysql_query(sqlCapDealGet($did, $vtype, 1), $dbConnect);

      if ($qryDeal && mysql_num_rows($qryDeal)) {
	
			while ($rstDeal = mysql_fetch_array($qryDeal))
			{
				$did = $rstDeal['id'];
				$strVehicleID = $rstDeal["vehicleID"];
				$strVehicleType = $rstDeal["vehicleType"];
				$qryVehicle = mysql_query(getCapVehicle($strVehicleType ,$strVehicleID) ,$dbConnect);
				$rstVehicle = mysql_fetch_array($qryVehicle);			
				$strBrand = $rstVehicle["brand"];
				$strModel = $rstVehicle["model"];
				$strDeriv = $rstVehicle["derivative"];
				$initialPayment = $rstDeal['initial_payment'];
				$monthlyPayment = $rstDeal['monthly_payment'];
				$term = $rstDeal['monthly_payments'];
				$annualMileage = $rstDeal['annual_mileage'];
				$docFee = $rstDeal['doc_fee'];
				$profile1 = $rstDeal['profile1'];
				$profile2 = $rstDeal['profile2'];
				$financeType = $rstDeal['financeType'];
				$notes = $rstDeal['notes'];
				$business = $rstDeal['business'];
				$personal = $rstDeal['personal'];
				$imageID = $rstDeal['imageID'];
				$finalPayment = $rstDeal['final_payment'];
				$imageID = $rstDeal['imageID'];
				$qryImage = mysql_query(getImage($imageID),$dbConnect);
				if($qryImage){
					$rstImage = mysql_fetch_array($qryImage);
					$imageLoc = $rstImage['large'];
				}
				$fType ="";
				if($financeType)
					$fType="Contract Hire";
				else
					$fType="Finance Lease*";
				$offer = "";
				if($strVehicleType){
					$offer = "Car";
				}
				else{
					$offer = "Van";
				}

				$strBrand = $rstVehicle["brand"];
				$strModel = $rstVehicle["model"];

				$strDeal .= "
					<h1><strong>$fType $offer Leasing Special Offer</strong></h1>
					<div id=\"details\">
						<h2>$strBrand $strModel $strDeriv</h2>
						<img class=\"carImage\" src=\"images/vehicles/$imageLoc\" title=\"$strBrand $strModel $strDeriv\" alt=\"$strBrand $strModel $strDeriv\" />";
					if($financeType == 1)
						$strDeal .= "<span class=\"mileage\">Annual Mileage: $annualMileage</span>";
					$strDeal .= "
						<span class=\"docFee\">Doc Fee: &pound;$docFee</span>
						<span class=\"paymentProfile\">Payment Profile: $profile2</span>
						<p class=\"notes\">$notes</p>";
					if($business == 1)
						$strDeal .= 
							"<div class=\"businessPrice\">
								<div class=\"col1\"><strong>Business price</strong></div>
								<div class=\"col2\">Inital payment 
									<span class=\"price\">&pound;$initialPayment</span> 
									<span class=\"vat\">+ VAT</span>
								</div>
								<div class=\"col3\">Followed by 
									<span class=\"term\">$term</span>
								</div> 
								<div class=\"col4\">Monthly payments 
									<span class=\"price\">&pound;$monthlyPayment</span> 
									<span class=\"vat\">+ VAT</span>
								</div>";
						if($financeType == 0)
							$strDeal .= "
								<div class=\"col5\">Followed by 
									<span class=\"term\">1</span>
								</div>
								<div class=\"col6\">Final payment
									<span class=\"price\">&pound;$finalPayment</span>
									<span class=\"vat\">+ VAT</span>
								</div>";
						if($financeType == 1)
						$strDeal .= "
								<a href=\"/car_leasing-business-apply_online-business-$did.html\" title=\"Start a Business Application\" class=\"applyNow\">Apply Now</a>
								<a href=\"/car_leasing-business-get_quote-$did.html\" title=\"Get a quote\" class=\"getQuote\">Get A Quote</a>
								<a href=\"/car_leasing-business-contact_us-phone_me.html\" title=\"Request a Call Back\" class=\"callNow\">Request Call Back</a>";
						$strDeal .= 
							"</div>";
					if($financeType == 0)
					$strDeal .= 
						"<div class=\"finalPayment\">
								<a href=\"/car_leasing-business-apply_online-business-$did.html\" title=\"Start a Business Application\" class=\"applyNow\">Apply Now</a>
								<a href=\"/car_leasing-business-get_quote-$did.html\" title=\"Get a quote\" class=\"getQuote\">Get A Quote</a>
								<a href=\"/car_leasing-business-contact_us-phone_me.html\" title=\"Request a Call Back\" class=\"callNow\">Request Call Back</a>
							</div>";
					if($personal == 1) 
						$strDeal .= 
							"<div class=\"personalPrice\">
								<div class=\"col1\"><strong>Personal price</strong></div>
								<div class=\"col2\">Inital payment 
									<span class=\"price\">&pound;". number_format($initialPayment*$VAT, 2, '.', '') ."</span>
									<span class=\"vat\">INC VAT</span>
								</div>
								<div class=\"col3\">Followed by 
									<span class=\"term\">$term</span>
								</div>
								<div class=\"col4\">Monthly payments 
									<span class=\"price\">&pound;". number_format($monthlyPayment*$VAT, 2, '.', '') ."</span>
									<span class=\"vat\">INC VAT</span>
								</div>
								<a href=\"/car_leasing-business-apply_online-personal-$did.html\" title=\"Start a Personal Application\" class=\"applyNow\">Apply Now</a>
								<a href=\"/car_leasing-business-get_quote-$did.html\" title=\"Get a quote\" class=\"getQuote\">Get A Quote</a>
								<a href=\"/car_leasing-business-contact_us-phone_me.html\" title=\"Request a Call Back\" class=\"callNow\">Request Call Back</a>
							</div>";
					if($financeType == 0)
						$strDeal .=
						"<span class=\"financeLease\">*Finance Lease is only available to Business Customers</span>
						</div>";
					else
					$strDeal .=
				  "</div>";
			} ?>
			<div id="dealTop"><!-- --></div>
			<div id="deal">
				<?php 
				if (isset($_SESSION['status']))
						if ($_SESSION['status'] == 'authenticated')
							$strDeal .= "<a id=\"adminEdit\" href=\"administration-deal-$did.html\">Edit Deal</a>";
				echo $strDeal;
				?>
				<div class="clear"></div>
			</div>
			<div id="dealBottom"><!-- --></div>
			<?php
		  }
		  else {
			  print '<h1>Deal Error</h1><p><strong>Sorry deal &amp; vehicle details could not be found. This vehicle may no longer be available. Contact us for more info.</strong></p>';
		  }
		}
		else {
			print '<h1>Deal Error</h1><p><strong>Sorry, deal not found. This deal may have expired. Contact us for more information.</strong></p>';			
		}		
		
		
	}
?>

<!-- <h3><strong>Other Cars in this price range</strong></h3> -->
