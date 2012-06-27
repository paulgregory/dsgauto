<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
?>
<div id="administrationTop"></div>
<div id="administration">
<?php 
	$qryArticles = mysql_query($sqlGetArticles,$dbConnect);
	$strArticles = "";
	while ($rstArticles = mysql_fetch_array($qryArticles))
	{
		$articleTitle = $rstArticles['title'];
		$articleURL = $rstArticles['url'];
		$strArticles .= "<li><a href=\"/car_leasing-business-articles-$articleURL.html\">$articleTitle</a></li>";
	}
	echo "<ul>". $strArticles ."</ul>";
?>
<a href="/administration-article.html" id="addArticle">Add Article</a>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>