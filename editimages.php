<?PHP
$userip = ($_SERVER['REMOTE_ADDR']); 
$ip1 = '84.19.49.186';

if (($userip != $ip1)) {
header("Location:http://".$_SERVER['HTTP_HOST']."/goaway.php");
} else{
echo '&nbsp;';
}
?>
<title>DSGAC Car Image Editing</title>
<style type="text/css">
body {
	font-family: arial;
	background: url(/images/BodyBackground.gif) repeat-x #981016;
	color: white;
}
?>
</style>
<?php

include('includes/dbConnect.php');

$sql="SELECT * FROM `tblvehicleimages`";
$result=mysql_query($sql);
?>
<img src="/images/logo3.png" /><br /><br />
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>
<table width="400" border="1" cellspacing="0" cellpadding="3">
<tr>
<td colspan="6"><strong>Car Image Editing</strong> </td>
</tr>

<tr>
<td align="center"><strong>ID</strong></td>
<td align="center"><strong>Small Name</strong></td>
<td align="center"><strong>Large name</strong></td>
<td align="center"><strong>Name</strong></td>
<td align="center"><strong>Update</strong></td>
<td align="center"><strong>Delete</strong></td>

</tr>
<?php
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td><?php echo $rows['id']; ?></td>
<td><?php echo $rows['small']; ?></td>
<td><?php echo $rows['large']; ?></td>
<td><?php echo $rows['name']; ?></td>

<td align="center"><input type="submit" value="Update" onclick="window.location='update.php?id=<?php echo $rows['id']; ?>'"></td>
<td align="center"><input type="submit" value="Delete" onclick="window.location='delete.php?id=<?php echo $rows['id']; ?>'"></td>
</tr>
<?php
}
?>
</table>
</td>
</tr>
</table>
<?php
mysql_close();
?>
