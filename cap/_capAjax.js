function updateRanges(msg) {
	var options;
	
	options = '<option value="0">-- All Ranges --</option>' + "\n";
	for (x in msg) {
	  options += "<option value='" + msg[x].RangeCode + "'>" + msg[x].RangeName + "</option>" + "\n";
	}
	
	$('#ranges').html(options);
}

function updateModels(msg) {
	var options = '';
	
	for (x in msg) {
	  options += msg[x].ModelDesc + "<div style=\"padding: 4px 0 10px 20px; font-style: italic\" id=\"derivs-"+msg[x].ModelCode+"\"><input type=\"button\" onClick=\"getDerivs("+msg[x].ModelCode+")\" value=\"Get derivs\" /></div>" + "\n";
	}
	
	$('#models').html(options);
}

function getDerivs(ModelCode) {
	
	// query the database for ranges from this manufacturer
	$.ajax({
    type: "GET",
    url: "get_derivs.php",
    data: { modelcode: ModelCode }
  }).done( function(msg) {
	  // update the ranges dropdown
	  var options = '';
	  for (x in msg) {
		  options += msg[x].DerivDescription + " &pound;"+msg[x].BasicPrice+"<br />" + "\n";
		}
		$('#derivs-'+ModelCode).html(options);
		
	}).fail( function(jqXHR, textStatus) {
		alert('Error: '+textStatus);
	});
  
}

function getRanges(ManCode) {
	
	updateRanges(false); // clear the ranges list
	updateModels(false); // clear the models list
	
	// Disable ranges if ManCode is empty
	if (ManCode == '0') {
		$('#ranges').attr('disabled', 'disabled'); // disable the dropdown
	}
	else {
		// query the database for ranges from this manufacturer
		$.ajax({
	    type: "GET",
	    url: "get_ranges.php",
	    data: { mancode: ManCode }
	  }).done( function(msg) {
		  // update the ranges dropdown
		  updateRanges(msg);
		  $('#ranges').removeAttr('disabled');
		}).fail( function(jqXHR, textStatus) {
			alert('Error: '+textStatus);
		});
	}
  
}

function getModels(RangeCode) {
	
	// Disable ranges if ManCode is empty
	if (RangeCode == '0') {
		updateModels(false); // clear the models list
		$('#models').attr('disabled', 'disabled'); // disable the dropdown
	}
	else {
		// query the database for ranges from this manufacturer
		$.ajax({
	    type: "GET",
	    url: "get_models.php",
	    data: { rangecode: RangeCode }
	  }).done( function(msg) {
		  // update the models dropdown
		  updateModels(msg);
		  $('#models').removeAttr('disabled');
		}).fail( function(jqXHR, textStatus) {
			alert('Error: '+textStatus);
		});
		
	}
}

$(document).ready(function() {
	
	
});