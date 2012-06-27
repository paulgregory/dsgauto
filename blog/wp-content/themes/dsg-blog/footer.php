			<footer role="contentinfo" class="clearfix">
			
			  <div id="address">
				  <h2 class="footer_title">DSG Auto Contracts</h2>
				  <p>Camelot House<br />Bredbury Park Way<br />Stockport<br />SK6 2SN</p>
				  <p><strong>TEL:</strong> 0161 406 3936<br /><strong>FAX:</strong> 0161 375 3936</p>
				  <p class="smaller"><a href="http://www.dsgauto.com">www.dsgauto.com</a> - Contract Hire<br />and Car Leasing Specialists.</p>
					<p class="smaller">&copy; DSG Auto Contracts Ltd 2011.<br />All rights reserved.</p>
					<p class="smaller">SEO and Web Design by Muba<br />Limited.</p>
				</div>
				
				<div id="sitemap">
					<nav id="footer-links" class="clearfix">
						<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
					
					<nav id="car-brands" class="clearfix">
						<?php dsgac_car_brands(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				</div>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<!-- scripts are now optimized via Modernizr.load -->	
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>