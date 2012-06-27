<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		if(isset($_POST['submit']) && isset($_POST['imageName']) && !empty($_POST['imageName']))
		{
			$imageName = $_POST['imageName'];
			$imageLarge = $imageName . "_Large.png";
			$imageSmall = $imageName . "_Small.png";
			
			$query = mysql_query(addImage($imageSmall, $imageLarge, $imageName),$dbConnect);
			if($query)
				$strAdded = "Image Added";
		}
?>
<div id="administrationTop"></div>
<div id="administration">
<?php if(isset($strAdded)) echo $strAdded;?>
<form action="" method="post">
	<label>Image Name</label>
	<input type="text" name="imageName" value="" maxlength="100"/>
	<input type="submit" name="submit" value="Submit Image"/>
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