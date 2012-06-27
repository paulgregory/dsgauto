// PG: Rewritten to use jQuery

var VType;


function setVtype(){
	var vehicleType = $('input[name=vehicleType]:checked').val()
	VType = escape(vehicleType);
	return true;
}

function getBrandList(vehicleType) {
	// $('#brandSelection').attr('disabled', 'disabled');
  // $('#brandSelection').html('<option value="0">Makes</option>');
	$('#modelSelection').attr('disabled', 'disabled');
  $('#modelSelection').html('<option value="0">Models</option>');
		
	if(vehicleType != ""){	
		$.ajax({
	    type: "GET",
	    url: "getBrands.php",
	    data: { vtype: escape(vehicleType) }
	  })
	  .done( function(msg) {updateBrandSelection(msg) } )
	  .fail( function(jqXHR, textStatus) {
			alert('Error: '+textStatus);
		});
	}
}

function getModelList(brandID) {
	$('#modelSelection').attr('disabled', 'disabled');
  $('#modelSelection').html('<option value="0">Models</option>');
	
	if (brandID != '0') {
	  setVtype();
	
	  $.ajax({
      type: "GET",
      url: "getModels.php",
      data: { vtype: escape(VType), brandID: escape(brandID) }
    })
    .done( function(msg) {updateModelSelection(msg) } )
    .fail( function(jqXHR, textStatus) {
		  alert('Error: '+textStatus);
	  });
	}
}

function updateBrandSelection(response) {
  var makes = response.split(',');

  var options;
	for (x in makes) {
		var make = makes[x].split(':');
	  options += "<option value=\"" + make[1] + "\">" + make[0] + "</option>" + "\n";
	}
	
	$('#brandSelection').html(options).removeAttr('disabled');
}

function updateModelSelection(response) {
  var models = response.split(',');

  var options;
	for (x in models) {
		var model = models[x].split(':');
	  options += "<option value=\"" + model[1] + "\">" + model[0] + "</option>" + "\n";
	}
	
	$('#modelSelection').html(options).removeAttr('disabled');
}