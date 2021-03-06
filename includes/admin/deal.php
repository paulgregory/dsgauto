<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		$add = true;
		$vehicleType = "";
		$strBrand = "";
		$strModel = "";
		$strDeriv= "";
		$initialPayment = "";
		$monthlyPayment = "";
		$term = "";
		$annualMileage = 0;
		$docFee = "";
		$profile1 = "";
		$profile2 = "";
		$financeType = "";
		$notes = "";
		$business = 0;
		$personal = 0;
		$imageID = "";
		$finalPayment = 0;
		$specialOffer = 0;
		$deleted = false;
		if(isset($_POST['editDeal']))
		{
			$monthlyPayment = addslashes($_POST['monthlyPayment']);
			$term = addslashes($_POST['term']);
			$initialPayment = addslashes($_POST['initialPayment']);
			if(isset($_POST['annualMileage'])) $annualMileage = addslashes($_POST['annualMileage']);
			$docFee = addslashes($_POST['docFee']);
			$profile1 = addslashes($_POST['profile1']);
			$profile2 = addslashes($_POST['profile2']);
			$financeType = addslashes($_POST['financeType']);
			$notes = addslashes($_POST['notes']);
			if(isset($_POST['specialOffer'])) $specialOffer = addslashes($_POST['specialOffer']);
			if(isset($_POST['finalPayment'])) $finalPayment = addslashes($_POST['finalPayment']);
			if(isset($_POST['business'])) $business = addslashes($_POST['business']);
			if(isset($_POST['personal'])) $personal = addslashes($_POST['personal']);
			if($financeType == "hire")
				$financeType = 1; 
			else{
				$financeType = 0;
				$personal = 0;
			}
			if($vehicleType == "car")
				$vehicleType = 1;
			else
				$vehicleType = 0;
			$imageID = addslashes($_POST['imageID']);
			$did = $_GET['did'];
			$qryDeal = mysql_query(updateDeal($did, $notes, $profile1, $profile2, $initialPayment, $monthlyPayment, $term, $annualMileage, $docFee, true, $business, $personal, $imageID, $financeType, $finalPayment, $specialOffer), $dbConnect);
			if ($qryDeal)
				$strUpdated = "Deal Edited - <a href=\"/car_leasing-business-contract_hire-EditedDeal-$did.html\">Go Back</a>";			
			else
				$strUpdated = "Deal Not Edited" . mysql_error();
		}
		if(isset($_POST['deleteDeal']))
		{
			$did = $_GET['did'];
			$qryDeleteDeal = mysql_query(deleteDeal($did, $dbConnect));
			if ($qryDeleteDeal)
			{
				$deleted = true;
			}
		}
		if(isset($_GET['did']) && !empty($_GET['did']))
		{
			$add = false;
			$did = $_GET['did'];
			$qryVT = mysql_query(getVehicleType($did ,$dbConnect));
			$rstVT = mysql_fetch_array($qryVT);
			if ($rstVT['vehicleType'] == 1)
				$qryDeal = mysql_query(sqlCapDealGet($did, true, 1),$dbConnect);
			else
				$qryDeal = mysql_query(sqlCapDealGet($did, false, 1),$dbConnect);
			$rstDeal = mysql_fetch_array($qryDeal);
			$vehicleType = stripslashes($rstDeal['vehicleType']);
			$strBrand = stripslashes($rstDeal["brand"]);
			$strModel = stripslashes($rstDeal["model"]);
			$strDeriv = stripslashes($rstDeal["derivative"]);
			$initialPayment = stripslashes($rstDeal['initial_payment']);
			$monthlyPayment = stripslashes($rstDeal['monthly_payment']);
			$term = stripslashes($rstDeal['monthly_payments']);
			$annualMileage = stripslashes($rstDeal['annual_mileage']);
			$docFee = stripslashes($rstDeal['doc_fee']);
			$profile1 = stripslashes($rstDeal['profile1']);
			$profile2 = stripslashes($rstDeal['profile2']);
			$financeType = stripslashes($rstDeal['financeType']);
			$notes = stripslashes($rstDeal['notes']);
			$specialOffer = stripslashes($rstDeal['special_offer']);
			$business = stripslashes($rstDeal['business']);
			$personal = stripslashes($rstDeal['personal']);
			$imageID = stripslashes($rstDeal['imageID']);
			$finalPayment = stripslashes($rstDeal['final_payment']);
		}
		if(isset($_POST['addDeal']))
		{	
			$vehicleType = addslashes($_POST['vehicleType']);
			$VehicleID = addslashes($_POST['derivSelection']);
			$monthlyPayment = addslashes($_POST['monthlyPayment']);
			$term = addslashes($_POST['term']);
			$initialPayment = addslashes($_POST['initialPayment']);
			$annualMileage = addslashes($_POST['annualMileage']);
			$docFee = addslashes($_POST['docFee']);
			$profile1 = addslashes($_POST['profile1']);
			$profile2 = addslashes($_POST['profile2']);
			$financeType = addslashes($_POST['financeType']);
			$notes = addslashes($_POST['notes']);
			if(isset($_POST['specialOffer'])) $specialOffer = addslashes($_POST['specialOffer']);
			$finalPayment = addslashes($_POST['finalPayment']);
			if(isset($_POST['business'])) $business = addslashes($_POST['business']);
			if(isset($_POST['personal'])) $personal = addslashes($_POST['personal']);
			if($financeType == "hire")
				$financeType = 1; 
			else{
				$financeType = 0;
				$personal = 0;
			}
			if($vehicleType == "car")
				$vehicleType = 1;
			else
				$vehicleType = 0;
			$imageID = addslashes($_POST['imageID']);
			
			$qryDeal = mysql_query(addDeal($vehicleType, $VehicleID, $notes, $profile1, $profile2, $initialPayment, $monthlyPayment, $term, $annualMileage, $docFee, true, $business, $personal, $imageID, $financeType, $finalPayment, $specialOffer), $dbConnect);
			if ($qryDeal)
				$strUpdated = "Deal Added";			
			else
				$strUpdated = "Deal Not Added" . mysql_error();
		}
