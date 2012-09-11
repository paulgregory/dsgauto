<div id="administrationTop"></div>
<div id="administration">
<?php 	
	if($_POST && !empty($_POST['username']) && !empty($_POST['password'])){
		require_once("includes/admin/admin.php");
		$admin = new Admin();
		$login = $admin->login($_POST['username'], $_POST['password']);
	}
		
	if (isset($_SESSION['status']) && $_SESSION['status'] == 'authenticated')
	{	
		if (isset($_POST['logout']))
		{
			include('admin/admin.php');
			$admin = new Admin();
			$logout = $admin->logout();
			include('login.php');
		}
		else {
?>
      <h1>DSG Administration</h1>
			<ul class="admin-options">
				<li><a href="/administration-ratebook.html" title="Upload Ratebook">Upload New Ratebook &raquo;</a></li>
				<li><a href="/administration-articles.html" title="Articles">Articles &raquo;</a></li>
				<li><a href="/administration-deals.html" title="Deals">Deals &raquo;</a></li>
				<li><a href="/administration-cardata.html" title="Car Data">Car Data &raquo;</a></li>
				<li><a href="/administration-images.html" title="Images">Images &raquo;</a></li>
				<li><a href="/administration-testimonials.html" title="Testimonials">Testimonials &raquo;</a></li>
			</ul>
			<form method="post" action="">
				<p><input type="submit" id="logout" value="Logout" name="logout"></p>
			</form>
<?php
		}
	} 
	else {
		include('login.php');
	} 
?>
</div>
<div id="administrationBottom"></div>