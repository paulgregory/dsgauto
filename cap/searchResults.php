<?php

// Build a readable URL for the vehicle detail page
function vehicle_url($manufacturer, $model, $capid, $finance = 'business') {
	$url = 'vehicle-details_'.$finance.'_'.$manufacturer.'_'.$model.'_'.$capid.'.html';
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
	$manufacturer = htmlspecialchars($_GET['brandSelection']);
	$model = mysql_real_escape_string($_GET['modelSelection']);
	
	$derivs = mysql_query(derivsByModel($vtype, $model));
	if (!mysql_num_rows($derivs)) {
		print 'Model not recognised';
	}
	else {
		
		print '<h1> Search results for '.$manufacturer.' '.$model.'</h1>';
    
    // TODO: Pull this content from an additional model descriptions table
    print '<p>Morbi a neque metus. Nam egestas nisi quis est pulvinar sollicitudin. Donec lobortis scelerisque eros et posuere. Vivamus fringilla bibendum lacus, eget placerat ante pharetra ut. Fusce a quam ut nisi fermentum lacinia. Nulla semper tincidunt ante a convallis. Pellentesque ac nulla libero, quis pellentesque ligula. Suspendisse posuere nunc a nunc faucibus non elementum lectus vulputate.</p>';

    $finance_string = ($finance == 'personal')? '<h2>Personal Finance Deals</h2>' : '<h2>Business Finance Deals</h2>';
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
					<th width="10%" class="deriv-co2"><abbr title="Carbon dioxide emmissions as g/km">CO2</abbr></th>
					<th width="10%" class="deriv-p11d"><abbr title="Tax benefit value">P11D</abbr></th>
					<th width="12%" class="deriv-finance"><abbr title="<?php print $finance_column_header; ?>">Finance Rental</abbr></th>
					<th width="10%" class="deriv-more">&nbsp;</th>
				</thead>
				<?php foreach($derivs_full as $deriv) {?>
					<tr>
						<td class="deriv-name"><a href="<?php print vehicle_url($manufacturer, $model, $deriv['CAPID']); ?>"><?php print $manufacturer . ' ' . $model . ' ' . $deriv['Derivative']; ?></a></td>
						<td class="deriv-co2 subtle"><?php print $deriv['CO2']; ?></td>
						<td class="deriv-p11d subtle">&pound;<?php print number_format($deriv['P11D'], 2, '.', ''); ?></td>
						<td class="deriv-finance"><strong>&pound;<?php print cap_format_price($deriv['FinanceRental'], $finance); ?></strong></td>
						<td class="deriv-more"><a class="vehicle-more" href="<?php print vehicle_url($manufacturer, $model, $deriv['CAPID']); ?>">More Info</a></td>
					</tr>
					<?php } ?>
				</table>
				<?php
				
				if ($finance == 'personal') {
					print '<p>Personal finance deals are inclusive of VAT at '.VAT_AMOUNT.'%.</p>';
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