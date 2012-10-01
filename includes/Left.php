<script type="text/javascript" src="javascript/Ajax.js"></script>
<?php
$query = "";
$cv = 'c';
switch($vtype)
{
	case 'car':
		$query = $sqlCarBrand;
		$cv = 'c';
	break;
	case 'van':
		$query = $sqlVanBrand;
		$cv = 'v';
	break;
	default: $query = $sqlCarBrand;
} 
$strLeftBrands = "";
$qryBrand = mysql_query($query,$dbConnect);
while ($rstBrand = mysql_fetch_array($qryBrand))
{
	$strBrandName = $rstBrand["brand"];
	$strBrandID = $rstBrand["id"];
	if($strBrandName != "BMW")
		$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
	$strBrandURL = preg_replace("/(.+)([-|' '])(.+)/e","ucfirst('$1').'_'.ucfirst('$3')",ucwords(strtolower($rstBrand["brand"])));
	$strLeftBrands .= "<li><h4><a class=\"brand\" href=\"/car_leasing-business-get_quote-$strBrandURL-$cv$strBrandID.html\" title=\"$strBrandName - Get a quote\">$strBrandName</a></h4></li>";
}
?>
<div class="leftTop">
<h3>Get A Quote</h3>
</div>
<div id="Left">
<div id="VehicleType" <?php if($vtype == 'van') echo "class=\"vansCars\""; else echo  "class=\"carsVans\""; ?>>
	<h4><a href="#" name="Cars" class="car" onclick="getBrandList('car', updateLeftBrandsList); return false;">Cars</a></h4>
	<h4><a href="#" name="Vans" class="van" onclick="getBrandList('van', updateLeftBrandsList); return false;">Vans</a></h4>
</div>
<ul id="BrandList">
<?php echo $strLeftBrands; ?>
</ul>
</div>