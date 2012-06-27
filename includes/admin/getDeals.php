<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
?>
<div id="administrationTop"></div>
<div id="administration">
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
			
			$strD = explode(' ', $rstVehicle["derivative"]);
			$strDeriv = "";
			for($x = 0; $x < 5; $x ++)
			{
				if (count($strD) > $x)
					$strDeriv .= $strD[$x] . " ";
			}
			
			if($strBrand != "BMW")
				$strBrand = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["brand"]))); 
			$strVehicleModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstVehicle["model"])));
			if($Car == $strVehicleType)
				$strDeals .= "
				<li>
				<a href=\"car_leasing-business-contract_hire-".$strBrand."-".$strDealID.".html\"> ".$strDealID." ".$strBrand." ".$strModel." ".$strDeriv."</a>
				<a class=\"editDeal\" href=\"/administration-deal-$strDealID.html\">Edit Deal</a>
				</li>";  
		}
		if (empty($strDeals))
			return "<li>No deals</li>";
		else
			return $strDeals;
	}
	
	echo "<fieldset>
					<legend>Car Deals</legend>
					<ul id=\"currentCarDeals\">". getVehicles(true)."</ul>
				</fieldset>
				<fieldset>
					<legend>Van Deals</legend>
					<ul id=\"currentVanDeals\">". getVehicles(false)."</ul>
				</fieldset>";
?>
<a href="/administration-deal.html" id="addDeal">Add Deal</a>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>