<?php

  // Check if the POST contains vehicle details
  if (isset($_POST['vehicleCAPID']) && is_numeric($_POST['vehicleCAPID'])) {
	  $capid = intval($_POST['vehicleCAPID']);
	  $vehicleType = ($_POST['vehicleType'] == 'car')? 'c' : 'v';
	  $brand = htmlspecialchars($_POST['vehicleBrand']);
	  $model = htmlspecialchars($_POST['vehicleModel']);
	  $options = array();
	  foreach ($_POST['vehicleOptions'] as $optid => $opt) {
		  $options[$optid] = htmlspecialchars($opt);
	  }
  }


	if (isset($_GET['did']))
	{
		$did = intval($_GET['did']);
		$qryVtype = mysql_query(getVehicleType($did), $dbConnect);
		
		if ($qryVtype && mysql_num_rows($qryVtype) == 1) {
			$rstVtype = mysql_fetch_array($qryVtype);
			$vtype = $rstVtype['vehicleType'];
			$vehicleType = ($vtype)? 'c' : 'v';
			
			$qryDeal = mysql_query(sqlCapDealGet($did, $vtype, 1), $dbConnect);
			
			while ($rstDeal = mysql_fetch_assoc($qryDeal)) {
				
        $brand = $rstDeal['brand'];
        $model = $rstDeal['model'];
        $capid = $rstDeal['vehicleID'];
        $financeType = $rstDeal['financeType'];	

			}
		}
	}
	
	if (isset($_GET['brand']) && isset($_GET['vtype'])) {
		$brand = strtoupper(htmlspecialchars($_GET['brand']));
	  $vehicleType = (htmlspecialchars($_GET['vtype']) == 'c')? 'c' : 'v';
	}

?>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<script type="text/javascript" src="/javascript/Ajax.js"></script>
<h1>Get a Quote</h1> 
<p class="smaller">So that we can search all of our finance partners to calculate the very best deal for you please complete your details below.  
You will then be able to select a quote based on one of the following finance agreements;
business contract hire, 
personal contract hire, 
business contract purchase, 
personal contact purchase, 
lease purchase and hire purchase.  
If you are unsure about the type of finance package best suits you then <a href="/car_leasing-business-contact_us.html" title="Contact Us">contact us</a>.</p>

