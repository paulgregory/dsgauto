<?php
	if(isset($_GET['did']))
	{
		$did = $_GET['did'];
		$qryDID = mysql_query(getVehicleType($did), $dbConnect);
		$rstDID = mysql_fetch_array($qryDID);
		
		$vehicleType = $rstDID['vehicleType'];
		$Car;
		if($vehicleType == '1'){
			$Car = true;
			$vehicleType = 'c';
		}
		else {
			$Car = false;
			$vehicleType = 'v';
		}		
		$qryGetAQuote = mysql_query(sqlDealGet($did, $Car, 1), $dbConnect);
		$rstGetAQuote = mysql_fetch_array($qryGetAQuote);
		$brandID = $rstGetAQuote['brandID'];
		$modelID = $rstGetAQuote['modelID'];
		$derivID = $rstGetAQuote['derivID'];
		$bop = $rstGetAQuote['financeType'];
		$financeType = $rstGetAQuote['financeType'];
	}
	if(isset($_GET['brand']))
	{
		$get = $_GET['brand'];
		$vehicleType = substr($get, 0, 1);
		$brandID = substr($get, 1);
	}
?>
<script type="text/javascript" src="javascript/Ajax.js"></script>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<form id="search" method="post" action="">

<label>SEARCH:</label>

  <select id="vehicleTypeID" name="vehicleType" class="vehicleLine"  onchange="getBrandList(this.value, updateBrandSelection);">
					<option value= "">Please Select</option>
					<option value="car" <?php if(isset($vehicleType) && $vehicleType == 'c') echo "selected=\"selected\"";?>>Car</option>
					<option value="van" <?php if(isset($vehicleType) && $vehicleType == 'v') echo "selected=\"selected\"";?>>Van</option>
				</select>
  
				<select name="brandSelection" id="brandSelection" class="vehicleLine" onchange="getModelList(this.value, updateModelSelection);" >
				<?php 
					$strBrandList = "<option value=\"0\" selected=\"selected\">Please Select</option>";
					$qryBrand = "";
					if(isset($vehicleType))
					switch($vehicleType)
					{
						case 'c':
							$qryBrand = mysql_query($sqlCarBrand,$dbConnect);
						break;
						case 'v':
							$qryBrand = mysql_query($sqlVanBrand,$dbConnect);
						break;
						default:;
					}
					while ($rstBrand = mysql_fetch_array($qryBrand))
					{
						$strBrandID = $rstBrand["id"];
						$strBrandName = $rstBrand["brand"];
						if($strBrandName != "BMW")
							$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
						
						if(isset($brandID) && $brandID == $strBrandID)
							$strBrandList .= "<option value=\"$strBrandID\" selected=\"selected\">$strBrandName</option>";
						else
							$strBrandList .= "<option value=\"$strBrandID\">$strBrandName</option>";
					}
					echo $strBrandList;
				?>
				</select>

				<select name="modelSelection" id="modelSelection" class="vehicleLine" onchange="getDerivList(this.value, updateDerivSelection);">
				<?php
					$strModels = "<option value=\"0\" selected=\"selected\">Please Select</option>";
					if(isset($brandID))
					{	
						$qryModels = "";
						switch($vehicleType)
						{
							case 'c':
								$qryModels = mysql_query(getEnabledModels($brandID, 1, true),$dbConnect);
								break;
							case 'v':
								$qryModels = mysql_query(getEnabledModels($brandID, 1, false),$dbConnect);
								break;
							default:$qryModels = mysql_query(getEnabledModels($brandID, 1, true),$dbConnect); 
						}
						if($qryModels)
						while ($rstBrand = mysql_fetch_array($qryModels))
						{
							$strModelID = $rstBrand['id'];
							$strModel = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand['model']))); 
							
							if(isset($modelID) && $modelID == $strModelID)
								$strModels .= "<option value=\"$strModelID\" selected=\"selected\">$strModel</option>";
							else
								$strModels .= "<option value=\"$strModelID\">$strModel</option>";
						}
					}
					echo $strModels;
				?>
				</select>
				<select name="derivSelection" id="derivSelection" class="vehicleLine" <?php if(!isset($did)) echo "disabled=\"disabled\"";?> onchange="required(this, 'combobox');"><option value="0">Please Select</option>
				<?php
					if(isset($modelID))
					{
						$strDerivs = "<option value=\"0\" selected=\"selected\">Please Select</option>";
						$qryModels = "";
						switch($vehicleType)
						{
							case 'c':
								$qryModels = mysql_query(getEnabledDerivs($modelID, 1, true),$dbConnect);
								break;
							case 'v':
								$qryModels = mysql_query(getEnabledDerivs($modelID, 1, false),$dbConnect);
								break;
							default:$qryModels = mysql_query(getEnabledDerivs($modelID, 1, true),$dbConnect); 
						}
						if($qryModels)
						while ($rstBrand = mysql_fetch_array($qryModels))
						{
							$strDerivID = $rstBrand['id'];
							$strDeriv = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand['derivative']))); 
							
							if(isset($derivID) && $derivID == $strDerivID)
								$strDerivs .= "<option value=\"$strDerivID\" selected=\"selected\">$strDeriv</option>";
							else
								$strDerivs .= "<option value=\"$strDerivID\">$strDeriv</option>";
						}
						echo $strDerivs;
					}
					?>
				</select><span class="required" id="derivSelectionReq"><?php if(!isset($did)) echo "*";?></span>



	<!-- <select name="modelSelection" id="modelSelection" class="vehicleLine" onChange="getDerivList(this.value, updateDerivSelection);">
	<option value="0" selected="selected">Model</option>
    <option value="4">159</option>
    <option value="75">Brera</option>
    <option value="179">Gt</option>
    <option value="235">Mito</option>
    <option value="311">Spider</option>
    <option value="377">Giulietta</option>				
    </select>

<select name="derivSelection" id="derivSelection" class="vehicleLine" disabled="disabled" onChange="required(this, 'combobox');"><option value="0">Please Select</option>
								</select>
								-->
<input id="submit_button" name="submit" type="submit" value="GO!" class="submit" />
</form> 