<div id="contactUsTop"><!-- --></div>
<div id="contactUs">
<?php
if (isset($_GET['level']))
{ //A particular Level has been set
	switch ($_GET['level'])
	{
		case "phoneme":
			include("includes/PhoneMe.php");
			break;
		case "getquote":
			include("includes/GetQuote.php");
			break;
		case "applyonline":
			include("includes/ApplyOnline.php");
			break;
		case "custtest":
			include("includes/CustomerTestimonial.php");
			break;
	}
}
else //Default to Basic Contact us, which detals our contact details and a basic comments contactbox
{
	include("includes/ContactUs.php");
}
?>
</div>
<div class="clear"><!-- --></div>
<div id="contactUsBottom"><!-- --></div>