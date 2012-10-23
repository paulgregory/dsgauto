<script type="text/javascript" src="/javascript/AjaxCap.js"></script>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<form id="search" name="vehicleSearch" method="post" action="index.php">
	<?php if (!empty($form_error)):?>
		<div class="form-error"><?php print $form_error; ?></div>
	<?php endif; ?>
	
  <input type="hidden" name="stype" value="vehiclesearch" />

  <span class="search-label">INSTANT QUOTE:</span>

  <span class="financeType">
  <input type="radio" name="financeType" value="business" id="financeTypeFinance" <?php if((isset($_SESSION['search_finance_type']) && $_SESSION['search_finance_type'] == 'business') || !isset($_SESSION['search_finance_type'])) echo "checked";?>> <label for="financeTypeFinance">Business</label>
  <input type="radio" name="financeType" value="personal" id="financeTypePersonal" <?php if(isset($_SESSION['search_finance_type']) && $_SESSION['search_finance_type'] == 'personal') echo "checked";?>> <label for="financeTypePersonal">Personal</label> 
  </span>

  <span class="vehicleType">
	<select name="vehicleType" id="vehicleType" onchange="getBrandList(this.value);">
		<option value="0">Vehicle Type</option>
		<option value="car" <?php if(isset($_SESSION['search_vehicle_type']) && $_SESSION['search_vehicle_type'] == 'car') echo "selected=\"selected\"";?>>CARS</option>
		<option value="van" <?php if(isset($_SESSION['search_vehicle_type']) && $_SESSION['search_vehicle_type'] == 'van') echo "selected=\"selected\"";?>>VANS</option>
	</select>
	</span>

	<select name="brand" id="brandSelection" class="vehicleLine" onchange="getModelList(this.value);" <?php if(empty($_SESSION['search_vehicle_type'])) echo "disabled=\"disabled\"";?>>
		<?php 
			$strBrandList = "<option value=\"0\" selected=\"selected\">Make</option>";
			$qryBrand = "";
			if(isset($_SESSION['search_vehicle_type']))
			switch($_SESSION['search_vehicle_type'])
			{
				case 'car':
					$qryBrand = mysql_query($sqlCapCarBrand,$dbConnect);
				break;
				case 'van':
					$qryBrand = mysql_query($sqlCapVanBrand,$dbConnect);
				break;
				default:;
			}
			while ($rstBrand = mysql_fetch_array($qryBrand))
			{
				$strBrandID = dsg_encode($rstBrand["brand"]);
				$strBrandName = $rstBrand["brand"];
				
				if(isset($_SESSION['search_brand']) && $_SESSION['search_brand'] == $strBrandID)
					$strBrandList .= "<option value=\"$strBrandID\" selected=\"selected\">$strBrandName</option>";
				else
					$strBrandList .= "<option value=\"$strBrandID\">$strBrandName</option>";
			}
			echo $strBrandList;
		?>
		
	</select>

	<select name="modelSelection" id="modelSelection" class="vehicleLine" <?php if(empty($_SESSION['search_brand'])) echo "disabled=\"disabled\"";?>>
		<?php
			$strModels = "<option value=\"0\" selected=\"selected\">Model</option>";
			if(isset($_SESSION['search_brand']))
			{	
				$qryModels = "";
				switch($_SESSION['search_vehicle_type'])
				{
					case 'car':
						$qryModels = mysql_query(getCapModels($_SESSION['search_brand'], 1, true),$dbConnect);
						break;
					case 'van':
						$qryModels = mysql_query(getCapModels($_SESSION['search_brand'], 1, false),$dbConnect);
						break;
					default:$qryModels = mysql_query(getCapModels($_SESSION['search_brand'], 1, true),$dbConnect); 
				}

				if($qryModels)
				while ($rstModels = mysql_fetch_array($qryModels))
				{
					$strModelID = dsg_encode($rstModels['model']);
					$strModel = $rstModels['model'];
					
					if(isset($_SESSION['search_model']) && $_SESSION['search_model'] == $strModelID)
						$strModels .= "<option value=\"$strModelID\" selected=\"selected\">$strModel</option>";
					else
						$strModels .= "<option value=\"$strModelID\">$strModel</option>";
				}
			}
			echo $strModels;
		?>
	</select>
  <input id="submit_button" name="submit" type="submit" value="GO!" class="submit" />
</form> 