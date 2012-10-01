var xmlHttp = false;
try {
  xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttp = false;
  }
}

if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
  xmlHttp = new XMLHttpRequest();
}

var VType;
function setVtype(){
	var vehicleType = document.getElementById('vehicleTypeID').value;
	VType = escape(vehicleType);
	return true;
}
function updateVtype(vehicleType){
	VType = escape(vehicleType);
	return true;
}

function getBrandList(vehicleType, functionToCall) {
	if(vehicleType == ""){
		document.getElementById("brandSelection").disabled = true;
		document.getElementById("modelSelection").disabled = true;
		document.getElementById("derivSelection").disabled = true;
	}
	else {
		updateVtype(vehicleType);
		var url1 = "getBrands.php?vtype="+ escape(vehicleType);
		xmlHttp.open("GET", url1, true);
		xmlHttp.onreadystatechange = functionToCall;
		xmlHttp.send(null);
	}
}

function getModelList(brandID, functionToCall) {
	setVtype();
  var url1 = "getModels.php?vtype="+ VType + "&brandID="+ escape(brandID);
  xmlHttp.open("GET", url1, true);
  xmlHttp.onreadystatechange = functionToCall;
  xmlHttp.send(null);
}

function getDerivList(modelID, functionToCall) {
	setVtype();
  var url1 = "getDerivs.php?vtype="+ VType + "&modelID="+ escape(modelID);
  xmlHttp.open("GET", url1, true);
  xmlHttp.onreadystatechange = functionToCall;
  xmlHttp.send(null);
}

function getBrandImage(brandID, functionToCall) {
  var url1 = "getModels.php?vtype="+ VType + "&brandID="+ escape(brandID);
  xmlHttp.open("GET", url1, true);
  xmlHttp.onreadystatechange = functionToCall;
  xmlHttp.send(null);
}

function getVehicleImage(imageID, functionToCall) {
  var url1 = "getVehicleImage.php?imageID=" + escape(imageID);
  xmlHttp.open("GET", url1, true);
  xmlHttp.onreadystatechange = functionToCall;
  xmlHttp.send(null);
}

function showImage() {
	if (xmlHttp.readyState == 4) {
		var imageHolder = document.getElementById("imageHolder");
		imageHolder.innerHTML = "";
		var response = xmlHttp.responseText;
		var newOption = document.createElement("img");
		newOption.setAttribute("src", response);
		newOption.setAttribute("alt", "Sample Image");
		imageHolder.appendChild(newOption);
  }
}

function selectFinanceType(financeType) {
var form, fTypeHire, fTypeLease; 
form = document.getElementById("DealForm");
fTypeHire = form.getElementsByClassName("contractHire");
fTypeLease = form.getElementsByClassName("financeLease");

if (financeType == "hire"){
	for (var x = 0; x < fTypeHire.length; x++)
	{
		fTypeHire[x].setAttribute("style", "visibility:visible;");
	}
	for (var x = 0; x < fTypeLease.length; x++)
	{
		fTypeLease[x].setAttribute("style", "visibility:hidden;");
	}
}
else {
	for (var x = 0; x < fTypeHire.length; x++)
	{
		fTypeHire[x].setAttribute("style", "visibility:hidden;");
	}
	for (var x = 0; x < fTypeLease.length; x++)
	{
		fTypeLease[x].setAttribute("style", "visibility:visible;");
	}
}
}

function updateLeftBrandsList() {
  if (xmlHttp.readyState == 4) {
    var response = xmlHttp.responseText;
		var responseArray = response.split(',');
		var x = "0";
		var newResponse = "";
		var cv;
		var left = document.getElementById("VehicleType");
		if (VType == "carsVans") {
			cv = 'c';
			left.setAttribute("class", "carsVans");
		}
		else{
			cv = 'v';
			left.setAttribute("class", "vansCars");
		}
		for (x in responseArray)
		{
			if(x != 0)
			{
				var y = responseArray[x].split(':');
				var url = y[0].replace(/([' '|-])/i,'_');
				newResponse += "<li><h4><a class=\"brand\" href=\"/car_leasing-business-get_quote-"+url+"-"+cv+y[1]+".html\" title=\""+y[0]+" - Get a quote\">"+y[0]+"</a></h4></li>";
			}
		}
		document.getElementById("BrandList").innerHTML = newResponse;
  }
}

function updateBrandSelection() {
  if (xmlHttp.readyState == 4) {
    var response = xmlHttp.responseText;
		var responseArray = response.split(',');
		var x = "0";
		var brands = document.getElementById("brandSelection");
		brands.disabled = false;
		brands.innerHTML = "";
		for (x in responseArray)
		{
			var y = responseArray[x].split(':');
			var newOption = document.createElement("option");
			var text = document.createTextNode(y[0]);
			newOption.setAttribute("value", y[1]);
			newOption.appendChild(text);
			brands.appendChild(newOption);
		}
		document.getElementById("modelSelection").disabled = true;
		document.getElementById("modelSelection").value = 0;
		document.getElementById("derivSelection").disabled = true;
		document.getElementById("derivSelection").value = 0;
		document.getElementById("derivSelectionReq").innerHTML = "*";
		return true;
  }
}

function updateModelSelection() {
  if (xmlHttp.readyState == 4) {
		document.getElementById("modelSelection").disabled = false;
    var response = xmlHttp.responseText;
		var responseArray = response.split(',');
		var x = "0";
		var models = document.getElementById("modelSelection");
		models.innerHTML = "";
		for (x in responseArray)
		{
			var y = responseArray[x].split(':');
			var newOption = document.createElement("option");
			var text = document.createTextNode(y[0]);
			newOption.setAttribute("value", y[1]);
			newOption.appendChild(text);
			models.appendChild(newOption);
		}
		document.getElementById("derivSelection").disabled = true;
		document.getElementById("derivSelection").value = 0;
		document.getElementById("derivSelectionReq").innerHTML = "*";
		return true;
  }
}

function updateDerivSelection() {
  if (xmlHttp.readyState == 4) {
		document.getElementById("derivSelection").disabled = false;
    var response = xmlHttp.responseText;
		var responseArray = response.split(',');
		var x = "0";
		var derivs = document.getElementById("derivSelection");
		derivs.innerHTML = "";
		for (x in responseArray)
		{
			var y = responseArray[x].split(':');
			var newOption = document.createElement("option");
			var text = document.createTextNode(y[0]);
			newOption.setAttribute("value", y[1]);
			newOption.appendChild(text);
			derivs.appendChild(newOption);
		}
		document.getElementById("derivSelectionReq").innerHTML = "*";
		return true;
  }
}
