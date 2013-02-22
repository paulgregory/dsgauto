<?php

$fileUploaded = FALSE;
$fileProcessed = FALSE;

// Check if a given numeric field is a valid float or int and return NULL if not
function checkNum($fieldValue) {
	if (!floatval($fieldValue) && !intval($fieldValue)) {
		return 'NULL';
	}
	else {
		return $fieldValue;
	}
}

if (isset($_SESSION['status']))
{
	if ($_SESSION['status'] == 'authenticated')
	{
		
		if(isset($_POST['uploadSubmit']))
		{
						
			if ($_FILES["ratebookFile"]["error"] > 0) {
			  $error = 'There was an error uploading the file.';
			}
			else {
			  if ($_FILES["ratebookFile"]['type'] !== 'text/csv' && $_FILES["ratebookFile"]['type'] !== 'text/plain') {
				  $error = 'Please upload a suitable CSV file.';
			  }
			  else {
				  $handle = fopen($_FILES['ratebookFile']['tmp_name'], "r");
				  $headers = fgetcsv($handle, 1, ",");
			    // count and check the columns to see if we're dealing with the correct CSV file
			    if (count($headers) != 30 || $headers[0] != 'CAP_Id' || $headers[6] != 'Variant' || $headers[9] != 'CO2' || $headers[17] != 'FinanceRental') {	
					  $error = 'This CSV file doesn\'t contain the expected columns. Is this the correct Ratebook CSV?';
					  break;
				  }
				  else {
					  // Empty the ratebook table before import
					  mysql_query('TRUNCATE TABLE `tblratebook`');
						if (mysql_error() != '') {				
						  $error = 'Error whilst deleting existing content ('.mysql_error().')';
							break;
						}

					  // Import the csv contents
					  $linecount = 0;
						$loadsql = 'LOAD DATA LOCAL INFILE "'.$_FILES['ratebookFile']['tmp_name'].'" INTO TABLE tblratebook FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY """" LINES TERMINATED BY "\r" IGNORE 1 LINES';

						if (!mysql_query($loadsql)) {
							$error = 'There was an error importing the CSV ('.mysql_error().')';
						}
						else {
							// Get the number of rows in the table after import
							$result = mysql_query('SELECT COUNT(*) FROM `tblratebook`');
			        $row = mysql_fetch_array($result);
			        $linecount = $row[0];
							$fileProcessed = TRUE;
						}
  				}
			  }
			}
		}

    if (isset($_POST['processSubmit'])) {
	
			// Empty the ratebook table before import
		  mysql_query('TRUNCATE TABLE `tblratebook`');
			if (mysql_error() != '') {				
			  $error = 'Error whilst deleting existing content ('.mysql_error().')';
				break;
			}
		
		  // Import the csv contents
		  $linecount = 0;
			$loadsql = 'LOAD DATA LOCAL INFILE "'.$_SESSION['uploadedFile'].'" INTO TABLE tblratebook FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY """" LINES TERMINATED BY "\r" IGNORE 1 LINES';

			if (!mysql_query($loadsql)) {
				$error = 'There was an error importing the CSV ('.mysql_error().')';
			}
			else {
				// Get the number of rows in the table after import
				$result = mysql_query('SELECT COUNT(*) FROM `tblratebook`');
        $row = mysql_fetch_array($result);
        $linecount = $row[0];
				$fileProcessed = TRUE;
			}

	  }
?>
<div id="administrationTop"></div>
<div id="administration">
	
	<h1>Upload New Ratebook</h1>
	<form action="" method="post" enctype="multipart/form-data">

   
    <?php if (isset($error)): ?>
	  <h3>ERROR!</h3>
	  <?php print '<p><strong>'.$error.'</strong></p>'; ?>
	  <p><a href="/administration-ratebook.html">Try again</a></p>
	
	  <?php elseif ($fileUploaded): ?>

    <h3>File Uploaded - Import Data?</h3> 

    <p><strong>Filename: <?php print $_FILES["ratebookFile"]['name']; ?></strong></p>
    <p>The CSV file has been successfully uploaded.</p>
    <p><strong style="color: red">WARNING: This will delete all current ratebook data and replace it with the contents of this file. This might take a few moments...</strong></p>

    <p><input type="submit" name="processSubmit" value="Import Data" onclick="$(this).val('...importing...');"> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a></p>

	  <?php elseif ($fileProcessed): ?>
  
    <h3>Data Imported</h3>
    <p>Success! <?php print $linecount -1; ?> rows imported.</p>  
    <p><a href="/administration.html">Return to admin menu</a></p>

    <?php else: ?>
    
    <h3>Upload Ratebook CSV</h3>
	  <div style="margin: 0 0 15px 0">
      <div style="margin-bottom: 5px; font-weight: bold"><label for="ratebookFile">Ratebook CSV File (max file size <?php print ini_get('upload_max_filesize'); ?>egabytes)</label></div>
	    <input type="file" id="ratebookFile" name="ratebookFile" accept="text/csv" />	
    </div>  

<p><strong style="color: red">WARNING: This will delete all current ratebook data and replace it with the contents of this file. This might take a few moments...</strong></p>

  	<p><input type="submit" name="uploadSubmit" value="Import CSV" onclick="$(this).val('Processing...');" /> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a></p>
	
	  <?php endif; ?>
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