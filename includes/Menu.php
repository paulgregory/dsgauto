<?php
	function getMainMenu($ctype, $ftype)
	{ ?>
			<ul id="mmlist">
				<li><a href="/" title="Home">Home</a>
					<ul>
						<li>Information Zone
							<ul>
								<li><a href="/car_leasing-business-articles-which_finance_package.html" title="Which Finance Package?">Which Finance Package?</a></li>
								<li><a href="/car_leasing-business-articles-testimonials.html" title="Customer Testimonials">Customer Testimonials</a></li>
								<li><a href="/car_leasing-business-articles-jargon_explained.html" title="Jargon Explained">Jargon Explained</a></li>
								<li><a href="/car_leasing-business-articles-how_to_order.html" title="How to order">How to order</a></li>
								<li><a href="/car_leasing-business-articles-about_us.html" title="About Us">About Us</a></li>
								<li><a href="/car_leasing-business-sitemap.html" title="Site Map">Site Map</a></li>
								<li><a href="/car_leasing-business-articles-Recruitment.html" title="Recruitment">Recruitment</a></li>
								<li><a href="/car_leasing-business-articles-van_leasing.html" title="Van Leasing">Van Leasing</a></li>
							</ul>
						</li>
						<li>Protect Yourself
							<ul>
								<li><a href="/car_leasing-business-articles-motor_insurance.html" title="Motor Insurance">Motor Insurance</a></li>
								<li><a href="/car_leasing-business-articles-GAP_insurance.html" title="Article about GAP Insurance">GAP Insurance</a></li>
								<li><a href="/car_leasing-business-articles-vehicle_replacement_protection.html" title="Article about Return to Invoice Insurance">Return to Invoice Insurance</a></li>
							</ul>
						</li>
						<li>Contact Us
							<ul>
								<li><a href="/car_leasing-business-contact_us.html" title="General Enquiries">General Enquiries</a></li>
								<li><a href="/car_leasing-business-apply_online.html" title="Apply Online">Apply Online</a></li>
								<li><a href="/car_leasing-business-articles-ready_for_quote.html" title="Get a Quote">Get a Quote</a></li>
								<li><a href="/car_leasing-business-contact_us-phone_me.html" title="Request a Call">Request a Call</a></li>
							</ul>
						</li>
						<li>Legal Information
							<ul>
								<li><a href="/car_leasing-business-articles-privacy_policy.html" title="Privacy Policy">Privacy Policy</a></li>
								<li><a href="/car_leasing-business-articles-terms_and_conditions.html" title="Terms &amp; Conditions">Terms &amp; Conditions</a></li>
								<li><a href="/car_leasing-business-articles-governing_legislation.html" title="Government Legislation">Governing Legislation</a></li>
								<li><a href="/car_leasing-business-articles-fsa_regulatory_disclosure.html" title="FSA Regulatory Disclosure">FSA Regulatory Disclosure</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>

			<!-- Adverts -->
			<!--<div class="chlaward"><img src="images/chal-luxury.jpg" alt="Contract Hire and Leasing - Best Luxury Car Deal 2008 Winner"/></div>-->
			<!--<div class="chlaward"><img src="images/chal-performance.jpg" alt="Contract Hire and Leasing - Best Performance Car Deal 2008 Winner"/></div>-->
			<!--<div class="chlaward"><a href="http://www.newcar4me.com" alt="www.newcar4me.com - Low Rate PCP" ><img src="images/nc4me ad.gif" alt="www.newcar4me.com - Low Rate PCP"/></a></div>-->
			<!--<div class="chlaward"><a href="http://www.dsgvans.com" alt="www.dsgvans.com - Discount New Vans on Contract Hire and Finance Lease" ><img src="images/dsgvans1.gif" alt="www.dsgvans.com - Discount New Vans on Contract Hire and Finance Lease"/></a></div>-->
			<!--<div class="chlaward"><a href="http://www.kingsmaid-franchise.co.uk/" alt="Kingsmaid Domestic Cleaning" ><img src="images/km_banner.gif" alt="Kingsmaid Domestic Cleaning"/></a></div>-->

			<?php
	}

	function getBrandMenu($ctype, $ftype)
	{
		//include("dbConnect.php");
    include("init.php");
		include("sqlMenu.php");
		
		?>
		<!-- Add Header to Search Area -->
		<ul class= "smList">
			<li>
				<a href="car_leasing-business-get_quote.html" title="Get a Quote for Business and Personal Contract Hire" >Get a Quote</a>
				<ul>
				<!-- Add Search Controls -->
				<!-- Add brand Search icons -->
					<li>By Manufacturer
						<div id="brandlist">
							<?php
							$qryBrand = mysql_query($sqlBrand,$dbConnect);
							while ($rstBrand = mysql_fetch_array($qryBrand))
							{
								$intBrandID = $rstBrand["BrandID"];
								$strBrandName = $rstBrand["BrandName"];
								echo "<a href=\"/car_leasing-business-get_quote.html\" title=\"$strBrandName Online Quoting\">
												<img src=\"{$SITE_ROOT}getImageBrand.php?id=$intBrandID&amp;size=2\" alt=\"$strBrandName Get a Quote\" />
											</a>";
							}
							?>
						</div>
					</li>
				</ul>
			</li>
		</ul>
		<!--  Add link to network --> 
		<div class="chlaward"><img src="images/network.gif" alt="A Network Accredited Franchisee"/></div>
		<div class="chlaward"><img src="images/ogilvie Logo.gif" alt="Ogilvie"/></div>
		<div class="chlaward"><img src="images/bvrla-logo.gif" alt="BVRLA"/></div>
<?php
	}
?>