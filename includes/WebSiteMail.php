<?php

require_once("Mail.php");

function SendMail($from, $to, $subject = "", $message = "", $SMTPHost = "", $SMTPUsername = "", $SMTPPassword = "") {
	$headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
	$smtp = Mail::factory('smtp', array ('host' => $SMTPHost, 'auth' => false, 'username' => $SMTPUsername, 'password' => $SMTPPassword));
	$mail = $smtp->send($to, $headers, $message);
	
	//print '<pre>';
	//print_r($mail);
	//print '</pre>';
	
	if (PEAR::isError($mail)) {
		return false;
	} else {
		return true;
	}

}

##to do for apply online
function SendMailWithAttachment($from, $to, $subject = "", $message = "", $SMTPHost = "", $SMTPUsername = "", $SMTPPassword = "", $date) {
	$headers = array ('From' => $from,'To' => $to,'Subject' => $subject, 'Content-Type' => "xml", 'filename' => "AppOnline.xml");
	$smtp = Mail::factory('smtp', array ('host' => $SMTPHost, 'auth' => false, 'username' => $SMTPUsername, 'password' => $SMTPPassword));
	$mail = $smtp->send($to, $headers, $message);
	
	if (PEAR::isError($mail)) {
		return false;
	} else {
		return true;
	}

}