<script type="text/javascript" src="/javascript/formValidation.js"></script>
<p>Please leave your comments below:</p>
<form id="Form" method="post" action="">
	<fieldset>
		<legend>Send a Testimonial</legend>
		<div id="contactDetails">				
			<label>Company Name</label>
				<input type="text" name="CompanyName" class="contactLine" value="" maxlength="255"/>
			<label>Full Name</label>
				<input type="text" name="FullName" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="FullNameReq">*</span>
			<label>Telephone Number</label>
				<input type="text" name="Telephone" class="contactLine" value="" onblur="required(this, 'telNo');" maxlength="255"/>
				<span class="required" id="TelephoneReq">*</span>
			<label>Email Address</label>
				<input type="text" name="EmailAddress" class="contactLine" value="" onblur="required(this, 'email');" maxlength="255"/>
				<span class="required" id="EmailAddressReq">*</span>
			<label>Testimonial</label>
				<textarea class="comments" name="Comments" rows="5" cols="25" onblur="required(this, 'text');"></textarea>
				<span class="required" id="CommentsReq">*</span>
		</div>
	</fieldset>
	<a href="#" name="Submit" title="Submit Testimonial" class="submitTestimonial" onclick="submitForm(); return false;">Submit Testimonial</a>
</form>