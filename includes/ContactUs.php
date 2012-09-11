<script type="text/javascript" src="/javascript/formValidation.js"></script>

<!-- Xmas Opening Information
<p style="color: #FF0000; font-weight: bold;">2010 Christmas Opening Hours
<br /><br />
Please note that our office will close on the 24<sup>th</sup> December at <em>12:30</em> and
re-open on the 4<sup>th</sup> January at <em>09:00</em>.
<br /><br />
Any emails sent will be opened on our return.</p><br />-->
 
<h1>Contact Us</h1>
<div class="clearfix">
<div class="column-1">
<form id="Form" method="post" action="">
		<div id="contactDetails">				
			<label>Company Name</label>
				<input type="text" name="CompanyName" class="contactLine" value="" maxlength="255"/>
			<label>Contact Name</label>
				<input type="text" name="FullName" class="contactLine" value="" onblur="required(this, 'text');" maxlength="255"/>
				<span class="required" id="FullNameReq">*</span>
			<label>Telephone Number</label>
				<input type="text" name="Telephone" class="contactLine" value="" onblur="required(this, 'telNo');" maxlength="255"/>
				<span class="required" id="TelephoneReq">*</span>
			<label>Email Address</label>
				<input type="text" name="EmailAddress" class="contactLine" value="" onblur="required(this, 'email');" maxlength="255"/>
				<span class="required" id="EmailAddressReq">*</span>
			<label>Message</label>
				<textarea class="comments" name="Comments" rows="5" cols="25" onblur="required(this, 'text');"></textarea>
				<span class="required" id="CommentsReq">*</span>
		</div>

	<!--<a href="#" name="Submit" title="Send Message" class="submitButton" onclick="submitForm(); return false;">Send Message</a>-->
	<div id="contactSubmit"><input type="submit" class="submitButton" name="Submit" value="Submit" style="margin-left: 165px" /></div>
</form>
</div>
<div class="column-2">
<div class="contact_address">
<p>Please feel free to contact us at the address below, or send a comment in the form provided.</p>
<p>DSG Auto Contracts Ltd<br />Camelot House<br />Bredbury Park Way<br />Bredbury<br />Cheshire<br />SK6 2SN</p>
<p>Phone : <?php echo $CONTACT_NUMBER; ?><br />Fax : <?php echo $FAX_NUMBER; ?></p>
</div>
</div>
</div>