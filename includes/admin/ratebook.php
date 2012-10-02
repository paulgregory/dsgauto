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
			  if ($_FILES["ratebookFile"]['type'] !== 'text/csv') {
				  $error = 'Please upload a suitable CSV file.';
			  }
			  else {
				  $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . basename( $_FILES['ratebookFile']['name']);
					if(move_uploaded_file($_FILES['ratebookFile']['tmp_name'], $targetPath)) {
					  $fileUploaded = TRUE;
					  $_SESSION['uploadedFile'] = $targetPath;
					} else {
					  $error = 'There was an error uploading the file. Is the uploads folder writable?';
					}
			  }
			}
		}
		
		/*
		The CSV file should have these columns:
		  [0] => CAP_Id
		  [1] => CAP_Code
		  [2] => VehicleType
		  [3] => Manufacturer
		  [4] => Range
		  [5] => Model
		  [6] => Variant
		  [7] => ProductionStatus
		  [8] => P11D
		  [9] => CO2
		  [10] => BasicListPrice
		  [11] => Product
		  [12] => Term
		  [13] => Mileage
		  [14] => Advance
		  [15] => Deposit
		  [16] => DealerCode
		  [17] => FinanceRental
		  [18] => ServiceRental
		  [19] => EffectiveRentalValue
		  [20] => Balloon
		  [21] => ModelYear
		  [22] => BodyStyle
		  [23] => Doors
		  [24] => Seats
		  [25] => FuelType
		  [26] => TransmissionType
		  [27] => MPG
		  [28] => InsuranceGroup50
		  [29] => InsuranceGroup20
		*/
		if(isset($_POST['processSubmit']))
		{
			if (($handle = fopen($_SESSION['uploadedFile'], "r")) !== FALSE) {
				
				$dataSet = array();
				$headers = array();
				$linecount = 0;
				
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				  $linecount++;
			    
			    // Handle the first row (headers) separately
			    if ($linecount == 1) {
				    $headers = $data;
				    // count and check the columns to see if we're dealing with the correct CSV file
				    if (count($headers) != 30 || $headers[0] != 'CAP_Id' || $headers[6] != 'Variant' || $headers[9] != 'CO2' || $headers[17] != 'FinanceRental') {		
						  $error = 'This CSV file doesn\'t the expected columns. Is this the correct Ratebook CSV?';
						  break;
					  }
					  else {
						  mysql_query('TRUNCATE TABLE `tblratebook`');
						  if (mysql_error() != '') {				
							  $error = 'Error whilst deleting existing content ('.mysql_error().')';
							  break;
						  }
					  }
			    }
			    else {
				
				    // Bundle the data in to manageable dataset chunks for insert
					  $dataSet[] = '('.checkNum($data[0]).', "'.mysql_real_escape_string($data[1]).'", "'.mysql_real_escape_string($data[2]).'", "'.mysql_real_escape_string($data[3]).'", "'.mysql_real_escape_string($data[4]).'", "'.mysql_real_escape_string($data[5]).'", "'.mysql_real_escape_string($data[6]).'", "'.mysql_real_escape_string($data[7]).'", '.checkNum($data[8]).', '.checkNum($data[9]).', '.checkNum($data[10]).', "'.mysql_real_escape_string($data[11]).'", "'.mysql_real_escape_string($data[12]).'", '.checkNum($data[13]).', '.checkNum($data[14]).', '.checkNum($data[15]).', '.checkNum($data[16]).', '.checkNum($data[17]).', '.checkNum($data[18]).', '.checkNum($data[19]).', '.checkNum($data[20]).', "'.mysql_real_escape_string($data[21]).'", "'.mysql_real_escape_string($data[22]).'", '.checkNum($data[23]).', '.checkNum($data[24]).', "'.mysql_real_escape_string($data[25]).'", "'.mysql_real_escape_string($data[26]).'", '.checkNum($data[27]).', "'.mysql_real_escape_string($data[28]).'", "'.mysql_real_escape_string($data[29]).'")';
					  if (count($dataSet) == 200) {
						  $sql = 'INSERT INTO `tblratebook` (`CAP_Id`, `CAP_Code`, `VehicleType`, `Manufacturer`, `Range`, `Model`, `Variant`, `ProductionStatus`, `P11D`, `CO2`, `BasicListPrice`, `Product`, `Term`, `Mileage`, `Advance`, `Deposit`, `DealerCode`, `FinanceRental`, `ServiceRental`, `EffectiveRentalValue`, `Balloon`, `ModelYear`, `BodyStyle`, `Doors`, `Seats`, `FuelType`, `TransmissionType`, `MPG`, `InsuranceGroup50`, `InsuranceGroup20`) VALUES '."\n".implode(','."\n", $dataSet);
						  mysql_query($sql);
						  if (mysql_error() != '') {
							  $error = 'Error whilst inserting data in to database ('.mysql_error().')';
							  break;
						  }
						  $dataSet = array();
					  }
				  }
				}
				
				fclose($handle);
				
				$fileProcessed = (isset($error))? FALSE : TRUE;

	    }
	    else {
		    print 'Can\'t read file';
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

	  <?php elseif ($fileProcessed): ?>
  
    <h3>Data Imported</h3>
    <p>Imported <?php print $linecount -1; ?> rows.</p>  
    <p><a href="/administration.html">Return to admin menu</a></p>

	  <?php elseif ($fileUploaded): ?>
  
	  <h3>File Uploaded - Import Data?</h3> 

    <p><strong>Filename: <?php print $_FILES["ratebookFile"]['name']; ?></strong></p>
    <p>The CSV file has been successfully uploaded.</p>
    <p><strong style="color: red">WARNING: This will delete all current ratebook data and replace it with the contents of this file. This might take a few moments...</strong></p>

    <p><input type="submit" name="processSubmit" value="Import Data" onclick="$(this).val('...importing...');"> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a></p>

    <?php else: ?>
    
    <h3>Upload Ratebook CSV</h3>
	  <div style="margin: 0 0 15px 0">
      <div style="margin-bottom: 5px; font-weight: bold"><label for="ratebookFile">Ratebook CSV File (max file size <?php print ini_get('upload_max_filesize'); ?>egabytes)</label></div>
	    <input type="file" id="ratebookFile" name="ratebookFile" accept="text/csv" />	
    </div>  

  	<p><input type="submit" name="uploadSubmit" value="Upload File" onclick="$(this).val('...uploading...');" /> &nbsp;&nbsp;&nbsp;<a href="/administration.html">Cancel</a></p>
	
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