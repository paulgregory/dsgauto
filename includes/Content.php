<?php
	/*
	getArticle.php 		-- 	articles
	Deals.php 		 		--	front page special offers		
	getDeal.php				--	single deal
	getContact.php		--	contact form after submition
	getContactUs.php	--	contact form
	getSiteMap.php		--	site map
	*/
	if (isset($_GET['stype']))
	{
		switch ($_GET['stype'])
		{
			case "article":
				include("getArticle.php"); //done
				break;
			case "deals":
				include("Deals.php"); //done
				break;
			case "deal":
				include("Deal.php"); 
				break;
			case "specials";
				include("Specials.php");
				break;
			case "contactus":
				if (isset($_POST['Submit']) && !empty($_POST['Submit']))
					include("getContact.php"); 
				else
					include("getContactUs.php");
				break;
			case "sitemap":
				include ("SiteMap.php"); 
				break;
			case "vehiclesearch":
				include ("cap/searchResults.php");
				break;
			case "vehicledetails":
				include ("cap/vehicleDetails.php");
				break;
			default:;
		}
	}
	else
	{
		if (isset($_GET['admin']))
		{
			switch ($_GET['admin'])
			{
				case "login":
					include("admin/administration.php");
					break;
				case "articles":
					include ("admin/getArticles.php"); 
					break;
				case "article":
					include ("admin/article.php"); 
					break;
				case "deals":
					include ("admin/getDeals.php"); 
					break;
				case "deal":
					include ("admin/deal.php"); 
					break;
				case "cardata":
					include ("admin/getCarData.php"); 
					break;
				case "vandata":
					include ("admin/getVanData.php"); 
					break;
				case "images":
					include ("admin/addImage.php"); 
					break;
				case "testimonials":
					include ("admin/testimonials.php"); 
					break;
				case "ratebook":
					include ("admin/ratebook.php"); 
					break;	
				default:;
			}
		}
		else
			include("Deals.php"); 
	}	
?>