?>
<div id="administrationTop"></div>
<div id="administration">
	<h1>Edit Deal</h1>
	<script type="text/javascript" src="javascript/Ajax.js"></script>
<?php
if(!$deleted) {
if (isset($strUpdated)) echo $strUpdated;?>
	<form action="" method="post" id="DealForm">
<?php if($add) {?>
	<div class="form-item">
	<label>Vehicle Type</label>
		<select id="vehicleTypeID" name="vehicleType" onchange="getBrandList(this.value, updateBrandSelection);">
			<option value="">&mdash; &mdash;</option>
			<option value="car">Car</option>
			<option value="van">Van</option>
		</select>
	</div>
	<div class="form-item">
	<label>Brand</label>
		<select name="brandSelection" id="brandSelection" disabled="disabled" onchange="getModelList(this.value, updateModelSelection);" ><option value="">Please Select</option></select>
	</div>
	<div class="form-item">
	<label>Model</label>
		<select name="modelSelection" id="modelSelection" disabled="disabled" onchange="getDerivList(this.value, updateDerivSelection);" ><option value="">Please Select</option></select>
	</div>
	<div class="form-item">
	<label>Derivative</label>
		<select name="derivSelection" id="derivSelection" disabled="disabled"><option value="">Please Select</option></select>
	</div>
<?php 
	} else {
		print "<p><strong>$strBrand, $strModel, $strDeriv</strong></p>";
	}
?>
  <div class="form-item">
	<label>Finance Type</label>
	<select name="financeType" onchange="selectFinanceType(this.value);">
		<option value="">Please Select</option>
		<option value="hire"<?php if($financeType == 1) echo "selected=\"selected\""; ?>>Contract Hire</option>
		<option value="lease"<?php if($financeType == 0) echo "selected=\"selected\""; ?>>Finance Lease</option>
	</select>
	</div>
	<div class="form-item">
	<label>Initial Payment</label>
		<input type="text" name="initialPayment" class="both" value="<?php echo $initialPayment; ?>" maxlength="255"/>
	</div>
	<div class="form-item">
	<label>Monthly Payment</label>
		<input type="text" name="monthlyPayment" class="both" value="<?php echo $monthlyPayment; ?>" maxlength="255"/>
	</div>
	<div class="form-item">
	<label>Term</label>
		<input type="text" name="term" class="both" value="<?php echo $term; ?>" maxlength="255"/>
	</div>
	<div class="form-item" <?php if($financeType == 0) print 'style="display: none"'; ?>>
	  <label class="contractHire">Annual Mileage</label>
		<input type="text" name="annualMileage" class="contractHire" value="<?php echo $annualMileage; ?>" maxlength="255" />
	</div>
	<div class="form-item" <?php if($financeType == 1) echo 'style="display: none"'; ?>>
	<label class="financeLease">Final Payment</label>
		<input type="text" name="finalPayment" class="financeLease" value="<?php echo $finalPayment; ?>" maxlength="255" />
	</div>
	<div class="form-item">
	<label>Doc Fee</label>
		<input type="text" name="docFee" class="both" value="<?php echo $docFee; ?>" maxlength="255"/>
	</div>
	<div class="form-item">
	<label>Front Page Profile</label>
		<input type="text" name="profile1" class="both" value="<?php echo $profile1; ?>" maxlength="70"/>
	</div>
	<div class="form-item">
	<label>Deal Page Profile</label>
		<input type="text" name="profile2" class="both" value="<?php echo $profile2; ?>" maxlength="70"/>
	</div>
	<div class="form-item">
		<input type="checkbox" name="business" class="both" <?php if($business) echo "checked=\"checked\""; ?> value="1"/> <strong>Business</strong><br />
		<input type="checkbox" name="personal" class="both" <?php if($personal) echo "checked=\"checked\""; ?> value="1"/> <strong>Personal</strong>
	</div>
	<div class="form-item">
	<label>Notes</label>
	<textarea cols="30" rows="5" name="notes"><?php echo $notes ?></textarea>
	</div>
	<div class="form-item">
		<input type="checkbox" name="specialOffer" class="both" <?php if($specialOffer) echo "checked=\"checked\" disabled=\"disabled\" "; ?> value="1" /> <strong>Special Offer of the week?</strong>
	</div>
  <div class="form-item">
	  <label>Image</label>
	  <select name="imageID" onchange="getVehicleImage(this.value, showImage);">
		<?php
			$qryImages = mysql_query($sqlGetImageNames, $dbConnect);
			$strOut = "";
			if($qryImages)
			while ($rstImages = mysql_fetch_array($qryImages))
			{
				$id = $rstImages['id'];
				$name = $rstImages['name'];
				if($id == $imageID)
					$strOut .= "<option selected=\"selected\" value=\"$id\">$name</option>";
				else
					$strOut .= "<option value=\"$id\">$name</option>";
			}
			echo $strOut;
		?>
	  </select>
	</div>
	<div id="imageHolder">
	</div>
	
	
<?php if($add): ?>
	<p><input type="submit" value="Add Deal" name="addDeal" /> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a></p>
<?php else: ?>
	<p><input type="submit" value="Save Deal" name="editDeal" /> &nbsp;&nbsp;&nbsp; <input type="submit" value="Delete Deal" name="deleteDeal" /> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a></p>
<?php endif;
 
} else {
	echo "Deal deleted <a href=\"administration-deals.html\">Go back to deals</a>";
}
?>
	</form>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>