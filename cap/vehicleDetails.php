<script type="text/javascript" src="/js/libs/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/js/libs/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#vehicle-tabs').tabs();
});
</script>

<?php

function array_tech_spec_by_category($qryTechSpec) {
	$items = array();
  while ($item = mssql_fetch_assoc($qryTechSpec)) {
	  $formatted = $item['Description'] . ':&nbsp; <strong>';
	  switch ($item['DataType']) {
		  case 'B':
		    $formatted .= ($item['CharValue'])? 'Yes' : 'No';
		  break;
		  case 'C':
		    $formatted .= $item['CharValue'];
		  break;
		  case 'F':
		    $formatted .= $item['FloatValue'];
		  break;
		  case 'F':
		    $formatted .= $item['FloatValue'];
		  break;
		  default:
			  $formatted .= $item['StingValue'];
	  }
	  $formatted .= '</strong>';
	  $items[$item['CategoryDesc']][] = $formatted;
  }

  return $items;
}

function array_equipment_by_category($qryEquipment) {
	$items = array();
  while ($item = mssql_fetch_assoc($qryEquipment)) {
	  $items[$item['CatCode']][] = $item['LongDesc'];
  }

  return $items;
}

function array_options_by_category($qryOptions) {
	$items = array();
  while ($item = mssql_fetch_assoc($qryOptions)) {
	  $items[$item['CategoryDesc']][] = $item;
  }

  return $items;
}

function print_equipment_group($items, $title) {
	if (count($items)) {
		print '<div class="group">';
		print '<h3>'.$title.'</h3>';
		print '<ul>';
		foreach ($items as $item) {
			print '<li>'.$item.'</li>';
		}
		print '</ul></div>';
	}
}

function print_option_group($items, $title) {
	global $selectedOptions;
	
	if (count($items)) {
		print '<div class="group">';
		print '<h3>'.$title.'</h3>';
		print '<ul>';
		foreach ($items as $item) {
			$fullPrice = $item['BasicPrice'];
			$monthlyPrice = round($fullPrice/38, 2);
			$checked = ($selectedOptions[$item['OptionCode']] == 'selected')? ' checked' : '';		
			print '<li><input type="checkbox" name="vehicleOptions['.$item['OptionCode'].']" id="option-'.$item['OptionCode'].'" value="'.$title.' &rsaquo; '.$item['LongDesc'].'"'.$checked.' /> <label for="option-'.$item['OptionCode'].'"><span class="option-label">'.$item['LongDesc'].'</span> <span class="option-price">&pound;'.$fullPrice.'</span></label><input type="hidden" name="vehicleOptionsPrice['.$item['OptionCode'].']" value="'. $monthlyPrice .'" /></li>';
		}
		print '</ul></div>';
	}
}

// When comming back from the Quote page the selectedOptions array may be set
if (isset($_POST['selectedOptions'])) {
	$selectedOptions = $_POST['selectedOptions'];
} 

require_once('includes/constants.php');
require_once('includes/sql.php');
require_once('includes/dbConnect.php');
require_once('mssqlConnect.php');

