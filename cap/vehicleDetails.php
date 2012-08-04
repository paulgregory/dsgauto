<?php

function array_equipment_by_category($qryEquipment) {
	$items = array();
  while ($item = mssql_fetch_assoc($qryEquipment)) {
	  $items[$item['CatCode']][] = $item;
  }

  return $items;
}

function print_equipment_group($items, $title) {
	if (count($items)) {
		print '<div class="equipment-group">';
		print '<h3>'.$title.'</h3>';
		print '<ul>';
		foreach ($items as $item) {
			print '<li>'.$item['LongDesc'].'</li>';
		}
		print '</ul></div>';
	}
}


if ($_GET['capid']) {

  $capid = intval($_GET['capid']);
  $finance = ($_GET['financeType'] == 'personal')? 'personal' : 'business'; // a form of query sanitisation

  // Use the CAPID to get the vehicle details
	require_once('capQueries.php');
	$qryVehicle = vehicle_by_capid($capid);
	$qryFinance = deriv_finance($capid);

  $vehicle = mssql_fetch_assoc($qryVehicle);
  $financeDetails = mysql_fetch_assoc($qryFinance);
/*
   print '<pre>';
	  print_r($vehicle);
	  print '</pre>';
	
	 $finance = mysql_fetch_assoc($qryFinance);
	 	print '<pre>';
	  print_r($finance);
	  print '</pre>';
*/
  
  if ($qryVehicle) {

?>

<?php 
if ($vehicle['ImageID']) {
	$img = $_SERVER['DOCUMENT_ROOT'].'/cap/images/'.$vehicle['ImageID'].'.jpg';
  if (file_exists($img)) {
	  print '<div class="vehicle-image"><img src="/cap/images/'.$vehicle['ImageID'].'.jpg" /></div>';
  }	
} ?>

<h1><?php print $vehicle['ManName']; ?><br /><?php print $vehicle['ModelDesc']; ?><br /><?php print $vehicle['DerivDescription']; ?></h1>

<?php if ($qryFinance): ?>
<h3>CO2: <?php print $financeDetails['CO2']; ?> g/km</h3>
<h3>P11D: &pound;<?php print number_format($financeDetails['P11D'], 2, '.', ''); ?></h3>
<h2>Finance rental: &pound;<?php print cap_format_price($financeDetails['FinanceRental'], $finance); ?></h2>	
<p>Monthly finance rental based on a 3+35 months profile, 10k per annum. <?php if ($finance == 'personal'): ?>Personal finance deals include VAT at <?php print VAT_AMOUNT; ?>%. <?php endif; ?></p>
<?php else: ?>
<p>Sorry, finance rental details could not be found.</p>
<?php endif; ?>

<h2>Options</h2>
<?php
$qryOptions = vehicle_options($capid);
while ($option = mssql_fetch_assoc($qryOptions)) {
	print '<div>'.$option['CategoryDesc'].' -- '.$option['LongDesc'].'<div>';
}
?>

<h2>Standard Equipment</h2>

<?php
$qryEquipment = vehicle_standard_equipment($capid);
if ($qryEquipment) {
	$items = array_equipment_by_category($qryEquipment);
	
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
	
}
?>
	
	
	
<?php	
	}
	else {
		print 'Vehicle not available. Please select a different derivative.';
	}
	
}
else {
	print 'Vehicle ID missing! Try searching again.';
}