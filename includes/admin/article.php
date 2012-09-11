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
	<h1>Edit Article</h1>
	
	<form action="" method="post">

<?php 
		if (isset($worked))
		{
			if($worked)
				echo "<p><strong>Updated! <a href=\"/administration.html\">Return to admin menu</a></strong></p>";
			else
				echo "<p><strong>Oops! There was an error</strong></p>";
		}
		
		if (isset($aURL)){
?>  
    <div class="form-item">
		  <label>ID</label>
		  <input class="textBox" type="text" name="id" value="<?php if(isset($id)) echo stripslashes($id); ?>" size="5" />
		</div>
		<?php }?>
		<div class="form-item">
		  <label>URL</label>
		  <input class="textBox" type="text" name="url" value="<?php if(isset($url)) echo stripslashes($url); ?>" size="20" />
		</div>
		<div class="form-item">
		  <label>Title</label>
		  <input class="textBox" type="text" name="title" value="<?php if(isset($title)) echo stripslashes($title); ?>" size="20" />
		</div>
		<div class="form-item">
		  <label>Description</label>
		  <textarea class="textArea" name="description" rows="5" cols="80"><?php if(isset($description)) echo $description; ?></textarea>
		</div>
    <div class="form-item">
	  	<label>Body</label>
		  <textarea class="textArea" name="body" rows="40" cols="80"><?php if(isset($body)) echo $body; ?></textarea>
		</div>
		<div class="form-item">
		<?php if (isset($aURL)): ?>
  		<input type="submit" id="saveArticle" value="Save Article" name="saveArticle" /> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a>
		<?php elseif(!isset($_POST['saveArticle'])): ?>
		  <input type="submit" id="addNewArticle" value="Add Article" name="addNewArticle" /> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a>
		<?php endif; ?>
		</div>
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