if ($_GET['capid'] && $_GET['vehicleType']) {

  $capid = intval($_GET['capid']);
  $finance = ($_GET['financeType'] == 'personal')? 'personal' : 'business'; // a form of query sanitisation
  $vtype = ($_GET['vehicleType'] == 'car')? 'car' : 'van'; // a form of query sanitisation

  $qryVehicle = mysql_query(vehicleInfoAndFinance($capid, $vtype));
	
	if ($vehicle = mysql_fetch_assoc($qryVehicle)) { ?>
			
			<?php 
			$with_img = FALSE;
			
			$qryVehicleImage = mssql_query(capVehicleImage($capid));
			
			if ($qryVehicleImage) {
			  $imgResult = mssql_fetch_assoc($qryVehicleImage);
			
				$vehicleImg = '/cap/images/'.$imgResult['ImageID'].'.jpg';
				$brandImg = '/images/brands-large/'.$vehicle['Manufacturer'].'.png';
			
			  if (file_exists($_SERVER['DOCUMENT_ROOT'].$vehicleImg) && $vtype == 'car') {
				  $with_img = TRUE;
				  print '<div id="vehicle-image"><img src="'.$vehicleImg.'" alt="'.$vehicle['DerivativeLong'].'" /></div>';
			  }
			  elseif (file_exists($_SERVER['DOCUMENT_ROOT'].$brandImg)) {
				  $with_img = TRUE;
				  print '<div id="brand-image"><img src="'.$brandImg.'" alt="'.$vehicle['Manufacturer'].'" /></div>';
			  }
			
			} ?>

			<h1 id="vehicle-title" <?php if ($with_img) { print 'class="with-image"'; } ?>><span class="make-model"><?php print $vehicle['Manufacturer']; ?> <?php print $vehicle['ModelLong']; ?><span><br /><span class="subtitle"><?php print $vehicle['DerivativeLong']; ?></span></h1>
			
			<table class="finance-details" width="500">
				<tr class="co2">
					<td class="label" width="200">CO<sub>2</sub> Emissions:</td>
					<td class="value"><?php print $vehicle['CO2']; ?> g/km</td>
				</tr>
				<tr class="p11d">
					<td class="label">P11D Value:</td>
					<td class="value">&pound;<?php print number_format($vehicle['P11D'], 2, '.', ''); ?></td>
				</tr>
				<tr class="finance-rental">
					<td class="label">Vehicle Finance Rental:</td>
					<td class="value"><?php print cap_format_price($vehicle['FinanceRental'], $finance); ?></td>
				</tr>
        <tr class="finance-notice">
	        <td colspan="2">Finance based on a 3+35 months profile with 10k miles per annum.<br /><?php if ($finance == 'personal') { print 'Personal finance rental includes VAT at '.(($VAT-1)*100).'%.'; } ?></td>
	      </tr>
			</table>

      <form action="/car_leasing-business-get_quote.html" method="post" style="clear: both">
	
	    <input type="hidden" name="quoteVehicleFinanceRental" value="<?php print $vehicle['FinanceRental']; ?>" />
	    <input type="hidden" name="quoteVehicleType" value="<?php print $vtype; ?>">
	    <input type="hidden" name="quoteVehicleBrand" value="<?php print $vehicle['Manufacturer']; ?>">
	    <input type="hidden" name="quoteVehicleModel" value="<?php print $vehicle['ModelShort']; ?>">
	    <input type="hidden" name="quoteVehicleCAPID" value="<?php print $capid; ?>">
	    <input type="hidden" name="quoteVehicleFinance" value="<?php print $finance; ?>">

      <div id="quote-buttons">
	      <div id="running-total-anchor"></div>
	      <div id="running-total">
		    	Monthly finance rental<br />with selected options:
		      <div id="running-total-value"><?php print cap_format_price($vehicle['FinanceRental'], $finance); ?></div>
		      <input type="submit" value="Get quote" />
		    </div>
	    </div>
	
      <div id="vehicle-tabs">
	      <ul id="tabs" class="clearfix">
		      <li><a href="#vehicle-options">Select Vehicle Options</a></li>
		      <li><a href="#vehicle-standard-equipment">Standard Equipment</a></li>
		      <li><a href="#vehicle-tech-spec">Technical Specification</a></li>
		    </ul>
			
			  <div id="vehicle-options">
				<?php
				$qryOptions = mssql_query(capVehicleOptions($capid));
				if (mssql_num_rows($qryOptions)) {
					$items = array_options_by_category($qryOptions);
					
					print '<p><em>Tick the options you would like to add to your quote. Option price excludes VAT. <a style="float: right" href="javascript:void(0)" onclick="resetCheckboxes(); calculateTotal();">Reset options</a></em></p><div class="css-columns">';
					
					foreach ($items as $cat_name => $group) {
						print_option_group($group, $cat_name);
					}

					print '</div>';
				}
				else {
					print '<p><em>No options available for this vehicle</em></p>';
				}
				?>
				</div>
			
				<div id="vehicle-standard-equipment">
					<?php
					$qryEquipment = mssql_query(capVehicleStandardEquipment($capid));
					if (mssql_num_rows($qryEquipment)) {
						$items = array_equipment_by_category($qryEquipment);
						
						print '<div class="css-columns">';

						@print_equipment_group($items[58], 'Exterior Body Features');
						@print_equipment_group($items[61], 'Interior Features');
						@print_equipment_group($items[77], 'Safety');
						@print_equipment_group($items[62], 'Windows');
						@print_equipment_group($items[63], 'Brakes');
						@print_equipment_group($items[67], 'Driver Aids');
						@print_equipment_group($items[49], 'Seats');
						@print_equipment_group($items[48], 'Security');
						@print_equipment_group($items[80], 'Carpets/Rugs');
						@print_equipment_group($items[48], 'Security');
						
						print '</div>';
					}
					else {
						print '<p><em>No standard equipment available for this vehicle</em></p>';
					}
					?>
        </div>

				<div id="vehicle-tech-spec">
					<?php
					$qryTechSpecs = mssql_query(capVehicleTechSpecs($capid));
					if (mssql_num_rows($qryTechSpecs)) {
						$items = array_tech_spec_by_category($qryTechSpecs);
						
						print '<div class="css-columns">';
						
						foreach ($items as $cat_name => $group) {
							print_equipment_group($group, $cat_name);
						}
						
						print '</div>';
					}
					else {
						print '<p><em>No technical specification available for this vehicle</em></p>';
					}
					?>
        </div>

      </div>

      <script type="text/javascript">
      function moveScroller() {
			    var move = function() {
			        var st = $(window).scrollTop();
			        var ot = $("#running-total-anchor").offset().top;
			        var s = $("#running-total");
			        if(st > ot) {
			            s.css({
			                position: "fixed",
			                top: "10px"
			            });
			        } else {
			            if(st <= ot) {
			                s.css({
			                    position: "relative",
			                    top: ""
			                });
			            }
			        }
			    };
			    $(window).scroll(move);
			    move();
			}

      function calculateTotal() {
	      var total = 0;
			  var optionTotal = 0;
			  var postfix = ' <span class="vat">+VAT</span>';
			  var priceCalc = { "vatMultiplier":<?php print $VAT; ?>, 
			                    "includeVat": <?php print ($finance == 'personal')? 'true' : 'false'; ?>,
			                    "vehiclePrice": <?php print $vehicle['FinanceRental']; ?> }
	      // total the monthly prices of the selected options
			  $('#vehicle-options input:checked').each(function() {
				  optionTotal += parseFloat($(this).siblings('input:hidden').val());
			  });
			  // sum the vehicle price and the option total
			  total = priceCalc['vehiclePrice'] + optionTotal;
			  // add VAT where necessary
        if (priceCalc['includeVat']) {
          total = (total * priceCalc['vatMultiplier']);
          postfix = ' <span class="vat">inc VAT</span>';
        }
        // correct decimal places
        roundedTotal = total.toFixed(2);
			  // update the running total
			  $('#running-total-value').fadeOut('fast', function() { $('#running-total-value').html('&pound'+roundedTotal+postfix); });				  
			  $('#running-total-value').fadeIn('fast');
      }

      function resetCheckboxes() {
	      $('#vehicle-options input:checkbox').attr('checked', false);
      }

      $(document).ready(function() {
	      // track the total price down the page as we scroll
	      moveScroller();
	      // reset the total
	      calculateTotal();
	
			  $('#vehicle-options input:checkbox').change(function() { calculateTotal() });
			});
      </script>
      </form>

		<?php
	}
	else {
		print '<p><strong>Sorry, couldn\'t find vehicle information. <a href="/">Search again</a></strong></p>';
	}
	
}
else {
	print '<p><strong>Vehicle ID missing! Try searching again. <a href="/">Search again</a></strong></p>';
}