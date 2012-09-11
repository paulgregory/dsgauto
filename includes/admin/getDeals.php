<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
?>
<div id="administrationTop"></div>
<div id="administration">
	<h1>Manage Deals</h1>
	
	<p><a href="/administration-deal.html" id="addDeal">Add Deal</a></p>
<?php 
	function getVehicles($car)
	{
		include('dbConnect.php');

    $strDeals = '';		
		$vtype = ($car)? 'car' : 'van';
		$qryDeals = mysql_query(sqlCapGetDeals($car), $dbConnect);

		if ($qryDeals) {
			while ($rstDeal = mysql_fetch_assoc($qryDeals)) {

			  $strDealID = $rstDeal['id'];
			  $strBrand = $rstDeal["brand"];
				$strModel = $rstDeal["model"];
				$strDeriv = $rstDeal["derivative"];
				if($strVehicleType){
					$class = "carDealBox";
					$offer = "car";
				}
				else{
					$class = "vanDealBox";
					$offer = "van";
				}
				
				$strDeals .= "
				<li>
				<a href=\"car_leasing-business-contract_hire-".str_replace(' ', '+', $strBrand)."-".$strDealID.".html\">[".$strDealID."] ".$strBrand." ".$strModel." ".$strDeriv."</a>
				&nbsp;&nbsp;&nbsp; <a class=\"editDeal\" href=\"/administration-deal-$strDealID.html\">Edit Deal</a>
				</li>";
			}
		}
		if (empty($strDeals))
			return "<li>No deals</li>";
		else
			return $strDeals;
	}
	
	print '<h2>Car Deals</h2>';
	print "<ul class=\"admin-list\" id=\"currentCarDeals\">". getVehicles(true)."</ul>";
	
	print '<h2>Van Deals</h2>';
	print "<ul class=\"admin-list\" id=\"currentVanDeals\">". getVehicles(false)."</ul>";

?>
<p><strong><a href="/administration.html">Return to admin menu</a></strong></p>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>