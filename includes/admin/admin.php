<?php
class Admin {
	
	function confirmUser($username, $password){
		include('dbConnect.php');
	
		$q = "SELECT * FROM ".TBL_USERS." WHERE username = '$username' LIMIT 1";
		$result = mysql_query($q,$dbConnect);
		
		$dbarray = mysql_fetch_array($result);
		$pwd = sha1($password);
		
		if($dbarray['password'] == $pwd){
			return true; 
		}
		else{
			return false; 
		}
	}

	
	function login($uname, $pwd){
		if ($this->confirmUser($uname, $pwd)){
			$_SESSION['status'] = 'authenticated';
		}
		else{
			return "<p>Please enter a correct username and password</p>";
		}
		
	}
	
	function logout(){
		if (isset($_SESSION['status']))
		{
			unset($_SESSION['status']);
			session_destroy();
		}
	}
}
?>