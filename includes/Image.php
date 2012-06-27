<?php

	function putImage($qryImage, $ImageField)
	{

		$intImages = mysql_num_rows($qryImage);

		if($intImages)
		{
			$binData = mysql_result($qryImage,0,$ImageField);
			$strMimeType = "image/Gif";

			Header( "Content-type: $strMimeType");
			echo $binData;
			
		}
		else
		{
			echo "Image not found".$intImages;
		}

	}

?>