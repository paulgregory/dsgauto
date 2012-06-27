<form method="post" action="">
	<h2>Login <small>enter your credentials</small></h2>
	<p>
		<label>Username:</label>
		<input type="text" name="username" />
	</p>
	<p>
		<label>Password:</label>
		<input type="password" name="password" />
	</p>
	<p>
		<input type="submit" id="login" value="Login" name="submit" />
	</p>
</form>
<?php
if(isset($login)) 
	echo "<h4 class='alert'>" . $login . "</h4>";
?>