<?php
function updateArticle($Title, $Body, $URL, $Description, $ID){
$updateArticle = 
"UPDATE 
	".TBL_ARTICLES."
SET 
	title = $Title, 
	body = $Body,
	url = $URL,
	description = $Description
WHERE 
	id=$ID";
}

function addArticle($Title, $Body, $URL, $Description){
$addArticle = 
"INSERT INTO
	".TBL_ARTICLES."
	(title, body, url, description)
VALUES
	($Title, $Body, $URL, $Description)";
return $addArticle;
}


?>