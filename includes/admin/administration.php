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
			<ul>
				<li><a href="/administration-articles.html" title="Articles">Articles</a></li>
				<li><a href="/administration-deals.html" title="Deals">Deals</a></li>
				<li><a href="/administration-cardata.html" title="Car Data">Car Data</a></li>
				<li><a href="/administration-images.html" title="Images">Images</a></li>
				<li><a href="/administration-testimonials.html" title="Testimonials">Testimonials</a></li>
			</ul>
			<form method="post" action="">
				<input type="submit" id="logout" value="Logout" name="logout">
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