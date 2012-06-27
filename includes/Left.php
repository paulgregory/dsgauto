<script type="text/javascript" src="javascript/Ajax.js"></script>
<?php
$query = "";
$cv = 'c';
switch($vtype)
{
	case 'cars':
		$query = $sqlCarBrand;
		$cv = 'c';
	break;
	case 'vans':
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
<div id="VehicleType" <?php if($vtype == 'vans') echo "class=\"vansCars\""; else echo  "class=\"carsVans\""; ?>>
	<h4><a href="#" name="Cars" class="cars" onclick="getBrandList('cars', updateLeftBrandsList); return false;">Cars</a></h4>
	<h4><a href="#" name="Vans" class="vans" onclick="getBrandList('vans', updateLeftBrandsList); return false;">Vans</a></h4>
</div>
<ul id="BrandList">
<?php echo $strLeftBrands; ?>
</ul>
</div>