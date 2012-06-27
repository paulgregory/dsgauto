<?php
if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		if (isset($_POST['addNewArticle']))
		{
			$worked = false;
			if(!get_magic_quotes_gpc())
			{
				$title = addslashes($_POST["title"]);
				$url = addslashes($_POST["url"]);
				$description = addslashes($_POST["description"]);
				$body = addslashes($_POST["body"]);
			}
			$update = mysql_query(addArticle($title, $body, $url, $description), $dbConnect);
			if ($update)
			{
				$aURL = $url;
				$worked = $update;
				$qryArticle = mysql_query(sqlArticle($aURL),$dbConnect);
				$rstArticle = mysql_fetch_array($qryArticle);
				$id = $rstArticle["id"];
			}
		}
		if (isset($_POST['saveArticle']))
		{
			$worked = false;
			if(!get_magic_quotes_gpc())
			{
				$id = addslashes($_POST["id"]);
				$title = addslashes($_POST["title"]);
				$url = addslashes($_POST["url"]);
				$description = addslashes($_POST["description"]);
				$body = addslashes($_POST["body"]);
			}
			$update = mysql_query(updateArticle($title, $body, $url, $description, $id), $dbConnect);
			if ($update)
				$worked = $update;
		}
		if (isset($_GET['aURL']))
		{
			$aURL = $_GET['aURL'];
			$qryArticle = mysql_query(sqlArticle($aURL),$dbConnect);
			$rstArticle = mysql_fetch_array($qryArticle);
			$id = $rstArticle["id"];
			$title = $rstArticle["title"];
			$url = $rstArticle["url"];
			$description = $rstArticle["description"];
			$body = $rstArticle["body"];
		}
?>
<div id="administrationTop"></div>
<div id="administration">
	<form action="" method="post">
<?php 
		if (isset($worked))
		{
			if($worked)
				echo "<h1 class=\"update\">Updated</h1>";
			else
				echo "<h1 class=\"update\">Oops</h1>";
		}
		
		if (isset($aURL)){
?>
		<label>ID</label>
		<input class="textBox" type="text" name="id" value="<?php if(isset($id)) echo stripslashes($id); ?>" size="5" />
		<?php }?>
		<label>URL</label>
		<input class="textBox" type="text" name="url" value="<?php if(isset($url)) echo stripslashes($url); ?>" size="20" />
		<label>Title</label>
		<input class="textBox" type="text" name="title" value="<?php if(isset($title)) echo stripslashes($title); ?>" size="20" />
		<label>Description</label>
		<textarea class="textArea" name="description" rows="5" cols="80"><?php if(isset($description)) echo $description; ?></textarea>
		<label>Body</label>
		<textarea class="textArea" name="body" rows="40" cols="80"><?php if(isset($body)) echo $body; ?></textarea>
		<?php
			if (isset($aURL)){
		?>
		<input type="submit" id="saveArticle" value="Save Article" name="saveArticle" />
		<?php
			}
			if (!isset($aURL) && !isset($_POST['saveArticle'])){
		?>
		<input type="submit" id="addNewArticle" value="Add Article" name="addNewArticle" />
		<?php } ?>
	</form>
</div>
<div id="administrationBottom"></div>
<?php
	}
}
else{
	include('admin/administration.php');
}
?>