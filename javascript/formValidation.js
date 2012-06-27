function addStar(inputName){
	var name = inputName.name + "Req";
	var requiredSpan = document.getElementById(name);
	requiredSpan.innerHTML = "*";
	return true;
}

function removeStar(inputName){
	var name = inputName.name + "Req";
	var requiredSpan = document.getElementById(name);
	requiredSpan.innerHTML = "";
	return true;
}

function required(inputName, type) {
	switch(type)
	{
		case 'text':
			if (inputName.value==null||inputName.value==''){
				addStar(inputName);
				return false;
			} 
			else{
				removeStar(inputName);
				return true;
			}
		break;
		case 'combobox':
			if (inputName.selectedIndex <= 0){
				addStar(inputName);
				return false;
			}
			else{
				removeStar(inputName);
				return true;
			}
		break;
		case 'telNo':
		var pattern = /^([0-9\s]+)$/;
			if (inputName.value == null||inputName.value == ''||!pattern.test(inputName.value)){
				addStar(inputName);
				return false;
			}
			else{
				removeStar(inputName);
				return true;
			}
		break;
		case 'number':
		var pattern = /^([0-9]+)$/;
			if (inputName.value == null||inputName.value == ''||!pattern.test(inputName.value)){
				addStar(inputName);
				return false;
			}
			else{
				removeStar(inputName);
				return true;
			}
		break;
		case 'date':
			var pattern = /^(\d{1,2})(\/)(\d{1,2})\2(\d{4})$/;
			if (inputName.value == null||inputName.value == ''||!pattern.test(inputName.value)){
				addStar(inputName);
				return false;
			}
			else{
				removeStar(inputName);
				return true;
			}
		break;
		case 'checkbox':
			if (!inputName.checked){
				addStar(inputName);
				return false;
			}
			else{
				removeStar(inputName);
				return true;
			}
		break;	
		case 'email':
			var pattern = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if(pattern.test(inputName.value))	{
				removeStar(inputName);
				return false;
			}
			else{
				addStar(inputName);
				return true;
			}
		break;
	}
}

/*
function checkHistory(){
	var form = document.getElementById("Form");
	var selects = form.getElementsByTagName('select');
	var jobYears = /jobYears([0-9]+)-([0-9]+)/g;
	var jobMonths = /jobMonths([0-9]+)-([0-9]+)/g;
	var addressYears = /addressYears([0-9]+)-([0-9]+)/g;
	var addressMonths = /addressMonths([0-9]+)-([0-9]+)/g;
	var pattern = /[a-zA-Z]+([0-9]+)-([0-9]+)/g;
	var letters = /[a-zA-Z]+/g;
	var numbers = /[0-9]+/g;
	var Addresses = new Array();
	var Jobs = new Array();
	for (var x = 0; x < selects.length; x++)
	{	
		var select = selects[x].name.match(pattern);
		if(pattern.test(selects[x].name))
		{
			var Name = selects[x].name.match(letters);
			var Numbers = selects[x].name.match(numbers);
			switch(Name[0])
			{
				case 'jobYears': 
					alert(Name[0]+" "+Numbers[0]+" "+Numbers[1]);
					if (Jobs[Numbers[0]-1])
						Jobs[Numbers[0]-1][Numbers[1]-1] += select.value;
					else {
						Jobs[Numbers[0]-1] = new Array();
						Jobs[Numbers[0]-1][Numbers[1]-1] = select.value;
						alert(Jobs[Numbers[0]-1][Numbers[1]-1]);
					}
					break;
				case 'jobMonths': 
					alert(Name[0]+" "+Numbers[0]+" "+Numbers[1]);
					break;
				case 'addressYears': 
					alert(Name[0]+" "+Numbers[0]+" "+Numbers[1]);
					break;
				case 'addressMonths': 
					alert(Name[0]+" "+Numbers[0]+" "+Numbers[1]);
					break;
			}
			
			var iggy = selects[x].name.match(pattern2);
			for(var y in iggy) {
				alert(iggy[y]);
			}
		}
	}

}

function submitForm() {
	var form = document.getElementById("Form");
	var rtn = validateForm();
	if(rtn != true)
		window.scrollTo(0, rtn);
	else {
		var submit = document.createElement('input');
		submit.setAttribute("name", "Submit");
		submit.setAttribute("value", "Submit");
		submit.setAttribute("type", "hidden");
		form.appendChild(submit);
		form.submit();
	}
}

function validateForm(){
	var form = document.getElementById("Form");
	var spans = form.getElementsByTagName('span');
	for (var x = 0; x < spans.length; x++)
	{
		if(spans[x].innerHTML == '*')
			if(spans[x].id != 'helper')
				return spans[x].offsetTop - 100;
	}
	return true;
}*/