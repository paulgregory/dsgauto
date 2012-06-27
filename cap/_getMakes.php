<?php

include('mssqlConnect.php');

$SQL = "SELECT * FROM vieCAPMan ORDER BY ManName ASC";
$result = mssql_query($SQL)
    or die('An error occurred: ' . mysql_error());

mssql_close($con);
 
$return = array();
if (mssql_num_rows($result)) {
	while ($row = mssql_fetch_assoc($result)) {
		$return[] = array('ManCode' => $row['ManCode'], 'ManName' => $row['ManName']);
	}
}
?>

<select id="vehicleSearchMakes" onChange="getModels($(this).val())">
	<option value="0">-- All Makes --</option>
	<?php foreach($return as $m) { ?>
	<option value="<?php print $m['ManCode']; ?>"><?php print $m['ManName']; ?></option>	
	<?php } ?>
</select>