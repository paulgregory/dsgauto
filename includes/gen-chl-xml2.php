<?php
      //Generates XML File
      include("dbConnect.php");

      $FeedText = "[b][red]Contracthireandleasing.com -  BEST LUXURY CAR DEAL OF 2008 AWARD WINNER and BEST PERFORMANCE CAR DEAL OF 2008 AWARD WINNER[/red][/b] [b][blue]10 Reasons to Click Here[/blue][/b] - [b]We Are Good At What We Do[/b] / [b][red]Professional Service[/red][/b] / [b]Established 1988[/b] / [b][red]Competitive Low Rentals[/red][/b] / [b]New Business Funding Available[/b] / [b][red]Company Car Opt Out Specialist[/red][/b] / [b]Taxation Advice[/b] / [b][red]Official Agents of Major Finance Companies[/red][/b] / [b]Business and Personal Finance[/b] / [b][red]Simple Pricing - No Hidden Fees[/red][/b]. [b]Offer Based on 3+35 Payments, 10kpa and Exc. VAT[/b]. [b][blue]Call 0161 406 3936[/blue][/b]";

      #$sqlGetDeals = "SELECT * from tblCHLRateBook INNER JOIN tblBrand ON tblCHLRateBook.BrandID = tblBrand.BrandID WHERE term = 36 AND mileage = 8000 ORDER BY tblBrand.BrandName, VehicleModel, VehicleSpec";
      $sqlGetDeals = "SELECT * from tblCHLRateBook INNER JOIN tblBrand ON tblCHLRateBook.BrandID = tblBrand.BrandID WHERE term = 36 AND mileage = 10000 ORDER BY tblBrand.BrandName, VehicleModel, VehicleSpec";
      $qryGetDeals = mysql_query($sqlGetDeals, $dbConnect);

      //Create Output File
      $filename = "xml/camelot.xml";
      $fp = fopen($filename, "w");

      $write = fputs($fp, "<?xml version = \"1.0\" encoding=\"ISO-8859-1\" ?>\n<STOCK>");
      echo "<h3>Starting Export Process...</h3>\n";
      //Start Cars
      while ($rstGetDeals = mysql_fetch_array($qryGetDeals))
      {
         //For Each Vehicle, perform Replacement Lookup
         $strLookupReplacement = "SELECT * FROM `tblCarXMLReplacements` WHERE BrandID = {$rstGetDeals['brandID']} AND '{$rstGetDeals['VehicleModel']}' Like LookupModelSubstr AND '{$rstGetDeals['VehicleSpec']}' Like LookupVariantSubstr";
         $qryLookupReplacement = mysql_query($strLookupReplacement, $dbConnect);
         switch (mysql_num_rows($qryLookupReplacement))
         {
            case 1:
                     //Replacement found.. USE IT...
                     while ($rstLookupReplacement = mysql_fetch_array($qryLookupReplacement))
                     {
                          $ModelToUse = $rstLookupReplacement['DestinationModel'];
                     }
            break;

            default:
                    //No, or multiple replacements found.. use original
                    $ModelToUse = $rstGetDeals['VehicleModel'];
            break;
         }

         echo "<p>Vehicle : {$rstGetDeals['BrandName']} $ModelToUse {$rstGetDeals['VehicleSpec']}</p>";
         $price = round($rstGetDeals['rentalprice'],0);

         $variant = $rstGetDeals['VehicleSpec'];
        # $variant = str_replace("/","&#95;");

       #louis amendment
        $invalidXMLcharacters = array("&", "!", "(", ")", "[", "]", "'","/");
        $variant = str_replace($invalidXMLcharacters, " ",$variant);


         #$strOutput = "<VEHICLE><MAKE>{$rstGetDeals['BrandName']}</MAKE><MODEL>$ModelToUse</MODEL><VARIANT>$variant</VARIANT><DETAILS>The Business Finance Specialist. More Discount Contract Hire and Leasing Offers available at www.dsgauto.com. Are you looking for a genuine honest and relible online vehicle leasing company? Then call 08707 875418 for a tailored quote. (Offer based on 6+35 payments, 8kpa, Exc. VAT). 24 - 60 month business contract hire and finance lease deals available. For Personal Leasing Offers and Discounted Cash Sales vist www.newcar4me.com. </DETAILS><PRICEPERMONTH>$price</PRICEPERMONTH><COMMERCIAL>0</COMMERCIAL><AUTORENEW>0</AUTORENEW></VEHICLE>\n";
         $strOutput = "<VEHICLE><MAKE>{$rstGetDeals['BrandName']}</MAKE><MODEL>$ModelToUse</MODEL><VARIANT>$variant</VARIANT><DETAILS>$FeedText</DETAILS><PRICEPERMONTH>$price</PRICEPERMONTH><COMMERCIAL>0</COMMERCIAL><AUTORENEW>0</AUTORENEW></VEHICLE>\n";

         $write = fputs($fp, str_replace("£","&pound;",str_replace("&","&amp;", $strOutput)));
         #$write =fputs($fp, str_ireplace("/", "&#95;", $strOutput));


         //echo "$rstGetDeals['Manufacturer']},{$rstGetDeals['ModelShort']},{$rstGetDeals['DerivativeLong']},$CP\n";
         //Usleep(500000);
      }

      //Start Vans.
      $sqlGetDeals = "SELECT * from tblVanRateBook INNER JOIN tblVanBrand ON tblVanRateBook.BrandID = tblVanBrand.BrandID WHERE term = 36 AND mileage = 10000 ORDER BY tblVanBrand.BrandName, VehicleModel, VehicleSpec";
      $qryGetDeals = mysql_query($sqlGetDeals, $dbConnect);
      while ($rstGetDeals = mysql_fetch_array($qryGetDeals))
      {
        /*
         //For Each Vehicle, perform Replacement Lookup
         $strLookupReplacement = "SELECT * FROM `tblVanXMLReplacements` WHERE BrandID = {$rstGetDeals['brandID']} AND '{$rstGetDeals['VehicleModel']}' Like LookupModelSubstr AND '{$rstGetDeals['VehicleSpec']}' Like LookupVariantSubstr";
         $qryLookupReplacement = mysql_query($strLookupReplacement, $dbConnect);
         switch (mysql_num_rows($qryLookupReplacement))
         {
            case 1:
                     //Replacement found.. USE IT...
                     while ($rstLookupReplacement = mysql_fetch_array($qryLookupReplacement))
                     {
                          $ModelToUse = $rstLookupReplacement['DestinationModel'];
                     }
            break;

            default:
                    //No, or multiple replacements found.. use original

            break;
         }
         */
         $ModelToUse = $rstGetDeals['VehicleModel'];

         //echo "<p>Vehicle : {$rstGetDeals['BrandName']} $ModelToUse {$rstGetDeals['VehicleSpec']}</p>";
         $price = round($rstGetDeals['rentalprice'],0);

         //$strOutput = "<VEHICLE><MAKE>{$rstGetDeals['BrandName']}</MAKE><MODEL>$ModelToUse</MODEL><VARIANT>{$rstGetDeals['VehicleSpec']}</VARIANT><DETAILS>More Discount Contract Hire and Leasing Offers available at www.dsgauto.com, the UK's most honest online vehicle leasing specialists. Ready to order today? Call 08707 875418 for a tailored quote (3+47, 8kpa, Exc VAT) .  12, 24, 36 and 48 month business and personal contracts available from</a><PRICEPERMONTH>$price</PRICEPERMONTH><COMMERCIAL>1</COMMERCIAL><AUTORENEW>0</AUTORENEW></VEHICLE>\n";

         $variant = $rstGetDeals['VehicleSpec'];
        # $variant = str_replace("/","&#95;");

        #louis amendment
        $invalidXMLcharacters = array("&", "!", "(", ")", "[", "]", "'","/");
        $variant = str_replace($invalidXMLcharacters, " ",$variant);

         #$strOutput = "<VEHICLE><MAKE>{$rstGetDeals['BrandName']}</MAKE><MODEL>$ModelToUse</MODEL><VARIANT>$variant</VARIANT><DETAILS>The Business Finance Specialist. More Discount Contract Hire and Leasing Offers available at www.dsgauto.com. Are you looking for a genuine honest and relible online vehicle leasing company? Then call 08707 875418 for a tailored quote. (Offer based on 6+35 payments, 8kpa, Exc. VAT). 24 - 60 month business contract hire and finance lease deals available. For Personal Leasing Offers and Discounted Cash Sales vist www.newcar4me.com. </DETAILS><PRICEPERMONTH>$price</PRICEPERMONTH><COMMERCIAL>1</COMMERCIAL><AUTORENEW>0</AUTORENEW></VEHICLE>\n";
         $strOutput = "<VEHICLE><MAKE>{$rstGetDeals['BrandName']}</MAKE><MODEL>$ModelToUse</MODEL><VARIANT>$variant</VARIANT><DETAILS>[b][blue]10 Reasons to Click Here[/blue][/b] - [b]We Are Good At What We Do[/b] / [b][red]Professional Service[/red][/b] / [b]Established 1988[/b] / [b][red]Competitive Low Rentals[/red][/b] / [b]New Business Funding Available[/b] / [b][red]Company Car Opt Out Specialist[/red][/b] / [b]Taxation Advice[/b] / [b][red]Official Agents of Major Finance Companies[/red][/b] / [b]Business and Personal Finance[/b] / [b][red]Simple Pricing - No Hidden Fees[/red][/b].  [b]Offer Based on 3+35 Payments, 10kpa and Exc. VAT[/b]. [b][blue]Call 08707 875418[/blue][/b]</DETAILS><PRICEPERMONTH>$price</PRICEPERMONTH><COMMERCIAL>1</COMMERCIAL><AUTORENEW>0</AUTORENEW></VEHICLE>\n";

         $write = fputs($fp, str_replace("£","&pound;",str_replace("&","&amp;", $strOutput)));
         //echo "$rstGetDeals['Manufacturer']},{$rstGetDeals['ModelShort']},{$rstGetDeals['DerivativeLong']},$CP\n";
         //Usleep(500000);
      }


      // --------------------------------------------------------------------------------------------------


       //Start reading from the AUTORENEW table
      $sqlGetDeals = "SELECT * from tblCHLAutoRenew";
      $qryGetDeals = mysql_query($sqlGetDeals, $dbConnect);
      while ($rstGetDeals = mysql_fetch_array($qryGetDeals))
      {
         //For Each Vehicle, perform Replacement Lookup
         /*$strLookupReplacement = "SELECT * FROM `tblVanXMLReplacements` WHERE BrandID = {$rstGetDeals['brandID']} AND '{$rstGetDeals['VehicleModel']}' Like LookupModelSubstr AND '{$rstGetDeals['VehicleSpec']}' Like LookupVariantSubstr";
         $qryLookupReplacement = mysql_query($strLookupReplacement, $dbConnect);
         switch (mysql_num_rows($qryLookupReplacement))
         {
            case 1:
                     //Replacement found.. USE IT...
                     while ($rstLookupReplacement = mysql_fetch_array($qryLookupReplacement))
                     {
                          $ModelToUse = $rstLookupReplacement['DestinationModel'];
                     }
            break;

            default:
                    //No, or multiple replacements found.. use original
                    $ModelToUse = $rstGetDeals['VehicleModel'];
            break;
         }

          */

         //echo "<p>Vehicle : {$rstGetDeals['BrandName']} $ModelToUse {$rstGetDeals['VehicleSpec']}</p>";
         $ModelToUse = $rstGetDeals['Model'];
         $price = $rstGetDeals['PricePerMonth'];
         $notes = $rstGetDeals['DealNotes'];
         if ($rstGetDeals['Commercial'] == 0)
         {
            $Comm = 0;
         }
         else
         {
            $Comm = 1;
         }


         if ($rstGetDeals['AutoRenew'] == 0)
         {
            $AutoRen = 0;
         }
         else
         {
            $AutoRen = 1;
         }

                  $variant = $rstGetDeals['VehicleSpec'];
         #$variant = str_replace("/","&#95;");

        #louis amendment
        $invalidXMLcharacters = array("&", "!", "(", ")", "[", "]", "'","/");
        $variant = str_replace($invalidXMLcharacters, " ",$variant);

         $strOutput = "<VEHICLE><MAKE>{$rstGetDeals['Manufacturer']}</MAKE><MODEL>$ModelToUse</MODEL><VARIANT>$variant</VARIANT><DETAILS>$notes</DETAILS><PRICEPERMONTH>$price</PRICEPERMONTH><COMMERCIAL>$Comm</COMMERCIAL><AUTORENEW>$AutoRen</AUTORENEW></VEHICLE>\n";
         $write = fputs($fp, str_replace("£","&pound;",str_replace("&","&amp;", $strOutput)));
         //echo "$rstGetDeals['Manufacturer']},{$rstGetDeals['ModelShort']},{$rstGetDeals['DerivativeLong']},$CP\n";
         //Usleep(500000);
      }

     // ---------------------------------------------------------------------------------------------------


      echo "<h3>Export Done</h3>";
      $write = fputs($fp, "</STOCK>");

      fclose($fp);
?>