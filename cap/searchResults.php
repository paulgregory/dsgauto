<?php

require_once('capQueries.php');

// Build a readable URL for the vehicle detail page
function vehicle_url($br, $deriv, $finance = 'business') {
	$url = 'vehicle_details-finance_'.$finance.'-'.$br['brand'].'-'.$br['range'].'-'.$deriv['CAPID'].'.html';
	$url = str_replace(' ', '_', $url);
	return $url;
}


require_once('includes/constants.php');
require_once('includes/dbConnect.php');

if (isset($_GET['financeType']) && isset($_GET['vehicleType']) && isset($_GET['modelSelection'])) {

  $finance = ($_GET['financeType'] == 'personal')? 'personal' : 'business'; // a form of query sanitisation
	$vtype = ($_GET['vehicleType'] == 'vans')? 'vans' : 'cars'; 
	$model = intval($_GET['modelSelection']);
	
	// Use the text model name to find all derivatives on the CAP feed (MSSQL)
	// Finance pricing is taken from the Ratebook (MySQL)
	if ($vtype == 'cars') {
	  $sql = "SELECT model as 'range', brand FROM tblcarmodels as m, tblcarbrands as b WHERE b.id = m.brandID AND m.id = $model LIMIT 1";
	}
	elseif ($vtype == 'vans') {
		$sql = "SELECT model as 'range', brand FROM tblvanmodels as m, tblvanbrands as b WHERE b.id = m.brandID AND m.id = $model LIMIT 1";
	}
	
	$qryRange = mysql_query($sql);
	if (mysql_num_rows($qryRange)) {
		$brand_range = mysql_fetch_assoc($qryRange, 0);
	} else {
		print 'Model not recognised';
	}

	if ($brand_range) {
		print '<h1>'.$brand_range['brand'].' - '.$brand_range['range'].'</h1>';
    $finance_string = ($finance == 'personal')? '<h2>Personal Finance Deals</h2>' : '<h2>Business Finance Deals</h2>';
    $finance_column_header = ($finance == 'personal')? 'Monthly finance rental price including VAT' : 'Monthly finance rental price excluding VAT';
    print $finance_string;

		$derivs_full = array();
		$derivs = derivs_by_range_name($brand_range['range']);
		while ($deriv = mssql_fetch_assoc($derivs)) {
			$rate = mysql_fetch_assoc(deriv_finance($deriv['CAPID']));
			$derivs_full[] = array_merge($deriv, $rate);
		}

		if ($derivs) {
			?>
			<p>These <?php $brand_range['brand'].' '.$brand_range['range']; ?> deals are based on a 3+35 months profile with 10k miles per annum.</p>
			
			<table class="product-derivs">
				<thead>
					<th width="60%" class="deriv-name">Vehicle Derivative</th>
					<th width="8%" class="deriv-co2"><abbr title="Carbon dioxide emmissions as g/km">CO2</abbr></th>
					<th width="10%" class="deriv-p11d"><abbr title="Tax benefit value">P11D</abbr></th>
					<th width="12%" class="deriv-finance"><abbr title="<?php print $finance_column_header; ?>">Finance Rental</abbr></th>
					<th width="10%" class="deriv-more">&nbsp;</th>
				</thead>
				<?php foreach($derivs_full as $deriv) {?>
					<tr>
						<td class="deriv-name"><a href="<?php print vehicle_url($brand_range, $deriv); ?>"><?php print $deriv['ModelDesc']; ?> <?php print $deriv['DerivDescription']; ?></a></td>
						<td class="deriv-co2 subtle"><?php print $deriv['CO2']; ?></td>
						<td class="deriv-p11d subtle">&pound;<?php print number_format($deriv['P11D'], 2, '.', ''); ?></td>
						<td class="deriv-finance"><strong>&pound;<?php print cap_format_price($deriv['FinanceRental'], $finance); ?></strong></td>
						<td class="deriv-more"><a class="vehicle-more" href="<?php print vehicle_url($brand_range, $deriv, $finance); ?>">More Info</a></td>
					</tr>
					<?php } ?>
				</table>
				<?php
				
				if ($finance == 'personal') {
					print '<p>Personal finance deals are inclusive of VAT at '.VAT_AMOUNT.'%.</p>';
				}
		}
		else {
			print 'No vehicles found';
		}
	
	}
	else {
		print 'Vehicle type not recognised';
	}

}
else {
	print 'Sorry, there is a problem with your search. Please go back to the home page and try again.';
}