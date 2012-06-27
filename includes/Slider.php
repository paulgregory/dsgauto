	<!-- This is the button used to switch between One Page and Slideshow. -->
	
	<div id="showcase" class="showcase">
		<!-- Each child div in #showcase with the class .showcase-slide represents a slide. -->
		<div class="showcase-slide">
			<!-- Put the slide content in a div with the class .showcase-content. -->
			<div class="showcase-content">
				<img src="images/01.jpg" alt="Contract Hire, Car Leasing Deals, DSG Auto Contracts" />
			</div>
			<!-- Put the thumbnail content in a div with the class .showcase-thumbnail -->
			<div class="showcase-thumbnail">
				<img src="images/01.jpg" alt="Contract Hire, Car Leasing Deals, DSG Auto Contracts" width="140px" />
				<!-- The div below with the class .showcase-thumbnail-caption contains the thumbnail caption. -->
				<div class="showcase-thumbnail-caption"></div>
				<!-- The div below with the class .showcase-thumbnail-cover is used for the thumbnails active state. -->
				<div class="showcase-thumbnail-cover"></div>
			</div>
			<!-- Put the caption content in a div with the class .showcase-caption -->
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
			<a href="/car_leasing-business-get_quote-70.html" coords="737,220" class="order_btn" title="Click here to order now!"></a>
				<img src="images/02.jpg" alt="Mercedes Benz E Class E220 CDI SE 4dr" />
			</div>
			<div class="showcase-thumbnail">
				<img src="images/02.jpg" alt="Mercedes Benz E Class E220 CDI SE 4dr" width="140px" />
				<div class="showcase-thumbnail-caption"></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>


		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
			<a href="/car_leasing-business-get_quote-70.html" coords="737,220" class="order_btn" title="Click here to order now!"></a>            
				<img src="images/03.jpg" alt="Mercedes Benz E220 CDI SE Auto Cabriolet" />
			</div>
			<div class="showcase-thumbnail">
				<img src="images/03.jpg" alt="Mercedes Benz E220 CDI SE Auto Cabriolet" width="140px" />
				<div class="showcase-thumbnail-caption"></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
                         
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
			<a href="/car_leasing-business-get_quote-70.html" coords="737,220" class="order_btn" title="Click here to order now!"></a>            
				<img src="images/04.jpg" alt="Mercedes Benz CLS350 CDI Auto" />
			</div>
			<div class="showcase-thumbnail">
				<img src="images/04.jpg" alt="Mercedes Benz CLS350 CDI Auto" width="140px" />            
				<div class="showcase-thumbnail-content"></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
             
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
			<a href="/car_leasing-business-get_quote-70.html" coords="737,220" class="order_btn" title="Click here to order now!"></a>            
				<img src="images/05.jpg" alt="Mercedes Benz ML300 CDI SE Auto" />
			</div>
			<div class="showcase-thumbnail">
				<img src="images/04.jpg" alt="Mercedes Benz ML300 CDI SE Auto" width="140px" />     
				<div class="showcase-thumbnail-content"></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
            
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
			<a href="/car_leasing-business-get_quote-70.html" coords="737,220" class="order_btn" title="Click here to order now!"></a>            
				<img src="images/06.jpg" alt="Mercedes Benz C Class C200 CDI SE 4dr Auto Edition 125" />
			</div>
			<div class="showcase-thumbnail">
				<img src="images/06.jpg" alt="Mercedes Benz C Class C200 CDI SE 4dr Auto Edition 125" width="140px" />
				<div class="showcase-thumbnail-caption"></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>

		</div>
	</div>
	
      <!-- JavaScript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/libs/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery.aw-showcase.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			810,
		content_height:			250,
		fit_to_parent:			false,
		auto:					true,
		interval:				9000,
		continuous:				true,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		125,
		tooltip_icon_height:	42,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				true,
		btn_numbers:			true,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			true,
		stoponclick:			true,
		transition:				'hslide', /* hslide/vslide/fade */
		transition_delay:		0,
		transition_speed:		500,
		show_caption:			'onload', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			true, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false, /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
		custom_function:		null /* Define a custom function that runs on content change */
	});
});

</script>