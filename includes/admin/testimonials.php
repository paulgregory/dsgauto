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
<h1>Add a testimonial</h1>
<div id="administrationTop"></div>
<div id="administration">
<?php 
if(!isset($strAdded))
{
	
?>
<form action="" method="post">
  <div class="form-item">
	<label>Name</label>
	<input type="text" name="name" value="" maxlength="100"/>
	</div>
	<div class="form-item">
	<label>Vehicle</label>
	<input type="text" name="vehicle" value="" maxlength="100"/>
	</div>
	<div class="form-item">
	<label>Comment</label>
	<textarea name="testimonial" cols="25" rows="15"></textarea>
	</div>
	<div class="form-item">
	<input type="submit" name="submit" value="Add testimonial"/>
  </div>
</form>
<?php
}
else {
	echo $strAdded;
}
?>
</div>
<div id="administrationBottom"></div>
<p><strong><a href="/administration.html">Return to admin menu</a></strong></p>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>