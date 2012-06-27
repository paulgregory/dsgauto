<?php 
		function getVehicles($Car)
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
				$strDealPaymentMonth = $rstDeal["monthly_payment"];
				$strTerm = $rstDeal["monthly_payments"];
				$strPayments = $rstDeal["initial_payment"];
				$class = "carDealBox";
				$offer = "car";
				$financeType = "hire";
				if($strVehicleType){
					$class = "carDealBox";
					$offer = "car";
				}
				else{
					$class = "vanDealBox";
					$offer = "van";
				}
				
				$strDeriv = $rstVehicle["derivative"];
				
				if($strBrand != "BMW")
					$strBrand = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["brand"]))); 
				$strVehicleModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["model"])));
				if($Car == $strVehicleType)
					$strDeals .= "<li><a href=\"car_leasing-business-contract_hire-".$strBrand."-".$strDealID.".html\" title=\"$strBrand $strVehicleModel $strDeriv\"> ".$strBrand." ".$strVehicleModel." ".$strDeriv."</a></li>";  
			}
			if (empty($strDeals))
				return "<li>No deals</li>";
			else
				return $strDeals;
		}
				
		$strCarBrandList = "";
		$qryBrand = mysql_query($sqlCarBrand,$dbConnect);
		if($qryBrand)
		{
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strBrandID = $rstBrand["id"];
				$strBrandName = $rstBrand["brand"];
				if($strBrandName != "BMW")
					$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
				$strCarBrandList .= "<li><a class=\"brand\" href=\"/car_leasing-business-get_quote-$strBrandName-c$strBrandID.html\" title=\"$strBrandName - Get a quote\">$strBrandName</a></li>";
			}
		}
		$strVanBrandList = "";
		$qryBrand = mysql_query($sqlVanBrand,$dbConnect);
		if($qryBrand)
		{
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strBrandID = $rstBrand["id"];
				$strBrandName = $rstBrand["brand"];
				if($strBrandName != "BMW")
					$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
				$strVanBrandList .= "<li><a class=\"brand\" href=\"/car_leasing-business-get_quote-$strBrandName-v$strBrandID.html\" title=\"$strBrandName - Get a quote\">$strBrandName</a></li>";
			}
		}
?>
<div id="sitemapTop"></div>
<div id="sitemap">
<h1>S<a href="/administration.html" rel="nofollow">i</a>te Map</h1>
<h2>Articles</h2>
<ul>
	<li><a href="/">Home</a></li>
	<li><a href="/car_leasing-business-articles-about_us.html" title="About Us">About Us</a></li>
	<li><a href="/car_leasing-business-articles-ready_for_quote.html" title="Get a Quote">Get a Quote</a></li>
	<li>Apply Online
		<ul>
			<li><a href="/car_leasing-business-apply_online-personal.html" title="Personal Application">Personal Application</a></li>
			<li><a href="/car_leasing-business-apply_online-business.html" title="Business Application">Business Application</a></li>
		</ul>
	</li>
	<li>Information Zone
		<ul>
			<li><a href="/car_leasing-business-articles-which_finance_package.html" title="Which Finance Package?">Which Finance Package?</a></li>
			<li><a href="/car_leasing-business-articles-testimonials.html" title="Customer Testimonials">Customer Testimonials</a></li>
			<li><a href="/car_leasing-business-articles-jargon_explained.html" title="Jargon Explained">Jargon Explained</a></li>
			<li><a href="/car_leasing-business-articles-how_to_order.html" title="How to order">How to order</a></li>
			<li><a href="/car_leasing-business-articles-Recruitment.html" title="Recruitment">Recruitment</a></li>
			<li><a href="/car_leasing-business-articles-van_leasing.html" title="Van Leasing">Van Leasing</a></li>
		</ul>
	</li>
	<li>Legal Information
		<ul>
			<li><a href="/car_leasing-business-articles-governing_legislation.html" title="Government Legislation">Governing Legislation</a></li>
			<li><a href="/car_leasing-business-articles-fsa_regulatory_disclosure.html" title="FSA Regulatory Disclosure">FSA Regulatory Disclosure</a></li>
		</ul>
	</li>
	<li>Protect Yourself
		<ul>
			<li><a href="/car_leasing-business-articles-motor_insurance.html" title="Motor Insurance">Motor Insurance</a></li>
			<li><a href="/car_leasing-business-articles-GAP_insurance.html" title="Article about GAP Insurance">GAP Insurance</a></li>
			<li><a href="/car_leasing-business-articles-vehicle_replacement_protection.html" title="Article about Return to Invoice Insurance">Return to Invoice Insurance</a></li>
		</ul>
	</li>
	<li>Contact Us
		<ul>
			<li><a href="/car_leasing-business-contact_us.html" title="General Enquiries">General Enquiries</a></li>
			<li><a href="/car_leasing-business-contact_us-phone_me.html" title="Request a Call">Request a Call</a></li>
		</ul>
	</li>
</ul>

<h2>Car Special Offers</h2>
<ul id="currentCarDeals">
	<?php echo getVehicles(true); ?>
</ul>
<h2>Van Special Offers</h2>
<ul id="currentVanDeals">
	<?php echo getVehicles(false); ?>
</ul>
<h2>Get a car quote</h2>
<ul id="CarBrandQuotes">
	<?php echo $strCarBrandList; ?>
</ul>
<h2>Get a van quote</h2>
<ul id="VanBrandQuotes">
	<?php echo $strVanBrandList; ?>
</ul>
</div>
<div id="sitemapBottom"></div>