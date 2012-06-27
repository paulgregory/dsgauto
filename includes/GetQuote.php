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
		//$vehicleType = substr($get, 0, 1);
		$brandID = substr($get, 0);
	}
	if(isset($_GET['vehicleType']))
	{
		$get = $_GET['vehicleType'];
		$vehicleType = substr($get, 0, 1);
	}
	if(isset($_GET['modelSelection']))
	{
		$get = $_GET['modelSelection'];
		$modelID = substr($get, 0);
	}
	if(isset($_GET['derivSelection']))
	{
		$get = $_GET['derivSelection'];
		$derivID = substr($get, 0);
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

<form id="Form" method="post" action="">
	<fieldset>
		<legend>Contact Details</legend>
		<div id="contactDetails">			
			<label>Full Name</label>
				<input type="text" name="FullName" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="FullNameReq">*</span>
			<label>Telephone Number</label>
				<input type="text" name="TelephoneDay" class="contactLine" value="" onblur="required(this, 'telNo');" maxlength="15"/>
				<span class="required" id="TelephoneDayReq">*</span>
			<label>Email Address</label>
				<input type="text" name="EmailAddress" class="contactLine" value="" onblur="required(this, 'email');" maxlength="255"/>
				<span class="required" id="EmailAddressReq">*</span>
			<label>How you found us</label>
				<input type="text" name="HowYouFoundUs" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="HowYouFoundUsReq">*</span>
		</div>
	</fieldset>
	<fieldset>
		<legend>Vehicle Details</legend>
		<div id="Vehicle">
			<label>Vehicle Type</label>
				<select id="vehicleTypeID" name="vehicleType" class="vehicleLine"  onchange="getBrandList(this.value, updateBrandSelection);">
					<option value= "">Please Select</option>
					<option value="cars" <?php if(isset($vehicleType) && $vehicleType == 'c') echo "selected=\"selected\"";?>>Car</option>
					<option value="vans" <?php if(isset($vehicleType) && $vehicleType == 'v') echo "selected=\"selected\"";?>>Van</option>
				</select><br />
			<label>Manufacturer</label>
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
				</select><br />
			<label>Model</label>
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
				</select><br />
			<label>Derivative</label>
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
				<br />
			<label>Options</label>
				<textarea name="vehicleOptions" class="vehicleOptions" rows="7" cols="25"></textarea>
		</div>
	</fieldset>
	<fieldset>
		<legend>Finance Details</legend>
		<div id="Finance">
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
			<label>Maintenace Package</label>
				<input type="checkbox" name="financeMaintenance" class="financeCheck" value="on"/>
			<label>Mileage Per Year</label>
				<input type="text" name="MileagePA" class="financeLine" value="" onblur="required(this, 'number')" maxlength="10"/>
				<span class="required" id="MileagePAReq">*</span>
			<label>Monthly Budget (&pound;)</label>
				<input type="text" name="MonthlyBudget" class="financeLine" value="" onblur="required(this, 'number')" maxlength="10"/>
				<span class="required" id="MonthlyBudgetReq">*</span>
				
			<label>Have you had a history of bad credit?</label>
				<select class="basis" name="financeCredit" onchange="required(this, 'combobox');">
					<option value="">Please Select</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<span class="required" id="financeCreditReq">*</span>
			<label>Have you been declined credit in the last 12 months?</label>
				<select class="basis" name="financeDecline" onchange="required(this, 'combobox');">
					<option value="">Please Select</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<span class="required" id="financeDeclineReq">*</span>
		</div>
	</fieldset>
	<fieldset>
		<legend>Additional Information</legend>
		<div id="Information">
			<label>Comments</label>
				<textarea name="infoComments" class="infoComments" rows="7" cols="25"></textarea>
		</div>
	</fieldset>
	<!--<a href="#" class="submitButton" name="Submit" title="Request Quote" onclick="submitForm(); return false;">Request Quote</a>-->
	<input type="submit" class="submitButton" name="Submit" value="Request Quote" />
</form>