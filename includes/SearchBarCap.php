
<script type="text/javascript" src="javascript/AjaxCap.js"></script>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<form id="search" name="vehicleSearch" method="post" action="index.php">
	<?php if (!empty($form_error)):?>
		<div class="form-error"><?php print $form_error; ?></div>
	<?php endif; ?>
	
  <input type="hidden" name="stype" value="vehiclesearch" />

  <span class="search-label">SEARCH:</span>

  <span class="financeType">
  <input type="radio" name="financeType" value="business" id="financeTypeFinance" checked> <label for="financeTypeFinance">Business</label>
  <input type="radio" name="financeType" value="personal" id="financeTypePersonal"> <label for="financeTypePersonal">Personal</label> 
  </span>

  <span class="vehicleType">
	<select name="vehicleType" id="vehicleType" onchange="getBrandList(this.value);">
		<option value="0">Vehicle Type</option>
		<option value="cars">Cars</option>
		<option value="vans">Vans</option>
	</select>
	</span>

	<select name="brand" id="brandSelection" class="vehicleLine" onchange="getModelList(this.value);" disabled>
		<option value="0" selected="selected">Make</option>
	</select>

	<select name="modelSelection" id="modelSelection" class="vehicleLine" disabled>
		<option value="0" selected="selected">Model</option>
	</select>
  <input id="submit_button" name="submit" type="submit" value="GO!" class="submit" />
</form> 