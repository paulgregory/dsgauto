<?php
  $goBackURL = FALSE;

  // Check if the POST contains vehicle details
  if (isset($_POST['quoteVehicleCAPID']) && is_numeric($_POST['quoteVehicleCAPID']) && isset($_POST['quoteVehicleType'])) {
	
	  $vtype = ($_POST['quoteVehicleType'] == 'car')? 'car' : 'van';
	  $vehicleType = ($vtype == 'car')? 'c' : 'v';
	  $capid = intval($_POST['quoteVehicleCAPID']);
	
	  $qryVehicle = mysql_query(vehicleInfoAndFinance($capid, $vtype));
	  if ($vehicle = mysql_fetch_assoc($qryVehicle)) {
		  $brand = $vehicle['Manufacturer'];
		  $model = $vehicle['ModelShort'];
		  $deriv = $vehicle['DerivativeLong'];
		  $finance = htmlspecialchars($_POST['quoteVehicleFinance']);
		}
		
		$options = array();
	  foreach ($_POST['vehicleOptions'] as $optid => $opt) {
		  $options[$optid] = htmlspecialchars($opt);
	  }
	
	  // Calculate the finance rental with selected options
	  $financeTotal = FALSE;
	  if (isset($_POST['quoteVehicleFinanceRental'])) {
		  $financeTotal = (float) $_POST['quoteVehicleFinanceRental'];
	  }
	  if (isset($_POST['vehicleOptions'])) {
		  foreach($_POST['vehicleOptions'] as $optid => $label) {
			  $financeTotal += (float) $_POST['vehicleOptionsPrice'][$optid];
		  }
	  }
	
	  $goBackURL = vehicle_url($brand, $model, $deriv, $capid, $vtype, $finance);
	
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
	
	if(isset($_GET['brand']))
	{
		$vehicleType = substr($_GET['brand'], 0, 1);
		$vtypeBool = ($vehicleType == 'c')? TRUE : FALSE;
		$brandID = substr($_GET['brand'], 1);

    $qryBrand = mysql_query(getBrandFromId($vtypeBool, $brandID));
    if ($qryBrand && mysql_num_rows($qryBrand)) {
	    $rstBrand = mysql_fetch_assoc($qryBrand);
	    $brand = $rstBrand['brand'];
    }
    
	}


?>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<script type="text/javascript" src="/javascript/Ajax.js"></script>
<script type="text/javascript" src="/javascript/gen_validatorv4.js"></script>
<h1>Get a Quote</h1> 
<p class="smaller">So that we can search all of our finance partners to calculate the very best deal for you please complete your details below.  
You will then be able to select a quote based on one of the following finance agreements;
business contract hire, 
personal contract hire, 
business contract purchase, 
personal contact purchase, 
lease purchase and hire purchase.  
If you are unsure about the type of finance package best suits you then <a href="/car_leasing-business-contact_us.html" title="Contact Us">contact us</a>.</p>

<?php if ($goBackURL): ?>
<!-- Go back facility -->
<form id="go-back" method="post" action="/<?php print $goBackURL; ?>" class="clearfix">
<?php 
if (count($options)) {
	foreach ($options as $optid => $opt) {
		print '<input type="hidden" name="selectedOptions['.$optid.']" value="selected" />';
	}
}?>
<input type="submit" value="&lsaquo; Back" id="go-back-submit" name="go-back-submit" />
</form>
<?php endif; ?>

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
			  <?php 
        if(isset($vehicleType)) {
	        $vehicleTypeStr = ($vehicleType == 'c')? 'Car' : 'Van';
	        print '<input type="text" name="vehicleType" id="vehicleTypeID" class="vehicleLine" value="'.$vehicleTypeStr.'" readonly style="border: 1px dotted #bbb" />';
        }
        else { ?>
			
				<select id="vehicleTypeID" name="vehicleType" class="vehicleLine"  onchange="getBrandList(this.value, updateBrandSelection);">
					<option value="">Please Select</option>
					<option value="car">Car</option>
					<option value="van">Van</option>
				</select>
				
				<?php } ?>
			</div>
			<div class="form-item">
  			<label>Manufacturer</label>
        <?php 
        if(isset($brand)) {
	        print '<input type="text" name="brandSelection" id="brandSelection" class="vehicleLine" value="'.$brand.'" readonly style="border: 1px dotted #bbb" />';
        }
        else { ?>

				<select name="brandSelection" id="brandSelection" class="vehicleLine" <?php if (!isset($vehicleType)) print 'disabled'; ?> onchange="getModelList(this.value, updateModelSelection);" >
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
						$strBrandList .= "<option value=\"$strBrandID\">$strBrandName</option>";
					}
					echo $strBrandList;
				?>
				</select>
				
				<?php } ?>
			</div>
      <div class="form-item">
			  <label>Model</label>
			  <?php 
        if(isset($model)) {
	        print '<input type="text" name="modelSelection" id="modelSelection" class="vehicleLine" value="'.$model.'" readonly style="border: 1px dotted #bbb" />';
        }
        else { ?>
			
				<select name="modelSelection" id="modelSelection" class="vehicleLine" <?php if (!isset($brand)) print 'disabled'; ?> onchange="getDerivList(this.value, updateDerivSelection);">
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
							$strModels .= "<option value=\"$strModelID\">$strModel</option>";
						}
					}
					echo $strModels;
				?>
				</select>
				<?php } ?>
			</div>
			<div class="form-item">
  			<label>Derivative</label>
        <?php 
        if(isset($capid)) {
	        $vtypeBool = ($vehicleType == 'c')? TRUE : FALSE;	
	        $qryVehicle = mysql_query(getCapVehicle($vtypeBool, $capid), $dbConnect);

          if ($qryVehicle && mysql_num_rows($qryVehicle)) {
	          $vehicle = mysql_fetch_assoc($qryVehicle); 
	          print '<input type="text" name="derivSelection" id="derivSelection" class="vehicleLine" value="'.$vehicle['derivative'].'" readonly style="border: 1px dotted #bbb" />';
          }
        }
        else { ?>

				<select name="derivSelection" id="derivSelection" class="vehicleLine" <?php if (!isset($model)) print 'disabled'; ?> onchange="required(this, 'combobox');">
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
							$strDerivs .= "<option value=\"$strDerivID\">$strDeriv</option>";
						}
						echo $strDerivs;
					}
					?>
				</select><span class="required" id="derivSelectionReq"><?php if(!isset($did)) echo "*";?></span>
				
				<?php } ?>
			</div>
			
			<div class="form-item">
			  <label>Options</label>
				<textarea name="vehicleOptions" class="vehicleOptions" rows="7" cols="25" <?php if ($financeTotal) { print 'readonly style="border: 1px dotted #bbb; resize: none"'; } ?>><?php 
					if ($financeTotal) {
						print 'QUOTED FINANCE RENTAL: '."\n".strip_tags(cap_format_price($financeTotal))."\n\n";
					}
					if (count($options)) {
						print 'SELECTED OPTIONS:'."\n";
						foreach ($options as $optid => $opt) {
							print "".$opt."\n";
						}
					} ?></textarea>
					<?php if ($goBackURL): ?>
						<p class="go-back-link"><a href="javascript:void(0)" onclick="$('#go-back').submit();">Go back and change these options</a></p>
					<?php endif; ?>

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
<script type="text/javascript">
 var frmvalidator  = new Validator("Form");
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("FullName","req","Please enter your full name.");
frmvalidator.addValidation("TelephoneDay","req","Please enter your telephone number.");
frmvalidator.addValidation("EmailAddress","req","Please enter your email address.");
</script>