<?php

// Build a readable URL for the vehicle detail page
function vehicle_url($br, $deriv) {
	$url = 'vehicle_details-'.$br['brand'].'-'.$br['range'].'-'.$deriv['CAPID'].'.html';
	$url = str_replace(' ', '_', $url);
	return $url;
}


require_once('includes/constants.php');
require_once('includes/dbConnect.php');

if (isset($_GET['vehicleType']) && $_GET['modelSelection']) {

	$vtype = $_GET['vehicleType'];
	$model = intval($_GET['modelSelection']);

	if ($vtype == 'cars') {
		// Take the internal model number and get the CAP range and brand names
		$sql = "SELECT model as 'range', brand FROM tblcarmodels as m, tblcarbrands as b WHERE b.id = m.brandID AND m.id = $model LIMIT 1";
		$qryRange = mysql_query($sql);
		if (mysql_num_rows($qryRange)) {
			$brand_range = mysql_fetch_assoc($qryRange, 0);
		} else {
			print 'Model not recognised';
		}

		if ($brand_range) {
			print '<h1>'.$brand_range['brand'].' - '.$brand_range['range'].'</h1>';

			$range = $brand_range['range'];

			// Use the RangeName to get the derivatives
			// This probably isn't the safest/best way but at this point we don't have the RangeCode
			require_once('capQueries.php');
			$derivs = derivs_by_range_name($range);

			if ($derivs) {
				?>
				<table>
					<tr>
						<th>Vehicle</th>
						<th>OTR Price</th>
						<th>Monthly PCP</th>
					</tr>
					<?php while($deriv = mssql_fetch_assoc($derivs)) {?>
						<tr>
							<td><a href="<?php print vehicle_url($brand_range, $deriv); ?>"><?php print $deriv['ModelDesc']; ?> <?php print $deriv['DerivDescription']; ?></a></td>
							<td>&pound;<?php print $deriv['BasicPrice']; ?></td>
							<td>&nbsp;</td>
						</tr>
						<?php } ?>
					</table>
					<?php
			}
			else {
				print 'No vehicles found!';
			}


		}

	}
	elseif ($vtype == 'vans') {
		print 'The CAP database doesn\'t contain VAN data!';
	}
	else {
		print 'Vehicle type not recognised';
	}

}
else {
	print 'Sorry, there is a problem with your search. Please go back to the home page and try again.';
}