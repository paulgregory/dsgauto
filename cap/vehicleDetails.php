<script type="text/javascript" src="/js/libs/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/js/libs/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#vehicle-tabs').tabs();
});
</script>

<?php

function array_equipment_by_category($qryEquipment) {
	$items = array();
  while ($item = mssql_fetch_assoc($qryEquipment)) {
	  $items[$item['CatCode']][] = $item;
  }

  return $items;
}

function array_options_by_category($qryOptions) {
	$items = array();
  while ($item = mssql_fetch_assoc($qryOptions)) {
	  $items[$item['CategoryDesc']][] = $item;
  }

  return $items;
}

function print_equipment_group($items, $title) {
	if (count($items)) {
		print '<div class="group">';
		print '<h3>'.$title.'</h3>';
		print '<ul>';
		foreach ($items as $item) {
			print '<li>'.$item['LongDesc'].'</li>';
		}
		print '</ul></div>';
	}
}

function print_otpion_group($items, $title) {
	if (count($items)) {
		print '<div class="group">';
		print '<h3>'.$title.'</h3>';
		print '<ul>';
		foreach ($items as $item) {
			print '<li><input type="checkbox" name="vehicleOptions['.$item['OptionCode'].']" id="option-'.$item['OptionCode'].'" value="'.$title.' &rsaquo; '.$item['LongDesc'].'" /> <label for="option-'.$item['OptionCode'].'">'.$item['LongDesc'].'</label></li>';
		}
		print '</ul></div>';
	}
}

require_once('includes/constants.php');
require_once('includes/sql.php');
require_once('includes/dbConnect.php');
require_once('capConfig.php');
require_once('mssqlConnect.php');

if ($_GET['capid'] && $_GET['vehicleType']) {

  $capid = intval($_GET['capid']);
  $finance = ($_GET['financeType'] == 'personal')? 'personal' : 'business'; // a form of query sanitisation
  $vtype = ($_GET['vehicleType'] == 'car')? 'car' : 'van'; // a form of query sanitisation

  $qryVehicle = mysql_query(vehicleInfoAndFinance($capid, $vtype));
	
	if ($vehicle = mysql_fetch_assoc($qryVehicle)) { ?>
			
			<?php 
			$with_img = FALSE;
			$qryVehicleImage = mssql_query(capVehicleImage($capid));
			
			if ($qryVehicleImage) {
			  $imgResult = mssql_fetch_assoc($qryVehicleImage);
				$img = $_SERVER['DOCUMENT_ROOT'].'/cap/images/'.$imgResult['ImageID'].'.jpg';
			  if (file_exists($img)) {
				  $with_img = TRUE;
				  print '<div id="vehicle-image"><img src="/cap/images/'.$imgResult['ImageID'].'.jpg" /></div>';
			  }	
			} ?>

			<h1 id="vehicle-title" <?php if ($with_img) { print 'class="with-image"'; } ?>><span class="make-model"><?php print $vehicle['Manufacturer']; ?> <?php print $vehicle['ModelLong']; ?><span><br /><span class="deriv-name"><?php print $vehicle['DerivativeLong']; ?></span></h1>
			
			<table class="finance-details">
				<tr class="co2">
					<td class="label">CO<sub>2</sub> Emissions:</td>
					<td class="value"><?php print $vehicle['CO2']; ?> g/km</td>
				</tr>
				<tr class="p11d">
					<td class="label">P11D Value:</td>
					<td class="value">&pound;<?php print number_format($vehicle['P11D'], 2, '.', ''); ?></td>
				</tr>
				<tr class="finance-rental">
					<td class="label">Finance Rental:</td>
					<td class="value">&pound;<?php print cap_format_price($vehicle['FinanceRental'], $finance); ?> pm</td>
				</tr>
        <tr class="finance-notice">
	        <td colspan="2">Finance based on a 3+35 months profile with 10k miles per annum.<br /><?php if ($finance == 'personal') { print 'Personal finance rental includes VAT at '.VAT_AMOUNT.'%.'; } ?></td>
	      </tr>
			</table>

      <form action="/car_leasing-business-get_quote.html" method="post" style="clear: both">
	
	    <input type="hidden" name="vehicleType" value="<?php print $vtype; ?>">
	    <input type="hidden" name="vehicleBrand" value="<?php print $vehicle['Manufacturer']; ?>">
	    <input type="hidden" name="vehicleModel" value="<?php print $vehicle['ModelShort']; ?>">
	    <input type="hidden" name="vehicleCAPID" value="<?php print $capid; ?>">
	    <input type="hidden" name="vehicleFinance" value="<?php print $finance; ?>">

      <div id="quote-buttons">
	      <input type="submit" value="Get quote" />
	    </div>

      <div id="vehicle-tabs">
	      <ul id="tabs" class="clearfix">
		      <li><a href="#vehicle-standard-equipment">Standard Equipment</a></li>
		      <li><a href="#vehicle-options">Select Vehicle Options</a></li>
		    </ul>
			
				<div id="vehicle-standard-equipment">
					<?php
					$qryEquipment = mssql_query(capVehicleStandardEquipment($capid));
					if (mssql_num_rows($qryEquipment)) {
						$items = array_equipment_by_category($qryEquipment);
						
						print '<div class="css-columns">';

						@print_equipment_group($items[58], 'Exterior Body Features');
						@print_equipment_group($items[61], 'Interior Features');
						@print_equipment_group($items[77], 'Safety');
						@print_equipment_group($items[62], 'Windows');
						@print_equipment_group($items[63], 'Brakes');
						@print_equipment_group($items[67], 'Driver Aids');
						@print_equipment_group($items[49], 'Seats');
						@print_equipment_group($items[48], 'Security');
						@print_equipment_group($items[80], 'Carpets/Rugs');
						@print_equipment_group($items[48], 'Security');
						
						print '</div>';
					}
					else {
						print '<p><em>No standard equipment available for this vehicle</em></p>';
					}
					?>
        </div>

	      <div id="vehicle-options">
			
				<?php
				$qryOptions = mssql_query(capVehicleOptions($capid));
				if (mssql_num_rows($qryOptions)) {
					$items = array_options_by_category($qryOptions);
					
					print '<p><em>Tick the options you would like to add to your quote.</em></p><div class="css-columns">';
					
					foreach ($items as $cat_name => $group) {
						print_otpion_group($group, $cat_name);
					}

					print '</div>';
				}
				else {
					print '<p><em>No options available for this vehicle</em></p>';
				}
				?>
				</div>

      </div>

      </form>

		<?php
	}
	else {
		print '<p><strong>Sorry, couldn\'t find vehicle information. <a href="/">Search again</a></strong></p>';
	}
	
}
else {
	print '<p><strong>Vehicle ID missing! Try searching again. <a href="/">Search again</a></strong></p>';
}