<?PHP
$userip = ($_SERVER['REMOTE_ADDR']); 
$ip1 = '84.19.49.186';

if (($userip != $ip1)) {
header("Location:http://".$_SERVER['HTTP_HOST']."/goaway.php");
} else{
echo '&nbsp;';
}
?>
<title>DSGAC Car Image Editing - Delete</title>
<style type="text/css">
body {
	font-family: arial;
	background: url(/images/BodyBackground.gif) repeat-x #981016;
	color: white;
}
</style>
<?php
include('includes/dbConnect.php');

$id=$_GET['id'];
 
$sql="SELECT * FROM `tblvehicleimages` WHERE id='$id'";
$result=mysql_query($sql);

$rows=mysql_fetch_array($result);
?>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<form name="form1" method="post" action="delete_ac.php">
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td colspan="3"><strong>Deleting Car Image</strong> </td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center"><strong>Small Name</strong></td>
<td align="center"><strong>Large Name</strong></td>
<td align="center"><strong>Name</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="center"><input disabled name="small" type="text" value="<?php echo $rows['small'];?>" size="30"></td>
<td align="center"><input disabled name="large" type="text" value="<?php echo $rows['large'];?>" size="30"></td>
<td align="center"><input disabled name="name" type="text" value="<?php echo $rows['name']; ?>" size="30"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" id="id" value="<?php echo $rows['id']; ?>"></td>
<td align="center"><input type="submit" name="Submit" value="DELETE"><br /><strong>THIS CANNOT BE UNDONE!</strong>
</td>
<td>&nbsp;</td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<?

// close connection 
mysql_close();

?>