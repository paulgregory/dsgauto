<?PHP
$userip = ($_SERVER['REMOTE_ADDR']); 
$ip1 = '84.19.49.186';

if (($userip != $ip1)) {
header("Location:http://".$_SERVER['HTTP_HOST']."/goaway.php");
} else{
echo '&nbsp;';
}
?>
<title>DSGAC Car Image Editing - Updating</title>
<style type="text/css">
body {
	font-family: arial;
	background: url(/images/BodyBackground.gif) repeat-x #981016;
	color: white;
}
</style>
<?php
include('includes/dbConnect.php');

$id = $_POST["id"];
$name = $_POST["name"];
$small = $_POST["small"];
$large = $_POST["large"];

$sql="UPDATE `tblvehicleimages` SET `name` = '$name', `small` = '$small', `large` = '$large' WHERE `id`='$id'";
$result=mysql_query($sql);

// if successfully updated. 
if($result){
echo "Successfully updated. Click Go Back below to go back to the main image list.";
echo "<br /><br /><strong>PLEASE REMEMBER TO UPDATE THE IMAGE NAME IN FILEZILLA</strong.";
echo "<br /><br />";
echo "<a href='editimages.php'>Go Back</a>";
}

else {
echo "ERROR";
}

?>