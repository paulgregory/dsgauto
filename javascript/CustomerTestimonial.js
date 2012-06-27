<script type="text/javascript">
// Javascript function to validate required fields on PhoneMe Form - G.McDowell
function validForm(form){
	blnSuccess = true;   //Bool to Store Overall Form Validity Status
	error_log = "";    //Log Book to Store Errors

	//Code to Check values have been entered and email address has valid format
	if (form.FullName.value == "") {
		error_log = error_log + "- Full Name Required";
		blnSuccess = false;
	}

	if (form.EmailAddress.value == "") {
		error_log = error_log + "- Email Address Required";
		blnSuccess = false;
	}

	if (form.CompanyName.value == "") {
		error_log = error_log + "- Company Name Required";
		blnSuccess = false;
	}

	if (form.Make.value == "") {
		error_log = error_log + "- Vehicle make Required";
		blnSuccess = false;
	}

	if (form.Model.value == "") {
		error_log = error_log + "- Vehicle model Required";
		blnSuccess = false;
	}

	if (form.Testimonial.value == "") {
		error_log = error_log + "- Testimonial Required";
		blnSuccess = false;
	}

	if (blnSuccess == true) {return true;}
	else {
		alert("Please Re-Check the following fields: \" + error_log); 
		return false;
	}
}
</script>