<?php
  function generateHeader($option)
  {//This Function Processes User-Unfriendly URL PRIOR to printing output to generate an appropriate Page Title
   //URL Processing involves Switch matching
   //Option can be : 1 = Return Page Header, 2 = Return Tab Bottom Half String
     include("dbConnect.php");
     switch ($option)
     {
      case 1 : //Full Page Header

           $Title = "";
           switch ($_GET['stype'])
                {
                  case "deals": //These can also include deal searches, but not particular deal
                   #$Title = $Title . "Car Leasing Deals (" . getFinanceTypeFromID($_GET['ftype']) . ")";
                   $Title = $Title . "Contract Hire and Leasing - Special Offers (" . getFinanceTypeFromID($_GET['ftype']) . ")";
                   //Check whether search terms have been incorporated
                   if (isset($_GET['etype'])) //A search has been initiated
                   {
                        switch($_GET['etype'])
                        {
                            case "brand":
                            $Title = $Title . " by Brand - " . str_replace("_", " ", $_GET['ekey']);
                            break;

                            case "term":
                            $CorrectTerm = str_replace("_"," ",$_GET['ekey']); //Remove Undescore from URL Variable
                            $Title = $Title . " by Term Length  - " . titlecase($CorrectTerm);
                            break;

                            case "price":
                            $Title = $Title . " by Monthly Price Range";
                            break;
                        }
                   }
                   break;

                  case "deal": //$_GET['did'] WILL BE SET, So Vehicle Data Can be retreved!!
                   //Retrieve Vehicle Info based on Deal ID value
                   $DealID = $_GET['did'];
                   $sqlGetDealTitle = "SELECT Concat(BrandName, ' ', VehicleModel, ' ', VehicleSpec) AS VehicleDesc, FinanceName
                                       FROM (tblBrand
                                       INNER JOIN tblVehicle ON tblBrand.BrandID = tblVehicle.BrandID)
                                       INNER JOIN tblDeal ON tblVehicle.VehicleCAPID = tblDeal.VehicleCAPID
                                       INNER JOIN tblFinance ON tblDeal.FinanceID = tblFinance.FinanceID
                                       WHERE (((tblDeal.DealID)=$DealID))";
                   $qryGetDealTitle = mysql_query($sqlGetDealTitle, $dbConnect);
                   $rstGetDealTitle = mysql_fetch_array($qryGetDealTitle);
                   $Title = $Title . "{$rstGetDealTitle['VehicleDesc']} ({$rstGetDealTitle['FinanceName']} Deal)";
                   break;

                  case "article":  //$_GET['aURL'] WILL BE SET, So Article Data Can be retrieved
                   $Title = $Title . "Information Zone";
                   //Retrieve Article Title based on aURL value
                   $articleURL = $_GET['aURL'];
                   $sqlGetArticleTitle = "SELECT ArticleTitle FROM tblArticle WHERE ArticleURL = '$articleURL'";
                   $qryGetArticleTitle = mysql_query($sqlGetArticleTitle, $dbConnect);
                   $rstGetArticleTitle = mysql_fetch_array($qryGetArticleTitle);
                   $Title = $Title . " - {$rstGetArticleTitle['ArticleTitle']}";
                   break;

                  case "contactus": //Generic "Contact New Car 4 Me" Header
                   $Title = $Title . "Contact Us";
                   if (isset($_GET['level'])) //if a particular type of contact has been called add extra title
                       {
                            switch ($_GET['level'])
                            {
                                case "phoneme":
                                      $Title .= " - Request a Call";
                                break;

                                case "custtest":
                                      $Title .= " - Submit Testimonial";
                                break;

                               case "getquote":
                                      $Title .= " - Get a Quote";
                                      if (isset($_GET['did']))
                                      { //Clicked through from deal, so show vehicle
                                        $DealID = $_GET['did'];
                                        $sqlGetDealTitle = "SELECT Concat(BrandName, ' ', VehicleModel) AS VehicleDesc, FinanceName
                                                              FROM (tblBrand
                                                              INNER JOIN tblVehicle ON tblBrand.BrandID = tblVehicle.BrandID)
                                                              INNER JOIN tblDeal ON tblVehicle.VehicleCAPID = tblDeal.VehicleCAPID
                                                              INNER JOIN tblFinance ON tblDeal.FinanceID = tblFinance.FinanceID
                                                              WHERE (((tblDeal.DealID)=$DealID))";
                                          $qryGetDealTitle = mysql_query($sqlGetDealTitle, $dbConnect);
                                          $rstGetDealTitle = mysql_fetch_array($qryGetDealTitle);
                                          $Title = $Title . " - {$rstGetDealTitle['VehicleDesc']} ({$rstGetDealTitle['FinanceName']})";
                                      }
                                break;

                                case "applyonline":
                                      $Title .= " - Online Application";
                                      if (isset($_GET['did']))
                                      { //Clicked through from deal, so show vehicle
                                        $DealID = $_GET['did'];
                                          $sqlGetDealTitle = "SELECT Concat(BrandName, ' ', VehicleModel) AS VehicleDesc, FinanceName
                                                              FROM (tblBrand
                                                              INNER JOIN tblVehicle ON tblBrand.BrandID = tblVehicle.BrandID)
                                                              INNER JOIN tblDeal ON tblVehicle.VehicleCAPID = tblDeal.VehicleCAPID
                                                              INNER JOIN tblFinance ON tblDeal.FinanceID = tblFinance.FinanceID
                                                              WHERE (((tblDeal.DealID)=$DealID))";
                                          $qryGetDealTitle = mysql_query($sqlGetDealTitle, $dbConnect);
                                          $rstGetDealTitle = mysql_fetch_array($qryGetDealTitle);
                                          $Title = $Title . " - {$rstGetDealTitle['VehicleDesc']} ({$rstGetDealTitle['FinanceName']})";
                                      }
                                break;
                            }
                       }
                   break;


                  case "sitemap":  //Generic "Site Map" Header
                   $Title = $Title . "Site Map";
                   break;
                  case "ratebook": //Generic Ratebook header
                   $Title = $Title . "Online Quoting Facility";
                   break;
                  case "ratebooklist":
                   $Title = $Title . "Models Available for Contract Hire Online Quoting";
           }//End Switch STYPE
           break;

      case 2 : //Tab Header
           switch ($_GET['stype'])
                {
                  case "deals": //These can also include deal searches, but not particular deal
                   $Title = "Special Offers";
                  //Check whether search terms have been incorporated
                  if (isset($_GET['etype'])) //A search has been initiated
                   {
                        switch($_GET['etype'])
                        {
                            case "brand":
                            $Title = str_replace("_", " ", $_GET['ekey']) . " Offers";
                            break;

                            case "term":
                            $CorrectTerm = str_replace("_"," ",$_GET['ekey']); //Remove Undescore from URL Variable
                            $CorrectTerm = str_replace("s","",$CorrectTerm);   // Remove 's' from MonthS.. to leave month
                            $Title = titlecase($CorrectTerm) . " Offers";
                            break;

                            case "price":
                            $Title = $Title . " by Budget";
                           break;




                        }
                   }
                   break;

                  case "deal": //$_GET['did'] WILL BE SET, So Vehicle Data Can be retreved!!
                   //Retrieve Vehicle Info based on Deal ID value
                   $DealID = $_GET['did'];
                   $sqlGetDealTitle = "SELECT Concat(BrandName, ' ', VehicleModel) AS VehicleDesc, FinanceName
                                       FROM (tblBrand
                                       INNER JOIN tblVehicle ON tblBrand.BrandID = tblVehicle.BrandID)
                                       INNER JOIN tblDeal ON tblVehicle.VehicleCAPID = tblDeal.VehicleCAPID
                                       INNER JOIN tblFinance ON tblDeal.FinanceID = tblFinance.FinanceID
                   WHERE (((tblDeal.DealID)=$DealID))";
                   $qryGetDealTitle = mysql_query($sqlGetDealTitle, $dbConnect);
                   $rstGetDealTitle = mysql_fetch_array($qryGetDealTitle);
                   $Title = $Title . "{$rstGetDealTitle['VehicleDesc']} Offer";
                   break;

                  case "article":  //$_GET['aURL'] WILL BE SET, So Article Data Can be retrieved
                   //Retrieve Article Title based on aURL value
                   $articleURL = $_GET['aURL'];
                   $sqlGetArticleTitle = "SELECT ArticleTitle FROM tblArticle WHERE ArticleURL = '$articleURL'";
                   $qryGetArticleTitle = mysql_query($sqlGetArticleTitle, $dbConnect);
                   $rstGetArticleTitle = mysql_fetch_array($qryGetArticleTitle);
                   $Title = $Title . "{$rstGetArticleTitle['ArticleTitle']}";
                   break;

                  case "contactus": //Note that Top half of Tab will show actual contact type... These bottom halfs should only show specific detail
                   if (isset($_GET['level'])) //if a particular type of contact has been called add extra title
                       {
                            switch ($_GET['level'])
                            {
                                case "phoneme":
                                      $Title .= "Customer Enquiry";
                                break;

                                case "getquote":
                                      if (isset($_GET['did']))
                                      { //Clicked through from deal, so show vehicle
                                          $DealID = $_GET['did'];
                                          $sqlGetDealTitle = "SELECT Concat(BrandName, ' ', VehicleModel) AS VehicleDesc, FinanceName
                                                              FROM (tblBrand
                                                              INNER JOIN tblVehicle ON tblBrand.BrandID = tblVehicle.BrandID)
                                                              INNER JOIN tblDeal ON tblVehicle.VehicleCAPID = tblDeal.VehicleCAPID
                                                              INNER JOIN tblFinance ON tblDeal.FinanceID = tblFinance.FinanceID
                                                              WHERE (((tblDeal.DealID)=$DealID))";
                                          $qryGetDealTitle = mysql_query($sqlGetDealTitle, $dbConnect);
                                          $rstGetDealTitle = mysql_fetch_array($qryGetDealTitle);
                                          $Title = $Title . "{$rstGetDealTitle['VehicleDesc']} Offer";
                                      }
                                      else
                                      {$Title .= "Now";}
                                break;

                                case "applyonline":
                                      if (isset($_GET['did']))
                                      { //Clicked through from deal, so show vehicle
                                          $DealID = $_GET['did'];
                                          $sqlGetDealTitle = "SELECT Concat(BrandName, ' ', VehicleModel) AS VehicleDesc, FinanceName
                                                              FROM (tblBrand
                                                              INNER JOIN tblVehicle ON tblBrand.BrandID = tblVehicle.BrandID)
                                                              INNER JOIN tblDeal ON tblVehicle.VehicleCAPID = tblDeal.VehicleCAPID
                                                              INNER JOIN tblFinance ON tblDeal.FinanceID = tblFinance.FinanceID
                                                              WHERE (((tblDeal.DealID)=$DealID))";
                                          $qryGetDealTitle = mysql_query($sqlGetDealTitle, $dbConnect);
                                          $rstGetDealTitle = mysql_fetch_array($qryGetDealTitle);
                                          $Title = $Title . "{$rstGetDealTitle['VehicleDesc']} Offer";
                                      }
                                      else
                                      {$Title .= "Form";}
                                break;

                                // customer testimonial tab header
                                case "custtest":
                                $Title .= "Submit Testimonial";
                                break;



                            }
                   }
                   else
                   {$Title .= "General Enquiries";}
                   break;

                  case "contact":   //Generic "Contact New Car 4 Me - Results" Header
                   $Title = $Title . "Contact Us - Results";
                   break;

                  case "sitemap":  //Generic "Site Map" Header
                   $Title = $Title . "Site Map";
                   break;
           }//End Switch STYPE
           break;
     }
     return $Title;
  }
?>