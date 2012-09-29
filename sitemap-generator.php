<?php
$count = 0;

function sitemapEntry($url, $lastmod = NULL, $changefreq = 'monthly', $prioty = '0.5') {
	global $count;
	$count++;
	
	if ($lastmod == NULL) {
		$lastmod = date("Y-m-j", strtotime("-1 month"));
	}
	
	$xml = 
	"<url>"."\n".
	"<loc>$url</loc>"."\n".
	"<lastmod>$lastmod</lastmod>"."\n".
	"<changefreq>$changefreq</changefreq>"."\n".
	"<priority>$prioty</priority>"."\n".
	"</url>"."\n";
	
	return $xml;
}

$yesterday = date("Y-m-j", strtotime("-1 day"));
$lastWeek = date("Y-m-j", strtotime("-1 week"));
$lastMonth = date("Y-m-j", strtotime("-1 month"));

header('Content-Type: text/xml');
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\n".
      "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">"."\n";


// List 'static' pages
print sitemapEntry('http://www.dsgauto.com/', $lastWeek, 'weekly', '1');
print sitemapEntry('http://www.dsgauto.com/car_leasing-special-offers.html', $lastWeek, 'weekly', '0.8');
print sitemapEntry('http://www.dsgauto.com/blog/', $yesterday, 'daily', '0.9');
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-articles-which_finance_package.html', $lastMonth);
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-apply_online-business.html', $lastMonth);
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-articles-testimonials.html', $lastMonth);
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-get_quote.html', $lastMonth);
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-contact_us.html', $lastMonth);
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-articles-meet_the_team.html', $lastMonth);
print sitemapEntry('http://www.dsgauto.com/car_leasing-business-articles-about_us.html', $lastMonth);


// Automatically list urls of search pages
require_once('includes/constants.php');
require_once('includes/sql.php');
require_once('includes/dbConnect.php');

$qryCarBrandModels = mysql_query(enabledBrandModels('car'), $dbConnect);
$qryVanBrandModels = mysql_query(enabledBrandModels('van'), $dbConnect);

if ($qryCarBrandModels) {
	while ($row = mysql_fetch_array($qryCarBrandModels)) {
		// business search
		$url = search_page_url($row['brand'], $row['model'], $vtype = 'car', $finance = 'business');
		print sitemapEntry('http://www.dsgauto.com/'.$url, $lastMonth);
		// personal search
		$url = search_page_url($row['brand'], $row['model'], $vtype = 'car', $finance = 'personal');
		print sitemapEntry('http://www.dsgauto.com/'.$url, $lastMonth);
	}
}

if ($qryVanBrandModels) {
	while ($row = mysql_fetch_array($qryVanBrandModels)) {
		// business search
		$url = search_page_url($row['brand'], $row['model'], $vtype = 'van', $finance = 'business');
		print sitemapEntry('http://www.dsgauto.com/'.$url, $lastMonth);
		// personal search
		$url = search_page_url($row['brand'], $row['model'], $vtype = 'van', $finance = 'personal');
		print sitemapEntry('http://www.dsgauto.com/'.$url, $lastMonth);
	}
}

// Deal pages
$qryDeal = mysql_query(sqlGetDeals() ,$dbConnect);
while ($rstDeal = mysql_fetch_array($qryDeal)) {
	$strDealID = $rstDeal['id'];
	$strVehicleID = $rstDeal["vehicleID"];
	$strVehicleType = $rstDeal["vehicleType"];
	$qryVehicle = mysql_query(getCapVehicle($strVehicleType ,$strVehicleID) ,$dbConnect);
	$rstVehicle = mysql_fetch_array($qryVehicle);
	
  $url = "car_leasing-business-contract_hire-".str_replace(' ', '+', $rstVehicle["brand"])."-".$rstDeal['id'].".html";
  print sitemapEntry('http://www.dsgauto.com/'.$url, $lastWeek, 'weekly');
}

print "</urlset>";