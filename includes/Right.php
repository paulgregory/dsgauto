<?php 

$qryTestimonials = mysql_query($sqlGetTestimonials, $dbConnect);
if($qryTestimonials)
{
	$rstTestimonials = mysql_fetch_array($qryTestimonials);
	$strTestimonial = $rstTestimonials['testimonial'];
	$strName = $rstTestimonials['name'];
	$strID = $rstTestimonials['id'];
	$strVehicle = $rstTestimonials['vehicle'];
	$strTest = explode(' ', $strTestimonial);
	$str = "";
	for($x = 0; $x < 150; $x ++)
	{
		if (count($strTest) > $x)
			$str .= $strTest[$x] . " ";
	}
	
}
?>
<div class="rightTop"></div>
<div id="partners">
		<p>Appointed representatives of</p>
		<a href="http://network.leaseplan.co.uk/" target="_blank">
			<img class="partner" src="/images/network.gif" alt="Network lease" title="Network Lease"/>
		</a>
		<img class="partner lex" src="/images/lex.jpg" alt="Lex Autolease" title="Lex Autolease"/>
		<a href="/pdf/Leasing_Broker_Code.pdf" target="_blank">
			<img class="partner" src="/images/bvrla-logo.gif" alt="BVRLA" title="BVRLA"/>
		</a>
</div>
<div class="rightTop"></div>
<div id="twitter">
<a href="http://www.twitter.com/dsgautocontract" title="Follow us on Twitter"><img src="/images/twitter.png" alt="Follow us on Twitter" /></a>
</div>
<div class="rightTop"></div>
<div id="testimonials">
		<h3>Happy Customers</h3>
		<?php echo "<q>$str</q><p>$strName</p><p class=\"bold\">$strVehicle</p>"; ?>
		<div class="clear"></div>
		<div class="button">
			<a class="viewAll" href="/car_leasing-business-articles-testimonials.html" title="View All Testimonials">View All</a>
		</div>
</div>

<div class="rightTop"> </div>
<div id="affiliatedSites">
	<a href="http://www.newcar4me.com/" target="_blank">
		<img src="images/nc4me.gif" alt="Discount new cars and low rate PCP and Hire Purchase quotes available online instantly at newcar4me.com" title="Discount new cars and low rate PCP and Hire Purchase quotes available online instantly at newcar4me.com"/>
	</a>
</div>
<div class="rightTop"></div>
<div id="awards">
	<img class="partner" src="/images/CHAL2010.jpg" alt="Contract Hire and Leasing - Best Car Deal Overall 2010" title="Contract Hire and Leasing - Best Car Deal Overall 2010"/>
	<!--<img class="partner" src="/images/chal-luxury.jpg" alt="Car Hire and Leasing Luxury 2008 award" title="Car Hire and Leasing Luxury 2009 award"/>
	<img class="partner" src="/images/chal-performance.jpg" alt="Car Hire and Leasing Performance 2008 award" title="Car Hire and Leasing Performance 2009 award"/> -->
</div>