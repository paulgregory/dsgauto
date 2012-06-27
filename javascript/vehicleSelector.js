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
  var brands = document.getElementById("brands");
	
	var brandName = brands.options[brands.selectedIndex].value;
	
  if ((brandName == null) || (brandName == "")) return;
  var url = "test2.php?brand=" + escape(brandName);
  xmlHttp.open("GET", url, true);
  xmlHttp.onreadystatechange = updatePage;
  xmlHttp.send(null);
}

function updatePage() {
  if (xmlHttp.readyState == 4) {
    var response = xmlHttp.responseText;
		document.getElementById("models").innerHTML = response;
		document.getElementById("models").parentNode.innerHTML = document.getElementById("models").parentNode.innerHTML;
  }
}