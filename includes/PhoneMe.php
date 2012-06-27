<script type="text/javascript" src="/javascript/formValidation.js"></script>
<p>Unsure about leasing, or you'd simply like to discuss your options? Please fill in your details below and we will call you.</p>
<form id="Form" method="post" action="">
	<fieldset>
		<legend>Request a Call</legend>
		<div id="contactDetails">				
			<label>Full Name</label>
				<input type="text" name="FullName" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="FullNameReq">*</span>
			<label>Telephone Number</label>
				<input type="text" name="Telephone" class="contactLine" value="" onblur="required(this, 'telNo');" maxlength="15"/>
				<span class="required" id="TelephoneReq">*</span>
			<label>Regarding</label>
				<textarea class="comments" name="Comments" rows="5" cols="25" onblur="required(this, 'text');"></textarea>
				<span class="required" id="CommentsReq">*</span>
		</div>
	</fieldset>
	<a href="#" name="Submit" title="Request Call" class="submitButton" onclick="submitForm(); return false;">Request Call</a>
</form>