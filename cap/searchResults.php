<?php

// Build a readable URL for the vehicle detail page
function vehicle_url($manufacturer, $model, $capid, $vtype = 'car', $finance = 'business') {
	$url = 'vehicle-details_'.$finance.'_'.$vtype.'_'.$manufacturer.'_'.$model.'_'.$capid.'.html';
	$url = str_replace(' ', '+', $url);
	return $url;
}

require_once('includes/constants.php');
require_once('includes/sql.php');
require_once('includes/dbConnect.php');
require_once('capConfig.php');

if (isset($_GET['financeType']) && isset($_GET['vehicleType']) && isset($_GET['modelSelection']) && isset($_GET['brandSelection'])) {

  $finance = ($_GET['financeType'] == 'personal')? 'personal' : 'business'; // a form of query sanitisation
	$vtype = ($_GET['vehicleType'] == 'vans')? 'vans' : 'cars';
	$vtypeSingular = ($_GET['vehicleType'] == 'vans')? 'van' : 'car'; 
	$manufacturer = htmlspecialchars($_GET['brandSelection']);
	$model = mysql_real_escape_string($_GET['modelSelection']);

  print '<h1> Search results for '.$manufacturer.' '.$model.'</h1>';

	$derivs = mysql_query(derivsByModel($vtype, $model));
	if (!mysql_num_rows($derivs)) {
		print '<p><strong>Sorry, no deals found for this make and model. <a href="/">Search again</a></strong></p>';
	}
	else {
    
    // If available, pull notes about this brand (and vtype) from the brand notes table
    $brand_notes_qry = mysql_query(brandNotes($manufacturer, $vtypeSingular));
    if (mysql_num_rows($brand_notes_qry)) {	
	    $brandInfo = mysql_fetch_assoc($brand_notes_qry);
	/*
			$img = $_SERVER['DOCUMENT_ROOT'].'/cap/images/'.$brandInfo['imageid'].'.jpg';
		  if (file_exists($img)) {
			  $with_img = TRUE;
			  print '<div id="vehicle-image"><img alt="'.$manufacturer.'" src="/cap/images/'.$brandInfo['imageid'].'.jpg" /></div>';
		  }
	*/
	    print $brandInfo['notes'];
    }
    else {
	    // print some fallback content?
    }

    $finance_string = ($finance == 'personal')? '<h2 style="clear: both">Personal Finance Deals</h2>' : '<h2 style="clear: both">Business Finance Deals</h2>';
    $finance_column_header = ($finance == 'personal')? 'Monthly finance rental price including VAT' : 'Monthly finance rental price excluding VAT';
    print $finance_string;

		while ($deriv = mysql_fetch_assoc($derivs)) {
			$derivs_full[$deriv['Derivative']] = $deriv;
		}
		ksort($derivs_full);

		if (count($derivs_full)) {
			?>
			<p>These <?php $brand_range['brand'].' '.$brand_range['range']; ?> deals are based on a 3+35 months profile with 10k miles per annum.</p>
			
			<table class="product-derivs">
				<thead>
					<th width="58%" class="deriv-name">Vehicle</th>
					<th width="10%" class="deriv-co2"><abbr title="Carbon dioxide emmissions as g/km">CO<sub>2</sub></abbr></th>
					<th width="10%" class="deriv-p11d"><abbr title="Tax benefit value">P11D</abbr></th>
					<th width="12%" class="deriv-finance"><abbr title="<?php print $finance_column_header; ?>">Finance Rental</abbr></th>
					<th width="10%" class="deriv-more">&nbsp;</th>
				</thead>
				<?php foreach($derivs_full as $deriv) {?>
					<tr>
						<td class="deriv-name"><a href="<?php print vehicle_url($manufacturer, $model, $deriv['CAPID'], $vtypeSingular, $finance); ?>"><?php print $manufacturer . ' ' . $model . ' ' . $deriv['Derivative']; ?></a></td>
						<td class="deriv-co2 subtle"><?php print $deriv['CO2']; ?></td>
						<td class="deriv-p11d subtle">&pound;<?php print number_format($deriv['P11D'], 2, '.', ''); ?></td>
						<td class="deriv-finance"><strong>&pound;<?php print cap_format_price($deriv['FinanceRental'], $finance); ?></strong></td>
						<td class="deriv-more"><a class="vehicle-more" href="<?php print vehicle_url($manufacturer, $model, $deriv['CAPID'], $vtypeSingular, $finance); ?>">More Info</a></td>
					</tr>
					<?php } ?>
				</table>
				<?php
				
				if ($finance == 'personal') {
					$vat_percentage = 100 * ($VAT - 1);
					print '<p>Personal finance deals are inclusive of VAT at '.$vat_percentage.'%.</p>';
				}
		}
		else {
			print 'No vehicles found. <a href="/">Search again</a>';
		}
	
	}

}
else {
	print 'Sorry, there is a problem with your search. Please go back to the home page and try again.';
}