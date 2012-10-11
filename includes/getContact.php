<?php
	include('WebSiteMail.php');
	include('init.php');
	$today = date("d/m/Y");
	$OutputMessage = "Nothing happened";
	
	if (isset($_POST['Submit'])){     //Will always be YES as this is only imported if Submitted
		$OutputMessage = "<h2>Thank You</h2>";
		$dom = new DomDocument('1.0', 'utf-8');
		if (isset($_GET['level'])){	
			$level = $_GET['level'];
			switch($level){
				case "phoneme":
					$EnqType = "Phone Me";
					$subject = "DSGAC - PHONE REQUEST";
					$OutputMessage .= "<p>Thank you for your phone call request. One of our sales agents will contact you shortly.</p><p>Please note that calls will be made within standard working hours only.</p>";
				break;
				case "custtest":
					$EnqType = "Customer Testimonial";
					$subject = "DSGAC - CUSTOMER TESTIMONIAL";
					$OutputMessage .= "<p>Testimonial Submitted</p>";
				break;
				case "getquote":
					$EnqType = "Get Quote";
					$subject = "DSGAC - QUOTE REQUEST";
					$OutputMessage .= "<p>Thank you for your quote request. Our sales team will process your quotation and contact you in due course.</p>";
				break;
				case "applyonline":
					$EnqType = "Apply Online";
					$subject = "DSGAC - ONLINE APPLICATION";
					$OutputMessage .= "<p>Thank you for taking the time to complete our online application form. Your details are now being processed and a member of our sales team will contact you soon to discuss the application.</p>";
					$style = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="http://www.dsgauto.com/AppOnline.xsl"');
					$dom->appendChild($style);
				break;
			}
		}
		else
		{
			$level = "contactus";
			$EnqType = "Customer Enquiry";
			$subject = "DSGAC - CUSTOMER ENQUIRY";
			$OutputMessage .= "<p>Thank you for your enquiry. Your comments are very important to us, and a member of our staff team will contact where necessary to discuss your comments further.</p>";
		}
		reset($_POST);
		$root = $dom->appendChild($dom->createElement("Enquiry"));
		$root->appendChild($dom->createAttribute("date"))->appendChild($dom->createTextNode($today));
		switch($level)
		{
			case "contactus":
			case "phoneme":
			case "custtest":
				$root->appendChild($dom->createElement("Type", $EnqType));
				while(list($strLabel,$strValue) = each ($_POST)){
					if ($strLabel != "Submit"){
						$root->appendChild($dom->createElement($strLabel, $strValue));
					}
				};
			break;
			case "getquote":			
				$root->appendChild($dom->createElement("Type", $EnqType));
				$root->appendChild($dom->createElement("FullName", $_POST['FullName']));
				$root->appendChild($dom->createElement("TelephoneDay", $_POST['TelephoneDay']));
				$root->appendChild($dom->createElement("EmailAddress", $_POST['EmailAddress']));
				if(isset($_POST['HowYouFoundUs']))
					$root->appendChild($dom->createElement("HowYouFoundUs", $_POST['HowYouFoundUs']));
				else
					$root->appendChild($dom->createElement("HowYouFoundUs", ""));
				if(isset($_POST['vehicleType']))
				{
					$VTYPE = $_POST['vehicleType'];
					$Car = true;
					switch($VTYPE)
					{
						case 'car': $Car = true; break;
						case 'van': $Car = false; break;
						default:;
					}
					if(isset($_POST['brandSelection']))
					{
						$brand = htmlspecialchars(str_replace('+', ' ', $_POST['brandSelection']));
						$root->appendChild($dom->createElement("BrandName", $brand));
					}
					if(isset($_POST['modelSelection']))
					{
						$model = htmlspecialchars(str_replace('+', ' ', $_POST['modelSelection']));
						$root->appendChild($dom->createElement("VehicleModel", $model));
					}
					if(isset($_POST['derivSelection']))
					{
						$deriv = '';	
		        $qryVehicle = mysql_query(getCapVehicle($Car, intval($_POST['derivSelection'])), $dbConnect);

	          if ($qryVehicle && mysql_num_rows($qryVehicle)) {
		          $vehicle = mysql_fetch_assoc($qryVehicle);
		          $deriv = $vehicle['derivative'];
		        }
						$root->appendChild($dom->createElement("VehicleSpec", $deriv));
					}
				}
				$root->appendChild($dom->createElement("Options", $_POST['vehicleOptions']));
				$root->appendChild($dom->createElement("FinanceType", $_POST['FinanceType']));
				$root->appendChild($dom->createElement("Term", $_POST['Term']));
				$root->appendChild($dom->createElement("MileagePA", $_POST['MileagePA']));
				$root->appendChild($dom->createElement("MonthlyBudget", $_POST['MonthlyBudget']));
				$comments = $_POST['Comments'];
				if(isset($_POST['financeMaintenance']))	{
					$comments .= "\n #Include maintenance package";
				}
				$credit = $_POST['financeCredit'];
				$decline = $_POST['financeDecline'];
				$comments .= "\n #Bad credit history? $credit";
				$comments .= "\n #Declined credit? $decline";
				$root->appendChild($dom->createElement("Comments", $comments));
			break;
			case "applyonline":
				### business
				if(isset($_POST['businessType'])){
					$root->appendChild($dom->createElement("Type", "Business"));
					$Business = $root->appendChild($dom->createElement("BusinessDetails"));
						$BusinessType = "";
						switch($_POST['businessType']) {
							case 'soleTrader':
								$BusinessType = "Sole Trader"; break;
							case 'partnership':
								$BusinessType = "Partnership"; break;
							case 'limitedCompany':
								$BusinessType = "Limited Company"; break;
						}
						$Business->appendChild($dom->createElement("BusinessType", $BusinessType));
						$Business->appendChild($dom->createElement("TradingName", $_POST['businessName']));
						$Business->appendChild($dom->createElement("TelephoneNo", $_POST['businessTelNo']));
						$Business->appendChild($dom->createElement("AddressLine1", $_POST['businessAddressA']));
						$Business->appendChild($dom->createElement("AddressLine2", $_POST['businessAddressB']));
						$Business->appendChild($dom->createElement("PostTown", $_POST['businessAddressC']));
						$Business->appendChild($dom->createElement("PostCode", $_POST['businessPostcode']));
						$Business->appendChild($dom->createElement("TradingSince", $_POST['businessTradingSince']));
						$Business->appendChild($dom->createElement("Nature", $_POST['businessNature']));
						$Business->appendChild($dom->createElement("NoOfEmployees", $_POST['businessEmployees']));
						$Business->appendChild($dom->createElement("AnnualBudget", $_POST['businessFinanceBudget']));
						$Business->appendChild($dom->createElement("VATNumber", $_POST['businessVATNo']));
						$Business->appendChild($dom->createElement("CompanyReg", $_POST['businessRegNo']));
					
					$applicants = $root->appendChild($dom->createElement("Applicants"));
					$designation = "";
					switch($_POST['businessType']) {
						case 'soleTrader':
							$designation = "Proprietor"; break;
						case 'partnership':
							$designation = "Partner"; break;
						case 'limitedCompany':
							$designation = "Director"; break;
					}
					$pattern1 = "/^addressA([0-9]+)-([0-9]+)$/";
					$numberOfApplicants = 0;
					$applicantsArray = array();
					reset($_POST);
					while(list($strLabel,$strValue) = each($_POST)){
						if(preg_match($pattern1, $strLabel, $apps))
						{
							$applicantArray[] = $apps[1];
						}
					}
					foreach($applicantArray as $Applicant)
					{
						$applicantAddressArray = array();
						$applicantJobArray = array();
						$pattern2 = "/^addressA".$Applicant."-([0-9]+)$/";
						$pattern3 = "/^jobEmpName".$Applicant."-([0-9]+)$/";
						reset($_POST);
						while(list($strLabel,$strValue) = each($_POST)){
							if(preg_match($pattern2, $strLabel, $Addresses))
							{
								$applicantAddressArray[] = $Addresses[1];
							}
							if(preg_match($pattern3, $strLabel, $Jobs))
							{
								$applicantJobArray[] = $Jobs[1];
							}
						}
						$applicant = $applicants->appendChild($dom->createElement("ApplicantDetails"));
						$applicant->appendChild($dom->createAttribute("ApplicantSequence"))->appendChild($dom->createTextNode($Applicant));
						$applicant->appendChild($dom->createAttribute("ApplicantDesignation"))->appendChild($dom->createTextNode($designation));
						$applicant->appendChild($dom->createElement("Title", $_POST["title$Applicant"]));
						$applicant->appendChild($dom->createElement("Forename", $_POST["foreName$Applicant"]));
						if(isset($_POST["middleName$Applicant"]))
							$applicant->appendChild($dom->createElement("Middlename", $_POST["middleName$Applicant"]));
						$applicant->appendChild($dom->createElement("Surname", $_POST["surName$Applicant"]));
						$applicant->appendChild($dom->createElement("DOB", $_POST["DOB$Applicant"]));
						$applicant->appendChild($dom->createElement("MaritalStatus", $_POST["maritalStatus$Applicant"]));
						$applicant->appendChild($dom->createElement("Telephone", $_POST["telNo$Applicant"]));
						if(isset($_POST["mobNo$Applicant"]))
							$applicant->appendChild($dom->createElement("Mobile", $_POST["mobNo$Applicant"]));
						$applicant->appendChild($dom->createElement("Email", $_POST["emailAddress$Applicant"]));
						if(count($applicantAddressArray) > 0)
						{
							$addresses = $applicant->appendChild($dom->createElement("Addresses"));
							foreach($applicantAddressArray as $Address)
							{
								$address = $addresses->appendChild($dom->createElement("AddressDetails"));
								$address->appendChild($dom->createAttribute("AddressSequence"))->appendChild($dom->createTextNode($Address));
								$address->appendChild($dom->createElement("AddressLine1", $_POST["addressA$Applicant-$Address"]));
								if(isset($_POST["addressB$Applicant-$Address"]))
									$address->appendChild($dom->createElement("AddressLine2", $_POST["addressB$Applicant-$Address"]));
								$address->appendChild($dom->createElement("PostTown", $_POST["addressC$Applicant-$Address"]));
								$address->appendChild($dom->createElement("PostCode", $_POST["postcode$Applicant-$Address"]));
								$address->appendChild($dom->createElement("AccommodationType", $_POST["accomType$Applicant-$Address"]));
								$address->appendChild($dom->createElement("YearsAtAddress", $_POST["addressYears$Applicant-$Address"]));
								$address->appendChild($dom->createElement("MonthsAtAddress", $_POST["addressMonths$Applicant-$Address"]));
							}
						}
						if(count($applicantJobArray) > 0)
						{
							$employments = $applicant->appendChild($dom->createElement("Employments"));
							foreach($applicantJobArray as $Job)
							{
								$employment = $employments->appendChild($dom->createElement("EmploymentDetails"));
								$employment->appendChild($dom->createAttribute("EmploymentSequence"))->appendChild($dom->createTextNode($Job));
								$employment->appendChild($dom->createElement("EmployerName", $_POST["jobEmpName$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("AddressLine1", $_POST["jobAddressA$Applicant-$Job"]));
								if(isset($_POST["jobAddressB$Applicant-$Job"]))
									$employment->appendChild($dom->createElement("AddressLine2", $_POST["jobAddressB$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("PostTown", $_POST["jobAddressC$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("PostCode", $_POST["jobPostcode$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("TelephoneNo", $_POST["jobTelNo$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("Occupation", $_POST["jobOccupation$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("OccupationBasis", $_POST["jobBasis$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("YearsEmployed", $_POST["jobYears$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("MonthsEmployed", $_POST["jobMonths$Applicant-$Job"]));
							}
						}
					}					
				}else{
				### personal
					$root->appendChild($dom->createElement("Type", "Personal"));
					$designation = "Applicant";
					$pattern1 = "/^addressA([0-9]+)-([0-9]+)$/";
					$numberOfApplicants = 0;
					$applicantsArray = array();
					reset($_POST);
					while(list($strLabel,$strValue) = each($_POST)){
						if(preg_match($pattern1, $strLabel, $apps))
						{
							$applicantArray[] = $apps[1];
						}
					}
					$applicants = $root->appendChild($dom->createElement("Applicants"));
					foreach($applicantArray as $Applicant)
					{
						$applicantAddressArray = array();
						$applicantJobArray = array();
						$pattern2 = "/^addressA".$Applicant."-([0-9]+)$/";
						$pattern3 = "/^jobEmpName".$Applicant."-([0-9]+)$/";
						reset($_POST);
						while(list($strLabel,$strValue) = each($_POST)){
							if(preg_match($pattern2, $strLabel, $Addresses))
							{
								$applicantAddressArray[] = $Addresses[1];
							}
							if(preg_match($pattern3, $strLabel, $Jobs))
							{
								$applicantJobArray[] = $Jobs[1];
							}
						}
						$applicant = $applicants->appendChild($dom->createElement("ApplicantDetails"));
						$applicant->appendChild($dom->createAttribute("ApplicantSequence"))->appendChild($dom->createTextNode($Applicant));
						$applicant->appendChild($dom->createAttribute("ApplicantDesignation"))->appendChild($dom->createTextNode($designation));
						$applicant->appendChild($dom->createElement("Title", $_POST["title$Applicant"]));
						$applicant->appendChild($dom->createElement("Forename", $_POST["foreName$Applicant"]));
						if(isset($_POST["middleName$Applicant"]))
							$applicant->appendChild($dom->createElement("Middlename", $_POST["middleName$Applicant"]));
						$applicant->appendChild($dom->createElement("Surname", $_POST["surName$Applicant"]));
						$applicant->appendChild($dom->createElement("DOB", $_POST["DOB$Applicant"]));
						$applicant->appendChild($dom->createElement("MaritalStatus", $_POST["maritalStatus$Applicant"]));
						$applicant->appendChild($dom->createElement("Telephone", $_POST["telNo$Applicant"]));
						if(isset($_POST["mobNo$Applicant"]))
							$applicant->appendChild($dom->createElement("Mobile", $_POST["mobNo$Applicant"]));
						$applicant->appendChild($dom->createElement("Email", $_POST["emailAddress$Applicant"]));
						if(count($applicantAddressArray) > 0)
						{
							$addresses = $applicant->appendChild($dom->createElement("Addresses"));
							foreach($applicantAddressArray as $Address)
							{
								$address = $addresses->appendChild($dom->createElement("AddressDetails"));
								$address->appendChild($dom->createAttribute("AddressSequence"))->appendChild($dom->createTextNode($Address));
								$address->appendChild($dom->createElement("AddressLine1", $_POST["addressA$Applicant-$Address"]));
								if(isset($_POST["addressB$Applicant-$Address"]))
									$address->appendChild($dom->createElement("AddressLine2", $_POST["addressB$Applicant-$Address"]));
								$address->appendChild($dom->createElement("PostTown", $_POST["addressC$Applicant-$Address"]));
								$address->appendChild($dom->createElement("PostCode", $_POST["postcode$Applicant-$Address"]));
								$address->appendChild($dom->createElement("AccommodationType", $_POST["accomType$Applicant-$Address"]));
								$address->appendChild($dom->createElement("YearsAtAddress", $_POST["addressYears$Applicant-$Address"]));
								$address->appendChild($dom->createElement("MonthsAtAddress", $_POST["addressMonths$Applicant-$Address"]));
							}
						}
						if(count($applicantJobArray) > 0)
						{
							$employments = $applicant->appendChild($dom->createElement("Employments"));
							foreach($applicantJobArray as $Job)
							{
								$employment = $employments->appendChild($dom->createElement("EmploymentDetails"));
								$employment->appendChild($dom->createAttribute("EmploymentSequence"))->appendChild($dom->createTextNode($Job));
								$employment->appendChild($dom->createElement("EmployerName", $_POST["jobEmpName$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("AddressLine1", $_POST["jobAddressA$Applicant-$Job"]));
								if(isset($_POST["jobAddressB$Applicant-$Job"]))
									$employment->appendChild($dom->createElement("AddressLine2", $_POST["jobAddressB$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("PostTown", $_POST["jobAddressC$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("PostCode", $_POST["jobPostcode$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("TelephoneNo", $_POST["jobTelNo$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("Occupation", $_POST["jobOccupation$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("OccupationBasis", $_POST["jobBasis$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("YearsEmployed", $_POST["jobYears$Applicant-$Job"]));
								$employment->appendChild($dom->createElement("MonthsEmployed", $_POST["jobMonths$Applicant-$Job"]));
							}
						}
					}
				}
				
				### Finance Details
				$finance = $root->appendChild($dom->createElement("FinanceDetails"));
					$financeType = $_POST['financeType'];
					if ($financeType == 'hire')
						$financeType = "Contract Hire";
					else
						$financeType = "Finance Lease";
					$finance->appendChild($dom->createElement("FinanceType", $financeType));
					$finance->appendChild($dom->createElement("Term", $_POST['financeTerm']));
					if (isset($_POST['financeMaintenance']))
						$finance->appendChild($dom->createElement("MaintenancePackage", "Yes"));
					else
						$finance->appendChild($dom->createElement("MaintenancePackage", "No"));
					$finance->appendChild($dom->createElement("MileagePerYear", $_POST['financeMileage']));
					$finance->appendChild($dom->createElement("MonthlyBudget", $_POST['financeBudget']));
					$finance->appendChild($dom->createElement("BadCreditHistory", $_POST['financeCredit']));
					$finance->appendChild($dom->createElement("CreditDeclined", $_POST['financeDecline']));
				
				### bank
				$bank = $root->appendChild($dom->createElement("BankDetails"));
					$bank->appendChild($dom->createElement("BankName", $_POST['bankName']));
					$bank->appendChild($dom->createElement("SortCode", $_POST['bankSortCode']));
					$bank->appendChild($dom->createElement("AccountNo", $_POST['bankAccNo']));
					$bank->appendChild($dom->createElement("YearsAtBank", $_POST['bankYears']));
				
				### vehicle
				$vehicle = $root->appendChild($dom->createElement("VehicleDetails"));
					$brandName = "";
					$modelName = "";
					$derivName = "";
					if(isset($_POST['vehicleType']))
					{
						$VTYPE = $_POST['vehicleType'];
						$Car = true;
						switch($VTYPE)
						{
							case 'car': 
								$Car = true;
								break;
							case 'van': 
								$Car = false;
								break;
							default:;
						}
						
						if(isset($_POST['brandSelection']))
						{
							$brand = htmlspecialchars(str_replace('+', ' ', $_POST['brandSelection']));
							$vehicle->appendChild($dom->createElement("Brand", $brand));
						}
						if(isset($_POST['modelSelection']))
						{
							$model = htmlspecialchars(str_replace('+', ' ', $_POST['modelSelection']));
							$vehicle->appendChild($dom->createElement("Model", $model));
						}
						if(isset($_POST['derivSelection']))
						{
							$deriv = '';
			        $qryVehicle = mysql_query(getCapVehicle($Car, intval($_POST['derivSelection'])), $dbConnect);

		          if ($qryVehicle && mysql_num_rows($qryVehicle)) {
			          $vehicleRst = mysql_fetch_assoc($qryVehicle);
			          $deriv = $vehicleRst['derivative'];
			        }
			
							$vehicle->appendChild($dom->createElement("Derivative", $deriv));
						}
						
					}
					$vehicle->appendChild($dom->createElement("Options", htmlspecialchars($_POST['vehicleOptions'])));
				
				  ### AdditionalInformation 
				  $addInfo = $root->appendChild($dom->createElement("AdditionalInformation"));
				  $addInfo->appendChild($dom->createElement("Notes", $_POST['infoComments']));
			
			break;
		}
		switch($level)
		{
			case "contactus":
			case "phoneme":
			case "custtest":
			case "getquote":		
				$dom->formatOutput = true;
				$blnSent = SendMail($DEFAULT_MAIL_FROM, $CONTACT_ENQUIRIES, $subject, $dom->saveXML(), $DEFAULT_SMTP_HOST, $DEFAULT_SMTP_USERNAME, $DEFAULT_SMTP_PASSWORD);
				$blnSent = SendMail($DEFAULT_MAIL_FROM, $DSG_XML, $subject, $dom->saveXML(), $DEFAULT_SMTP_HOST, $DEFAULT_SMTP_USERNAME, $DEFAULT_SMTP_PASSWORD);
				break;
			case "applyonline":
				$surname = "";
				if(is_string($_POST["surName1"]))
					$surname = $_POST["surName1"];
				else
					$surname = "NoneGiven";
				$dom->formatOutput = true;
				$blnSent = SendMailWithAttachment($DEFAULT_MAIL_FROM,$CONTACT_ENQUIRIES, "DSGAC_OnlineApp_".str_replace('/', '', $today)."_".$surname , $dom->saveXML(), $DEFAULT_SMTP_HOST, $DEFAULT_SMTP_USERNAME, $DEFAULT_SMTP_PASSWORD);
				break;
		}
		if (!$blnSent){
			$OutputMessage = "<h4>I'm sorry we seem to be having a problem submitting your details</h4><p>Please call us on $CONTACT_NUMBER</p>";
		}
	}
?>
	<div id="contactUsTop"><!-- --></div>
	<div id="contactUs">
		<?php echo $OutputMessage; ?>
	</div>
	<div class="clear"><!-- --></div>
	<div id="contactUsBottom"><!-- --></div>