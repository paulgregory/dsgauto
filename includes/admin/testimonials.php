<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		if(isset($_POST['submit']))
		{
			$testimonial = stripslashes($_POST['testimonial']);
			$vehicle = stripslashes($_POST['vehicle']);
			$name = stripslashes($_POST['name']);
			$qryTest = mysql_query(addTestimonial($name, $vehicle, $testimonial), $dbConnect);
			if($qryTest)
				$strAdded = "<h1>Testimonial Added</h1>";
		}
?>
<div id="administrationTop"></div>
<div id="administration">
<?php 
if(!isset($strAdded))
{
	
?>
<form action="" method="post">
	<fieldset><legend>Add a testimonial</legend>
	<label>Name</label>
	<input type="text" name="name" value="" maxlength="100"/><br/>
	<label>Vehicle</label>
	<input type="text" name="vehicle" value="" maxlength="100"/><br/>
	<label>Comment</label>
	<textarea name="testimonial" cols="25" rows="15"></textarea><br/>
	<input type="submit" name="submit" value="Add testimonial"/>
	</fieldset>
</form>
<?php
}
else {
	echo $strAdded;
}
?>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>