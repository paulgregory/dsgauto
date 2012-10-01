<?php

require_once('includes/constants.php');
require_once('includes/sql.php');
require_once('includes/dbConnect.php');

if (isset($_GET['financeType']) && isset($_GET['vehicleType']) && isset($_GET['modelSelection']) && isset($_GET['brandSelection'])) {

  $finance = ($_GET['financeType'] == 'personal')? 'personal' : 'business'; // a form of query sanitisation
	$vtype = ($_GET['vehicleType'] == 'van')? 'van' : 'car';
	$vtypeSingular = ($_GET['vehicleType'] == 'van')? 'van' : 'car'; 
	$manufacturer = strtoupper(htmlspecialchars($_GET['brandSelection']));
	$model = strtoupper(mysql_real_escape_string($_GET['modelSelection']));

  $img = $_SERVER['DOCUMENT_ROOT'].'/images/brands-large/'.$manufacturer.'.png';
	if (file_exists($img)) {
		$with_img = TRUE;
	  print '<div id="brand-image"><img src="/images/brands-large/'.$manufacturer.'.png" /></div>';
  }

  $h1_string = ($finance == 'personal')? $manufacturer.' '.$model.'<br /><span class="subtitle">Personal Car Leasing Deals</span>' : $manufacturer.' '.$model.'<br /><span class="subtitle">Business Car Leasing Deals</span>';
  
  if ($with_img) {
    print '<h1 id="deriv-list-title" class="with-image">'.$h1_string.'</h1>';	
  }
  else {
    print '<h1 id="deriv-list-title">'.$h1_string.'</h1>';
  }

  // Re-include the search bar?
  // require_once('includes/SearchBarCap.php');

	$derivs = mysql_query(derivsByModel($vtype, $model));
	if (!mysql_num_rows($derivs)) {
		print '<p><strong>Sorry, no deals found for this make and model. <a href="/">Search again</a></strong></p>';
	}
	else {
    
    /*
    // If available, pull notes about this brand (and vtype) from the brand notes table
    $brand_notes_qry = mysql_query(brandNotes($manufacturer, $vtypeSingular));
    if (mysql_num_rows($brand_notes_qry)) {	
	    $brandInfo = mysql_fetch_assoc($brand_notes_qry);
			// $img = $_SERVER['DOCUMENT_ROOT'].'/cap/images/'.$brandInfo['imageid'].'.jpg';
		  // if (file_exists($img)) {
			//  $with_img = TRUE;
			//  print '<div id="vehicle-image"><img alt="'.$manufacturer.'" src="/cap/images/'.$brandInfo['imageid'].'.jpg" /></div>';
		  // }
	    print $brandInfo['notes'];
    }
    else {
	    // print some fallback content?
    }
    */

    $finance_vat = ($finance == 'personal')? 'inc VAT' : '+VAT';
    $finance_details = ($finance == 'personal')? 'These vehicle leasing deals are based on a payment profile of 3+35, allowing 10,000 miles per annum and exclude service, maintenance and tyres package. All prices shown include VAT. Maintenance packages, alternative mileage allowances and other contract term periods are available.' : 'These vehicle leasing deals are based on a payment profile of 3+35, allowing 10,000 miles per annum and exclude service, maintenance and tyres package. All prices shown exclude VAT. Maintenance packages, alternative mileage allowances and other contract term periods are available.';

		while ($deriv = mysql_fetch_assoc($derivs)) {
			$derivs_full[$deriv['Derivative']] = $deriv;
		}
		ksort($derivs_full);

		if (count($derivs_full)) {
			?>
			<p><?php print $finance_details; ?></p>
			
			<script src="/js/libs/sorttable.js"></script>
			<table class="product-derivs sortable">
				<thead>
					<th width="47%" class="deriv-name sorttable_header">Vehicle</th>
					<th width="8%" class="deriv-mpg sorttable_header">MPG</th>
					<th width="8%" class="deriv-co2 sorttable_header">CO<sub>2</sub></th>
					<th width="10%" class="deriv-p11d sorttable_header">P11D</th>
					<th width="18%" class="deriv-finance sorttable_header">Monthly Finance Rental</th>
					<th width="9%" class="deriv-more sorttable_nosort">&nbsp;</th>
				</thead>
				<?php foreach($derivs_full as $deriv) {?>
					<tr>
						<td class="deriv-name"><a href="/<?php print vehicle_url($manufacturer, $model, $deriv['Derivative'], $deriv['CAPID'], $vtypeSingular, $finance); ?>"><?php print $model . ' ' . $deriv['Derivative']; ?></a></td>
						<td class="deriv-mpg subtle"><?php print $deriv['MPG']; ?></td>
						<td class="deriv-co2 subtle"><?php print $deriv['CO2']; ?></td>
						<td class="deriv-p11d subtle">&pound;<?php print number_format($deriv['P11D'], 2, '.', ''); ?></td>
						<td class="deriv-finance"><span class="subtle">From</span> <strong><?php print cap_format_price($deriv['FinanceRental'], $finance); ?> </strong></td>
						<td class="deriv-more"><a class="vehicle-more" href="/<?php print vehicle_url($manufacturer, $model, $deriv['Derivative'], $deriv['CAPID'], $vtypeSingular, $finance); ?>">More Info</a></td>
					</tr>
					<?php } ?>
				</table>
				<?php
				
		}
		else {
			print 'No vehicles found. <a href="/">Search again</a>';
		}
	
	}

}
else {
	print 'Sorry, there is a problem with your search. Please go back to the home page and try again.';
}