<?php
	if (isset($_GET['aURL']))
		$aURL = $_GET['aURL'];
	else
		$aURL = 0;

	$qryArticle = mysql_query(sqlArticle($aURL),$dbConnect);
	while ($rstArticle = mysql_fetch_array($qryArticle))
	{
		$strArticleBody = "";
		$strArticleBody .= "<h1>" . stripslashes($rstArticle["title"]) . "</h1>";
		if (isset($_SESSION['status']))
			if ($_SESSION['status'] == 'authenticated')
				$strArticleBody .= "<a id=\"adminEdit\" href=\"administration-article-$aURL.html\">Edit Article</a>";
		$strArticleBody .= stripslashes($rstArticle["body"]);
	}
?>
<div id="articleTop"><!-- --></div>
<div id="article">
	<?php echo $strArticleBody; ?>
</div>
<div class="clear"><!-- --></div>
<div id="articleBottom"><!-- --></div>