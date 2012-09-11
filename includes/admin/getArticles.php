<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
?>
<div id="administrationTop"></div>
<div id="administration">
	<h1>Manage Articles</h1>
	
	<p><a href="/administration-article.html" id="addArticle">Add Article</a></p>
	
<?php 
	$qryArticles = mysql_query($sqlGetArticles,$dbConnect);
	$strArticles = "";
	while ($rstArticles = mysql_fetch_array($qryArticles))
	{
		$articleTitle = $rstArticles['title'];
		$articleURL = $rstArticles['url'];
		$strArticles .= "<li><a href=\"/car_leasing-business-articles-$articleURL.html\">$articleTitle</a></li>";
	}
	echo "<ul class=\"admin-list\">". $strArticles ."</ul>";
?>

<p><strong><a href="/administration.html">Return to admin menu</a></strong></p>

</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>