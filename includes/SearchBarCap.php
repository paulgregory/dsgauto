
<script type="text/javascript" src="javascript/AjaxCap.js"></script>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<form id="search" name="vehicleSearch" method="post" action="index.php">
  <input type="hidden" name="stype" value="vehiclesearch" />

  <span class="search-label">SEARCH:</span>

  <input type="radio" name="vehicleType" value="cars" id="vehicleTypeCars" onchange="getBrandList(this.value);" <?php if(isset($vehicleType) && $vehicleType == 'c') echo "checked";?>> <label for="vehicleTypeCars">Cars</label> 
  <input type="radio" name="vehicleType" value="vans" id="vehicleTypeVans" onchange="getBrandList(this.value);" <?php if(isset($vehicleType) && $vehicleType == 'v') echo "checked";?>> <label for="vehicleTypeVans">Vans</label>
 
	<select name="brand" id="brandSelection" class="vehicleLine" onchange="getModelList(this.value);" disabled>
		<option value="0" selected="selected">Makes</option>
	</select>

	<select name="modelSelection" id="modelSelection" class="vehicleLine" disabled>
		<option value="0" selected="selected">Models</option>
	</select>
  <input id="submit_button" name="submit" type="submit" value="GO!" class="submit" />
</form> 