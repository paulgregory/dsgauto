//Create a new XMLHttpRequest object to talk to the Web server 
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

function callServer() {
  var brands = document.getElementById("Brands");
	var brandName = brands.options[brands.selectedIndex].value;
  if ((brandName == null) || (brandName == "")) return;
  var url1 = "getModels.php?enabled=1&id=" + escape(brandName);
  xmlHttp.open("GET", url1, true);
  xmlHttp.onreadystatechange = updateEnabledModels;
  xmlHttp.send(null);
}

function updateEnabledModels() {
  if (xmlHttp.readyState == 4) {
    var response = xmlHttp.responseText;
		document.getElementById("enabledModels").innerHTML = response;
		
		var brands = document.getElementById("Brands");
		var brandName = brands.options[brands.selectedIndex].value;
		if ((brandName == null) || (brandName == "")) return;
		var url2 = "getModels.php?enabled=0&id=" + escape(brandName);
		xmlHttp.open("GET", url2, true);
		xmlHttp.onreadystatechange = updateDisabledModels;
		xmlHttp.send(null);
		//document.getElementById("enabledModels").parentNode.innerHTML = document.getElementById("enabledModels").parentNode.innerHTML;
  }
}

function updateDisabledModels() {
  if (xmlHttp.readyState == 4) {
    var response = xmlHttp.responseText;
		document.getElementById("disabledModels").innerHTML = response;
		//document.getElementById("disabledModels").parentNode.innerHTML = document.getElementById("disabledModels").parentNode.innerHTML;
  }
}