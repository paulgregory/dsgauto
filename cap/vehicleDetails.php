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

  // Use the CAPID to get the vehicle details
	require_once('capQueries.php');
	$qryVehicle = vehicle_by_capid($capid);

  if ($qryVehicle) {
	
    $vehicle = mssql_fetch_assoc($qryVehicle);
    //print '<pre>';
	  //print_r($vehicle);
	  //print '</pre>';
?>

<h1><?php print $vehicle['ManName']; ?><br /><?php print $vehicle['ModelDesc']; ?><br /><?php print $vehicle['DerivDescription']; ?></h1>
	
<h2>Basic Price: &pound;<?php print $vehicle['BasicPrice']; ?></h2>	

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