<?php
	$str = "";
	$qryBrand = mysql_query($sqlCarBrand,$dbConnect);
	$i = 1;
	$n = 1;
	while ($rstBrand = mysql_fetch_array($qryBrand))
	{
		$strBrandID = $rstBrand["id"];
		$strBrandName = $rstBrand["brand"];
		if($strBrandName != "BMW")
			$strBrandName = preg_replace('/(.+)-(.?)/e',"ucfirst('$1').'-'.ucfirst('$2')",ucwords(strtolower($rstBrand["brand"]))); 
		if($i == 1){
			$str .= "<li>";
		}
		$str .= "<a href=\"/car_leasing-business-get_quote-".sanitiseUrlPart($strBrandName)."-c$strBrandID.html\" title=\"$strBrandName - Get a quote\">
							$strBrandName
						</a>";
		if($i == 1){
			$str .= "</li></ul><ul>";
			$i = 0;
		}				
		$i ++;
		$n ++;
	}
	if ($i < 1 && $i > 0)
		$str .= "</li>";
?>
<footer>
<div id="address">
<h1 class="footer_title">DSG Auto Contracts</h1>

<p>Camelot House<br />
Bredbury Park Way<br />
Stockport<br />
SK6 2SN</p>

<p><strong>TEL:</strong> <?php echo $CONTACT_NUMBER; ?><br />
<strong>FAX:</strong> <?php echo $FAX_NUMBER; ?></p>

<p class="copy"><a href="http://www.dsgauto.com" alt="Contract Hire, Car Leasing Deals, DSG Auto Contracts">www.dsgauto.com</a> - Contract Hire and Car Leasing Specialists.</p>

<p class="copy">&copy; DSG Auto Contracts Ltd 2011.<br /> 
All rights reserved. </p>

<p class="copy">SEO and Web Design by Muba Limited.</p>

<p class="copy"><a href="/car_leasing-business-articles-terms_and_conditions.html" title="Terms &amp; Conditions">Terms &amp; Conditions</a><br /><a href="/car_leasing-business-articles-privacy_policy.html" title="Privacy Policy">Privacy Policy</a></p>

</div>

<div id="sitemap">

<ul>
<li class="li_title"><a href="/car_leasing-special-offers.html">Specials</a></li>
</ul>

<ul>
<li class="li_title"><a href="/car_leasing-business-articles-which_finance_package.html">Finance Info</a></li>
</ul>

<ul>
<li class="li_title"><a href="/index.php?stype=contactus&level=applyonline&type=business">Apply</a></li>
</ul>

<ul>
<li class="li_title"><a href="/index.php?stype=contactus&level=getquote">Get Quote</a></li>
</ul>

<ul>
<li class="li_title"><a href="/index.php?stype=contactus">Contact DSG</a></li>
</ul>

<ul>
<li class="li_title"><a href="/car_leasing-business-articles-testimonials.html">Testimonials</a></li>
</ul>
</div>
    <div class="footerbrand">

<ul>
	<?php echo $str; ?>
</ul>
<ul>
	<?php 
		if(isset( $_SESSION['status']))
			echo "<li><a href=\"/administration.html\" title=\"Administration\">Administration</a></li>"; 
	?>
</ul>

</div>

    </footer>
