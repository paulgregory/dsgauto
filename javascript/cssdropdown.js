iehover = function() {
	var navs = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<navs.length; i++) {
		navs[i].onmouseover=function() {
			this.className+=" hover";
		}
		navs[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" hover\\b"), "");
		}
	}

}
if (window.attachEvent) window.attachEvent("onload", iehover);
