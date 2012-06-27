<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
 
 echo '<p>Hello World</p>'; 
 

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dsgac = "localhost";
$database_dsgac = "dsgac";
$username_dsgac = "dsg_dbo";
$password_dsgac = "contr@ct5";
$dsgac = mysql_pconnect($hostname_dsgac, $username_dsgac, $password_dsgac) or trigger_error(mysql_error(),E_USER_ERROR); 


	require_once('includes/setTitle.php');
 echo getTitle(); ?>
 
 </body>
</html>
