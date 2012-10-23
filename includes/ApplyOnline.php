<?php
	$type = htmlspecialchars($_GET['type']);
	if(isset($_GET['did']))
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
?>
<script type="text/javascript" src="/javascript/ApplyOnlineScript.js"></script>
<script type="text/javascript" src="/javascript/formValidation.js"></script>
<script type="text/javascript" src="/javascript/Ajax.js"></script>
<script type="text/javascript" src="/javascript/gen_validatorv4.js"></script>

<?php
if(!isset($did))
{
	if($type == 'personal')
		echo "<a href=\"/car_leasing-business-apply_online-business.html\" class=\"switchApplication\" title=\"Apply Online\">Switch to a Business Application</a>";
	else
		echo "<a href=\"/car_leasing-business-apply_online-personal.html\" class=\"switchApplication\" title=\"Apply Online\">Switch to a Personal Application</a>";
}
?>
<h1>Apply Online Form - <?php echo ucwords($type); ?> Application</h1>
<p><span class="required" id="helper">*</span>&nbsp; Indicates a required field. If you do not have information for a required field (e.g. VAT Number), please type N/A instead.</p>
<form id="Form" name="Form" method="post" action="" class="clearfix">
	<div class="column-1">
	
<?php if($type == 'business') {?>
	<fieldset>
		<legend>Business Details</legend>
		<div id="companyDetails">
			<div class="form-item">
			<label>Business Type</label>
				<select class="businessType" name="businessType" onchange="changeBType(this.value);">
					<option value="0">Please Select</option>
					<option value="soleTrader">Sole Trader</option>
					<option value="partnership">Partnership</option>
					<option value="limitedCompany">Limited Company</option>
				</select>
				<span class="required" id="businessTypeReq">*</span>
			</div>
			<div class="form-item">
			<label>Full Trading Name</label>
				<input type="text" name="businessName" class="companyLine" value=""  maxlength="255"/>
				<span class="required" id="businessNameReq">*</span>
			</div>
			<div class="form-item">
			<div id="BusinessAddress">
				<label>Address Line 1</label>
					<input type="text" name="businessAddressA" class="addressLine" value="" maxlength="255"/>
					<span class="required" id="businessAddressAReq">*</span>
				<label>Address Line 2</label>
					<input type="text" name="businessAddressB" class="addressLine" value="" maxlength="255"/>
				<label>Town/City</label>
					<input type="text" name="businessAddressC" class="addressLine" value="" maxlength="255"/>
					<span class="required" id="businessAddressCReq">*</span>
				<label>Postcode</label>
					<input type="text" name="businessPostcode" class="addressLine" value="" maxlength="255"/>
					<span class="required" id="businessPostcodeReq">*</span>
			</div>
			</div>
			<div class="form-item">
			<label>Business Landline</label>
				<input type="text" name="businessTelNo" class="companyLine" value="" maxlength="255"/>
				<span class="required" id="businessTelNoReq">*</span>
			</div>
			<div class="form-item">
			<label>Trading Since</label>
				<input type="text" name="businessTradingSince" class="companyLine" value="" maxlength="12"/>
				<span class="required" id="businessTradingSinceReq">*</span>
			</div>
			<div class="form-item">
			<label>Nature of Business</label>
				<input type="text" name="businessNature" class="companyLine" value="" maxlength="255"/>
				<span class="required" id="businessNatureReq">*</span>
			</div>
			<div class="form-item">
			<label>Number of Employees</label>
				<input type="text" name="businessEmployees" class="companyLine" value="" maxlength="10"/>
				<span class="required" id="businessEmployeesReq">*</span>
			</div>
			<div class="form-item">
			<label>Annual Turnover (&pound;)</label>
				<input type="text" name="businessFinanceBudget" class="companyLine" value="" maxlength="10"/>
				<span class="required" id="businessFinanceBudgetReq">*</span>
			</div>
			<div class="form-item">
			<label>VAT Number</label>
				<input type="text" name="businessVATNo" class="companyLine" value="" maxlength="10"/>
				<span class="required" id="businessVATNoReq">*</span>
			</div>
			<div class="form-item">
			<label>Company Reg Number</label>
				<input type="text" name="businessRegNo" class="companyLine" value="" maxlength="10"/>
				<span class="required" id="businessRegNoReq">*</span>
			</div>
		</div>
	</fieldset>
	<div id="businessDiv">
	</div>
<?php } else {?>
	<fieldset>
		<legend>Contact Details</legend>
		<div id="contactDetails">				
			<label>Title</label>
				<select class="title" name="title1" onchange="required(this, 'combobox');">
					<option value="">&mdash;&mdash;</option>
					<option value="Dr">Dr</option>
					<option value="Miss">Miss</option>
					<option value="Mr">Mr</option>
					<option value="Mrs">Mrs</option>
					<option value="Ms">Ms</option>
				</select>
				<span class="required" id="title1Req">*</span>
			<label>First name</label>
				<input type="text" name="foreName1" class="contactLine"  maxlength="255"/>
				<span class="required" id="foreName1Req">*</span>
			<label>Middle name</label>
				<input type="text" name="middleName1" class="contactLine" value="" maxlength="255"/>
			<label>Last name</label>
				<input type="text" name="surName1" class="contactLine" value=""  maxlength="255"/>
				<span class="required" id="surName1Req">*</span>
			<label>Telephone number</label>
				<input type="text" name="telNo1" class="contactLine" value="" maxlength="15"/>
				<span class="required" id="telNo1Req">*</span>
			<label>Mobile number</label>
				<input type="text" name="mobNo1" class="contactLine" value="" maxlength="15"/>
			<label>Email address</label>
				<input type="text" name="emailAddress1" class="contactLine" value="" maxlength="255"/>
				<span class="required" id="emailAddress1Req">*</span>
			<label>D.O.B (DD/MM/YYYY)</label>
				<input type="text" name="DOB1" class="contactLine" value="" maxlength="12"/>
				<span class="required" id="DOB1Req">*</span>
			<label>Marital Status</label>
				<select class="maritalStatus" name="maritalStatus1">
					<option value="">Please Select</option>
					<option value="Married">Married</option>
					<option value="Single">Single</option>
					<option value="Divorced">Divorced</option>
					<option value="LWP">Living with Partner</option>
				</select>
				<span class="required" id="maritalStatus1Req">*</span>
		</div>
	</fieldset>
	<fieldset>
		<legend>Address Details</legend>
		<div id="Addresses1">
			<p>Please provide 5 years address history</p>
			<div id="Address1-1" class="Address">
				<h4>Current Address</h4>
				<label>Address Line 1</label>
					<input type="text" name="addressA1-1" class="addressLine" value="" maxlength="255"/>
					<span class="required" id="addressA1-1Req">*</span>
				<label>Address Line 2</label>
					<input type="text" name="addressB1-1" class="addressLine" value="" maxlength="255"/>
				<label>Town/City</label>
					<input type="text" name="addressC1-1" class="addressLine" value="" maxlength="255"/>
					<span class="required" id="addressC1-1Req">*</span>
				<label>Postcode</label>
					<input type="text" name="postcode1-1" class="addressLine" value="" maxlength="255"/>
					<span class="required" id="postcode1-1Req">*</span>
				<label>Accomodation Type</label>
				<select class="accomType" name="accomType1-1" onchange="required(this, 'combobox');">
					<option value="">Please Select</option>
					<option value="Owner">Owner</option>
					<option value="TenantPF">Tenant (Private Furnished)</option>
					<option value="TenantPU">Tenant (Private Unfurnished)</option>
					<option value="TenantC">Tenant (Council)</option>
					<option value="LWP">Living with Parents</option>
					<option value="Other">Other</option>
				</select>
				<span class="required" id="accomType1-1Req">*</span>
				<div class="addressTerm">
				<label>Years at Address</label>
					<input type="text" class="years" name="addressYears1-1">
					<span class="required" id="addressYears1-1Req">*</span>
				<label>Months at Address</label>
					<input type="text" class="months" name="addressMonths1-1">
					<span class="required" id="addressMonths1-1Req">*</span>
				</div>
			</div>
		</div>
		<a id="addAddress1" title="Add Address" class="addAddress" onclick="addAddress(1, 2);">Add Address</a>
	</fieldset>
	<fieldset>
		<legend>Employment Details</legend>
		<div id="Jobs1">
			<p>Please provide 5 years employment history</p>
			<div id="Job1-1" class="Job">
				<h3>Current Employment</h3>
				<label>Employer Name</label>
					<input type="text" name="jobEmpName1-1" class="jobLine" value="" maxlength="255"/>
					<span class="required" id="jobEmpName1-1Req">*</span>
				<label>Address Line 1</label>
					<input type="text" name="jobAddressA1-1" class="jobLine" value="" maxlength="255"/>
					<span class="required" id="jobAddressA1-1Req">*</span>
				<label>Address Line 2</label>
					<input type="text" name="jobAddressB1-1" class="jobLine" value="" maxlength="255"/>
				<label>Town/City</label>
					<input type="text" name="jobAddressC1-1" class="jobLine" value="" maxlength="255"/>
					<span class="required" id="jobAddressC1-1Req">*</span>
				<label>Postcode</label>
					<input type="text" name="jobPostcode1-1" class="jobLine" value="" maxlength="255"/>
					<span class="required" id="jobPostcode1-1Req">*</span>
				<label>Telephone number</label>
					<input type="text" name="jobTelNo1-1" class="jobLine" value="" onblur="required(this, 'telNo');" maxlength="15"/>
					<span class="required" id="jobTelNo1-1Req">*</span>
				<label>Occupation</label>
					<input type="text" name="jobOccupation1-1" class="jobLine" value="" maxlength="255"/>
					<span class="required" id="jobOccupation1-1Req">*</span>
				<label>Occupation Basis</label>
					<select class="jobLine" name="jobBasis1-1">
						<option value="">Please Select</option>
						<option value="fullTime">Full Time</option>
						<option value="partTime">Part Time</option>
						<option value="selfEmployed">Self Employed</option>
					</select>
					<span class="required" id="jobBasis1-1Req">*</span>
				<div class="jobTerm">
				<label>Years Employed</label>
					<input type="text" class="years" name="jobYears1-1">
					<span class="required" id="jobYears1-1Req">*</span>
				<label>Months Employed</label>
					<input type="text" class="months" name="jobMonths1-1">
					<span class="required" id="jobMonths1-1Req">*</span>
				</div>
			</div>
		</div>
		<a id="addJob1" title="Add Job" class="addJob" onclick="addJob(1, 2);">Add Job</a>
	</fieldset>
	<?php } ?>
	<fieldset>
		<legend>Vehicle Details</legend>
		<div id="Vehicle">
			<label>Vehicle Type</label>
				<select id="vehicleTypeID" name="vehicleType" class="vehicleLine" onchange="getBrandList(this.value, updateBrandSelection);">
					<option value="">Please Select</option>
					<option value="car" <?php if(isset($vehicleType) && $vehicleType == 'c') echo "selected=\"selected\"";?>>Car</option>
					<option value="van" <?php if(isset($vehicleType) && $vehicleType == 'v') echo "selected=\"selected\"";?>>Van</option>
				</select><br />
				
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
							$strBrandID = dsg_encode($rstBrand["brand"]);
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
								$strModelID = dsg_encode($rstModels['model']);
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
								$strDerivs .= "<option value=\"$strDerivID\">$strDeriv</option>";
							}
							echo $strDerivs;
						}
						?>
					</select><span class="required" id="derivSelectionReq"><?php if(!isset($did)) echo "*";?></span>
				</div>	
		
			<label>Options</label>
				<textarea name="vehicleOptions" class="vehicleOptions" rows="7" cols="25"></textarea>
		</div>
	</fieldset>
	</div>
	
	<div class="column-2">
	<fieldset>
		<legend>Finance Details</legend>
		<div id="Finance">
			<div class="form-item">
			<label>Finance Type</label>
				<?php if($type == 'personal') {?>
				<select class="basis" name="financeType">
					<option <?php if (!isset($did)) echo "selected=\"selected\""; ?> value="">Please Select</option>
					<option <?php if(isset($financeType) && $financeType == 1) echo "selected=\"selected\"";?> value="hire">Contract Hire</option>
				</select>
				<?php } else { ?>
				<select class="basis" name="financeType">
					<option <?php if (!isset($did)) echo "selected=\"selected\""; ?> value="">Please Select</option>
					<option <?php if(isset($financeType) && $financeType == 1) echo "selected=\"selected\"";?> value="hire">Contract Hire</option>
					<option <?php if(isset($financeType) && $financeType == 0) echo "selected=\"selected\"";?> value="lease">Finance Lease</option>
				</select>
				<?php }?>
				<span class="required" id="financeTypeReq"><?php if (!isset($did)) echo "*"; ?></span>
			</div>
			<div class="form-item">
			<label>Term</label>
				<select class="basis" name="financeTerm">
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
				<span class="required" id="financeTermReq">*</span>
			</div>
			<div class="form-item">
			<label>Maintenace Package</label>
				<input type="checkbox" name="financeMaintenance" class="financeCheck" value=""/>
			</div>
			<div class="form-item">
			<label>Mileage Per Year</label>
				<input type="text" name="financeMileage" class="financeLine" value="" maxlength="10"/>
				<span class="required" id="financeMileageReq">*</span>
			</div>
			<div class="form-item">
			<label>Monthly Budget (&pound;)</label>
				<input type="text" name="financeBudget" class="financeLine" value="" maxlength="10"/>
				<span class="required" id="financeBudgetReq">*</span>
			</div>
			<div class="form-item">
			<label>Have you had a history of bad credit?</label>
				<select class="basis" name="financeCredit">
					<option value="">Please Select</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<span class="required" id="financeCreditReq">*</span>
			</div>
			<div class="form-item">
			<label>Have you been declined credit in the last 12 months?</label>
				<select class="basis" name="financeDecline">
					<option value="">Please Select</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<span class="required" id="financeDeclineReq">*</span>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Bank Details</legend>
		<div id="Bank">
			<label>Bank Name</label>
				<input type="text" name="bankName" class="bankLine" value=""  maxlength="100"/>
				<span class="required" id="bankNameReq">*</span>
			<label>Sort Code</label>
				<input type="text" name="bankSortCode" class="bankLine" value="" maxlength="6"/>
				<span class="required" id="bankSortCodeReq">*</span>
			<label>Account Number</label>
				<input type="text" name="bankAccNo" class="bankLine" value="" maxlength="8"/>
				<span class="required" id="bankAccNoReq">*</span>
			<label>Years with Bank</label>
				<select class="years" name="bankYears">
					<option value= "">&mdash;</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">&gt; 5</option>
				</select>
				<span class="required" id="bankYearsReq">*</span>
		</div>
	</fieldset>
	<fieldset>
		<legend>Additional Information</legend>
		<div id="Information">
			<label>Comments</label>
				<textarea name="infoComments" class="infoComments" rows="7" cols="25"></textarea>
			<p><i><strong>Credit decisions and also the prevention of fraud and money laundering</strong>
					We may use credit reference and fraud prevention agencies to help us make decisions. 
					By confirming your agreement to proceed you are accepting that we may each use your information in this way.  
					Please signify that you have obtained the permission of the applicant by ticking the checkbox.</i></p>
			<label>Agree to these terms</label>
				<input type="checkbox" name="infoDisclaimer" class="infoCheck" value="0"/>
				<span class="required" id="infoDisclaimerReq">*</span>
		</div>
	</fieldset>
	</div>
	<div id="quoteSubmit">
	<input type="submit" class="submitButton" name="Submit" id="Submit" value="Apply Now" />
	</div>
	<!--<a href="#" name="Submit" class="submitButton" onclick="submitForm(); return false;">Apply Now</a>-->
	<!--<a href="#" name="Submit" class="submitButton" onclick="checkHistory(); return false;">Check History</a>-->
</form>
<script type="text/javascript">
 var frmvalidator  = new Validator("Form");
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("businessName","req","Please enter your business name.");
frmvalidator.addValidation("businessTelNo","req","Please enter your business landline number.");
frmvalidator.addValidation("businessTelNo","num","Business landline may only contain numbers.");
frmvalidator.addValidation("businessType","dontselect=0","Please choose your business type.");
frmvalidator.addValidation("infoDisclaimer","shouldselchk=1","You must signify your agreement of the terms to continue.");
</script>