<form id="Form" method="post" action="" class="clearfix">
	<div class="column-1">
	<fieldset>
		<legend>Contact Details</legend>
		<div id="contactDetails">
			<div class="form-item">		
			  <label>Full Name</label>
				<input type="text" name="FullName" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="FullNameReq">*</span>
			</div>
			<div class="form-item">
  			<label>Telephone Number</label>
				<input type="text" name="TelephoneDay" class="contactLine" value="" onblur="required(this, 'telNo');" maxlength="15"/>
				<span class="required" id="TelephoneDayReq">*</span>
			</div>
	    <div class="form-item">
			  <label>Email Address</label>
				<input type="text" name="EmailAddress" class="contactLine" value="" onblur="required(this, 'email');" maxlength="255"/>
				<span class="required" id="EmailAddressReq">*</span>
			</div>
			<div class="form-item">
  			<label>How you found us</label>
				<input type="text" name="HowYouFoundUs" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="HowYouFoundUsReq">*</span>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Vehicle Details</legend>
		<div id="Vehicle">
			<div class="form-item">
			  <label>Vehicle Type</label>
				<select id="vehicleTypeID" name="vehicleType" class="vehicleLine"  onchange="getBrandList(this.value, updateBrandSelection);">
					<option value= "">Please Select</option>
					<option value="cars" <?php if(isset($vehicleType) && $vehicleType == 'c') echo "selected=\"selected\"";?>>Car</option>
					<option value="vans" <?php if(isset($vehicleType) && $vehicleType == 'v') echo "selected=\"selected\"";?>>Van</option>
				</select>
			</div>
			<div class="form-item">
  			<label>Manufacturer</label>
				<select name="brandSelection" id="brandSelection" class="vehicleLine" <?php if(!isset($brand)) echo "disabled=\"disabled\"";?> onchange="getModelList(this.value, updateModelSelection);" >
				<?php 
					$strBrandList = "<option value=\"0\" selected=\"selected\">Please Select</option>";
					$qryBrand = "";
					if(isset($vehicleType))
					switch($vehicleType)
					{
						case 'c':
							$qryBrand = mysql_query($sqlCapCarBrand,$dbConnect);
						break;
						case 'v':
							$qryBrand = mysql_query($sqlCapVanBrand,$dbConnect);
						break;
						default:;
					}
					while ($rstBrand = mysql_fetch_array($qryBrand))
					{
						$strBrandID = str_replace(' ', '+', $rstBrand["brand"]);
						$strBrandName = $rstBrand["brand"];
						
						if(isset($brand) && $brand == $rstBrand["brand"])
							$strBrandList .= "<option value=\"$strBrandID\" selected=\"selected\">$strBrandName</option>";
						else
							$strBrandList .= "<option value=\"$strBrandID\">$strBrandName</option>";
					}
					echo $strBrandList;
				?>
				</select>
			</div>
      <div class="form-item">
			  <label>Model</label>
				<select name="modelSelection" id="modelSelection" class="vehicleLine" <?php if(!isset($model)) echo "disabled=\"disabled\"";?> onchange="getDerivList(this.value, updateDerivSelection);">
				<?php
					$strModels = "<option value=\"0\" selected=\"selected\">Please Select</option>";
					if(isset($brand))
					{	
						$qryModels = "";
						switch($vehicleType)
						{
							case 'c':
								$qryModels = mysql_query(getCapModels($brand, 1, true),$dbConnect);
								break;
							case 'v':
								$qryModels = mysql_query(getCapModels($brand, 1, false),$dbConnect);
								break;
							default:$qryModels = mysql_query(getCapModels($brand, 1, true),$dbConnect); 
						}

						if($qryModels)
						while ($rstModels = mysql_fetch_array($qryModels))
						{
							$strModelID = str_replace(' ', '+', $rstModels['model']);
							$strModel = $rstModels['model'];
							
							if(isset($model) && $model == $rstModels['model'])
								$strModels .= "<option value=\"$strModelID\" selected=\"selected\">$strModel</option>";
							else
								$strModels .= "<option value=\"$strModelID\">$strModel</option>";
						}
					}
					echo $strModels;
				?>
				</select>
			</div>
			<div class="form-item">
  			<label>Derivative</label>
				<select name="derivSelection" id="derivSelection" class="vehicleLine" <?php if(!isset($capid)) echo "disabled=\"disabled\"";?> onchange="required(this, 'combobox');">
					<option value="0">Please Select</option>
				<?php
					if(isset($model))
					{
						$qryDerivs = "";
						switch($vehicleType)
						{
							case 'c':
								$qryDerivs = mysql_query(getCapDerivs($model, 1, true),$dbConnect);
								break;
							case 'v':
								$qryDerivs = mysql_query(getCapDerivs($model, 1, false),$dbConnect);
								break;
							default:$qryDerivs = mysql_query(getCapDerivs($model, 1, true),$dbConnect); 
						}
						if($qryDerivs)
						while ($rstDerivs = mysql_fetch_array($qryDerivs))
						{
							$strDerivID = $rstDerivs['CAPID'];
							$strDeriv = $rstDerivs['derivative'];
							
							if(isset($capid) && $capid == $strDerivID)
								$strDerivs .= "<option value=\"$strDerivID\" selected=\"selected\">$strDeriv</option>";
							else
								$strDerivs .= "<option value=\"$strDerivID\">$strDeriv</option>";
						}
						echo $strDerivs;
					}
					?>
				</select><span class="required" id="derivSelectionReq"><?php if(!isset($did)) echo "*";?></span>
			</div>
			<div class="form-item">
			  <label>Options</label>
				<textarea name="vehicleOptions" class="vehicleOptions" rows="7" cols="25"><?php 
					if (count($options)) {
						foreach ($options as $optid => $opt) {
							print $opt."\n".'----------------------------'."\n";
						}
					} ?></textarea>
			</div>
		</div>
	</fieldset>
	</div>
	
	<div class="column-2">
	<fieldset>
		<legend>Finance Details</legend>
		<div id="Finance">
			<div class="form-item">
  			<label>Finance Type</label>
				<select class="basis" name="FinanceType" <?php if(!isset($did)) echo "onchange=\"required(this, 'combobox');\"";?>>
					<option value="">Please Select</option>
					<option <?php if(isset($financeType) && $financeType == 1) echo "selected=\"selected\"";?> value="hire">Contract Hire</option>
					<option <?php if(isset($financeType) && $financeType == 0) echo "selected=\"selected\"";?> value="lease">Finance Lease</option>
					<?php
						if(!isset($did)) { ?>
					<option value="businessContractHire">Business Contract Hire</option>
					<option value="personalContractHire">Personal Contract Hire</option>
					<option value="businessContractPurchase">Business Contract Purchase</option>
					<option value="personalContactPurchase">Personal Contact Purchase</option>
					<option value="leasePurchase">Lease Purchase</option>
					<option value="hirePurchase">Hire Purchase</option> 
					<?php }?>
				</select>
				<?php if(!isset($did)) echo "<span class=\"required\" id=\"FinanceTypeReq\">*</span>";?>
			</div>
			<div class="form-item">
				<label>Term</label>
				<select class="basis" name="Term" onchange="required(this, 'combobox');">
					<option value="">Please Select</option>
					<option value="24">24</option>
					<option value="36">36</option>
					<option value="48">48</option>
					<option value="60">60</option>
					<?php 
					
					for($x = 25; $x <= 60; $x ++)
					{
						echo "<option value=\"$x\">$x</option>";
					}
					?>
				</select>
				<span class="required" id="TermReq">*</span>
			</div>
			<div class="form-item">
	  		<label>Maintenace Package</label>
				<input type="checkbox" name="financeMaintenance" class="financeCheck" value="on"/>
		  </div>
		  <div class="form-item">
  			<label>Mileage Per Year</label>
				<input type="text" name="MileagePA" class="financeLine" value="" onblur="required(this, 'number')" maxlength="10"/>
				<span class="required" id="MileagePAReq">*</span>
			</div>
			<div class="form-item">
				<label>Monthly Budget (&pound;)</label>
				<input type="text" name="MonthlyBudget" class="financeLine" value="" onblur="required(this, 'number')" maxlength="10"/>
				<span class="required" id="MonthlyBudgetReq">*</span>
			</div>
			<div class="form-item">
  			<label>Have you had a history of bad credit?</label>
				<select class="basis" name="financeCredit" onchange="required(this, 'combobox');">
					<option value="">Please Select</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<span class="required" id="financeCreditReq">*</span>
			</div>
			<div class="form-item">
  			<label>Have you been declined credit in the last 12 months?</label>
				<select class="basis" name="financeDecline" onchange="required(this, 'combobox');">
					<option value="">Please Select</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<span class="required" id="financeDeclineReq">*</span>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Additional Information</legend>
		<div id="Information">
			<label>Comments</label>
				<textarea name="infoComments" class="infoComments" rows="7" cols="25"></textarea>
		</div>
	</fieldset>
	</div>
	
	<!--<a href="#" class="submitButton" name="Submit" title="Request Quote" onclick="submitForm(); return false;">Request Quote</a>-->
	<div id="quoteSubmit"><input type="submit" class="submitButton" name="Submit" value="Request Quote" /></div>
</form>