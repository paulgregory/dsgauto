<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
?>

<h1>Manage Car Data</h1>
<div id="administrationTop"></div>
<div id="administration">

<?php
		if(isset($_GET['type']))
		{
			$type = $_GET['type'];
			$strType = "";
			switch($type)
			{
				case 'brands':
					if(isset($_POST['disableBrands']))
					{
						$enabledBrands = $_POST['enabledBrands'];
						if($enabledBrands)
						foreach($enabledBrands as $brandID)
						{
							$qryBrand = mysql_query(updateBrands($brandID, 0, true),$dbConnect);
						}
					}
					if(isset($_POST['enableBrands']))
					{
						$disabledBrands = $_POST['disabledBrands'];
						if($disabledBrands)
						foreach($disabledBrands as $brandID)
						{
							$qryBrand = mysql_query(updateBrands($brandID, 1, true),$dbConnect);
						}
					}
					$strEnabledBrands = "";
					$strDisabledBrands = "";
					$qryBrand = mysql_query($sqlEnabledBrand,$dbConnect);
					while ($rstBrand = mysql_fetch_array($qryBrand))
					{
						$strBrandID= $rstBrand['id'];
						$strBrandName = $rstBrand['brand'];
						if($strBrandName != "BMW") {
							$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"])));
						}
						if($rstBrand['enabled'] == '1'){
							$strEnabledBrands .= "<option value=\"$strBrandID\">$strBrandName</option>";
						}
						else {
							$strDisabledBrands .= "<option value=\"$strBrandID\">$strBrandName</option>";
						}
					}
					$strType .= "
						<form action=\"\" method=\"post\" >
							<label>Enabled Brands</label>
							<select name=\"enabledBrands[]\" id=\"enabledBrands\" size=\"20\" multiple=\"multiple\">$strEnabledBrands</select>
							<input type=\"submit\" name=\"disableBrands\" id=\"disableBrands\" value=\" &gt;&gt; \"/>
							<input type=\"submit\" name=\"enableBrands\" id=\"enableBrands\" value=\" &lt;&lt; \"/>
							<label>Disabled Brands</label>
							<select name=\"disabledBrands[]\" id=\"disabledBrands\" size=\"20\" multiple=\"multiple\">$strDisabledBrands</select>
						</form>";
					break;
				case 'models':
					if(isset($_POST['disableModels']))
					{
						$enabledModels = $_POST['enabledModels'];
						if($enabledModels)
						foreach($enabledModels as $modelID)
						{
							$qryBrand = mysql_query(updateModels($modelID, 0, true),$dbConnect);
						}
					}
					if(isset($_POST['enableModels']))
					{
						$disabledModels = $_POST['disabledModels'];
						if($disabledModels)
						foreach($disabledModels as $modelID)
						{
							$qryBrand = mysql_query(updateModels($modelID, 1, true),$dbConnect);
						}
					}
					$strBrands = "";
					$qryBrand = mysql_query($sqlCarBrand,$dbConnect);
					while ($rstBrand = mysql_fetch_array($qryBrand))
					{
						$strBrandID = $rstBrand['id'];
						$strBrandName = $rstBrand['brand'];
						if($strBrandName != "BMW") {
							$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"])));
						}
						$strBrands .= "<option value=\"$strBrandID\">$strBrandName</option>";
					}
					$strType = "
					<script type=\"text/javascript\" src=\"/includes/admin/javascript/admin.js\"></script>
					<form action=\"\" method=\"post\" >
						<label>Brands</label>
							<select name=\"Brands\" id=\"Brands\" onchange=\"callServer();\">$strBrands</select>
						<label>Enabled Models</label>
							<select name=\"enabledModels[]\" id=\"enabledModels\" multiple=\"multiple\" size=\"10\"></select>
						<input type=\"submit\" name=\"disableModels\" id=\"disableModels\" value=\" &gt;&gt; \"/>
						<input type=\"submit\" name=\"enableModels\" id=\"enableModels\" value=\" &lt;&lt; \"/>
						<label>Disabled Models</label>
							<select name=\"disabledModels[]\" id=\"disabledModels\" multiple=\"multiple\" size=\"10\"></select>
					</form>";
					break;
				case 'derivs':
					$strType = "";
					break;
				default:;
			}
			echo $strType;
?>
			
<?php
		}
		else
		{
?>
<ul>
<li><a href="/administration-cardata-brands.html">Enabled Car Brands</a></li>
<li style="margin-bottom: 15px"><a href="/administration-cardata-models.html">Enabled Car Models</a></li>
<li><a href="/administration-vandata-brands.html">Enabled Van Brands</a></li>
<li><a href="/administration-vandata-models.html">Enabled Van Models</a></li>
</ul>
<?php } ?>

<p><strong><a href="/administration.html">Return to admin menu</a></strong></p>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>