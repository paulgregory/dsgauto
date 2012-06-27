function getAddressFields(list, num) {
return '\n\<h4>Previous Address</h4>\n\
				<label>Address Line 1</label>\n\
					<input type="text" name="addressA'+list+'-'+num+'" class="addressLine" value="" maxlength="255"/>\n\
					<span class="required" id="addressA'+list+'-'+num+'Req">*</span>\n\
				<label>Address Line 2</label>\n\
					<input type="text" name="addressB'+list+'-'+num+'" class="addressLine" value="" maxlength="255"/>\n\
				<label>Town/City</label>\n\
					<input type="text" name="addressC'+list+'-'+num+'" class="addressLine" value="" maxlength="255"/>\n\
					<span class="required" id="addressC'+list+'-'+num+'Req">*</span>\n\
				<label>Postcode</label>\n\
					<input type="text" name="postcode'+list+'-'+num+'" class="addressLine" value="" maxlength="255"/>\n\
					<span class="required" id="postcode'+list+'-'+num+'Req">*</span>\n\
				<label>Accomodation Type</label>\n\
				<select class="accomType" name="accomType'+list+'-'+num+'">\n\
					<option value=\"\">Please Select</option>\n\
					<option value="Owner">Owner</option>\n\
					<option value="TenantPF">Tenant (Private Furnished)</option>\n\
					<option value="TenantPU">Tenant (Private Unfurnished)</option>\n\
					<option value="TenantC">Tenant (Council)</option>\n\
					<option value="LWP">Living with Parents</option>\n\
					<option value="Other">Other</option>\n\
				</select>\n\
				<span class="required" id="accomType'+list+'-'+num+'Req">*</span>\n\
				<div class="addressTerm">\n\
				<label>Years at Address</label>\n\
				<input type="text" class="years" name="addressYears'+list+'-'+num+'" />\n\
				<span class="required" id="addressYears'+list+'-'+num+'Req">*</span>\n\
				<label>Months at Address</label>\n\
				<input type="text" class="months" name="addressMonths'+list+'-'+num+'" />\n\
				<span class="required" id="addressMonths'+list+'-'+num+'Req">*</span>\n\
				</div>\n\
				<a class="remAddress" title="Remove Address" onclick="remAddress('+list+', '+num+');">Remove Address</a>';
}

function getJobsFields(list, num){
	return '<h3>Previous Employment</h3>\n\
				<label>Employer Name</label>\n\
					<input type="text" name="jobEmpName'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
					<span class="required" id="jobEmpName'+list+'-'+num+'Req">*</span>\n\
				<label>Address Line 1</label>\n\
					<input type="text" name="jobAddressA'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
					<span class="required" id="jobAddressA'+list+'-'+num+'Req">*</span>\n\
				<label>Address Line 2</label>\n\
					<input type="text" name="jobAddressB'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
				<label>Town/City</label>\n\
					<input type="text" name="jobAddressC'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
					<span class="required" id="jobAddressC'+list+'-'+num+'Req">*</span>\n\
				<label>Postcode</label>\n\
					<input type="text" name="jobPostcode'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
					<span class="required" id="jobPostcode'+list+'-'+num+'Req">*</span>\n\
				<label>Telephone number</label>\n\
					<input type="text" name="jobTelNo'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
					<span class="required" id="jobTelNo'+list+'-'+num+'Req">*</span>\n\
				<label>Occupation</label>\n\
					<input type="text" name="jobOccupation'+list+'-'+num+'" class="jobLine" value="" maxlength="255"/>\n\
					<span class="required" id="jobOccupation'+list+'-'+num+'Req">*</span>\n\
				<label>Occupation Basis</label>\n\
					<select class="jobLine" name="jobBasis'+list+'-'+num+'">\n\
						<option value="">Please Select</option>\n\
						<option value="fullTime">Full Time</option>\n\
						<option value="partTime">Part Time</option>\n\
						<option value="selfEmployed">Self Employed</option>\n\
					</select>\n\
					<span class="required" id="jobBasis'+list+'-'+num+'Req">*</span>\n\
				<div class="jobTerm">\n\
				<label>Years at Job</label>\n\
				<input type="text" class="years" name="jobYears'+list+'-'+num+'" />\n\
				<span class="required" id="jobYears'+list+'-'+num+'Req">*</span>\n\
				<label>Months at Job</label>\n\
				<input type="text" class="months" name="jobMonths'+list+'-'+num+'" />\n\
				<span class="required" id="jobMonths'+list+'-'+num+'Req">*</span>\n\
				</div>\n\
				<a class="remJob" title="Remove Job" onclick="remJob('+list+', '+num+');">Remove Job</a>';
}


function addAddress(list, num) {
	//add new address div inside Addresses
	var addressList = document.getElementById('Addresses'+list);
	var newAddress = document.createElement('div');
	newAddress.setAttribute('id',"Address"+list+"-"+num);
	newAddress.setAttribute('class',"Address");
	newAddress.innerHTML = getAddressFields(list, num);
	addressList.appendChild(newAddress);
	
	//change the addAddress button 
	var addAddress = document.getElementById('addAddress' + list);
	addAddress.setAttribute('class', 'addAddress');
	addAddress.setAttribute('onclick', 'addAddress('+list+', '+(num+1)+');');
	
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent) ){
		var ieversion=new Number(RegExp.$1)
		if (ieversion>=6)
			addAddress.parentNode.innerHTML = addAddress.parentNode.innerHTML;
	}
}

function remAddress(list, num) {
	var remove = confirm("Are you sure you want remove this address?");
	if(remove) {
		var addressList = document.getElementById('Addresses'+list);
		var oldAddress = document.getElementById('Address'+list+'-'+num);
		addressList.removeChild(oldAddress);
	}
}

function addJob(list, num) {
	//add new job div inside Jobs
	var jobList = document.getElementById('Jobs' +list);
	var newJob = document.createElement('div');
	newJob.setAttribute('id',"Job"+list+"-"+num);
	newJob.setAttribute('class',"Job");
	newJob.innerHTML = getJobsFields(list, num);
	jobList.appendChild(newJob);
	
	//change the addJob button 
	var addJob = document.getElementById('addJob' + list);
	addJob.setAttribute('class', 'addJob');
	addJob.setAttribute('onclick', 'addJob('+list+', '+(num+1)+');');
	
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent) ){
		var ieversion=new Number(RegExp.$1) 
		if (ieversion>=6)
			addJob.parentNode.innerHTML = addJob.parentNode.innerHTML;
	}
}

function remJob(list, num) {
	var remove = confirm("Are you sure you want remove this employment?");
	if(remove) {
		var jobList = document.getElementById('Jobs'+list);
		var oldJob = document.getElementById('Job'+list+'-'+num);
		jobList.removeChild(oldJob);
	}
}

function changeBType(bType) {
	var Container;
	var businessDiv = document.getElementById('businessDiv');
	switch(bType)
	{
		case 'soleTrader':
			Container = BusinessDiv("Proprietor");
			BusinessPersonal(Container, 1);
			BusinessAddress(Container, 1);
			BusinessEmployment(Container, 1);
			break;
		case 'partnership':
			Container = BusinessDiv("Partner");
			addRole(Container, "Partner", 1);
			addRole(Container, "Partner", 2);
			break;
		case 'limitedCompany':
			Container = BusinessDiv("Director");
			addRole(Container, "Director", 1);
			addRole(Container, "Director", 2);
			break;
		default:
			businessDiv.innerHTML = ""; ;
	}
}

function addRole(Container, role, list) {
	var fieldset = document.createElement('fieldset');
	fieldset.setAttribute('class', role + " " + list);
	var legend = document.createElement('legend');
	var text = document.createTextNode(role + " " + list);
	legend.appendChild(text);
	fieldset.appendChild(legend);
	BusinessPersonal(fieldset, list);
	BusinessAddress(fieldset, list);
	Container.appendChild(fieldset);
}

function BusinessDiv(Legend) {
	var businessDiv = document.getElementById('businessDiv');
	var fieldset = document.createElement('fieldset');
	fieldset.setAttribute('class', Legend);
	businessDiv.innerHTML = "";
	var legend = document.createElement('legend');
	var text = document.createTextNode(Legend + " Details");
	legend.appendChild(text);
	fieldset.appendChild(legend);
	businessDiv.appendChild(fieldset);
	return fieldset;
}

function BusinessPersonal(Container, num){
	var text = "<div class=\"contactDetails\">\n\
			<label>Title</label>\n\
			<select class=\"title\" name=\"title"+num+"\">\n\
					<option value=\"\">&mdash;&mdash;</option>\n\
					<option value=\"Dr\">Dr</option>\n\
					<option value=\"Miss\">Miss</option>\n\
					<option value=\"Mr\">Mr</option>\n\
					<option value=\"Mrs\">Mrs</option>\n\
					<option value=\"Ms\">Ms</option>\n\
				</select>\n\
				<span class=\"required\" id=\"title"+num+"Req\">*</span>\n\
			<label>First name</label>\n\
				<input type=\"text\" name=\"foreName"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"255\"/>\n\
				<span class=\"required\" id=\"foreName"+num+"Req\">*</span>\n\
			<label>Middle name</label>\n\
				<input type=\"text\" name=\"middleName"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"255\"/>\n\
			<label>Last name</label>\n\
				<input type=\"text\" name=\"surName"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"255\"/>\n\
				<span class=\"required\" id=\"surName"+num+"Req\">*</span>\n\
			<label>Telephone number</label>\n\
				<input type=\"text\" name=\"telNo"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"15\"/>\n\
				<span class=\"required\" id=\"telNo"+num+"Req\">*</span>\n\
			<label>Mobile number</label>\n\
				<input type=\"text\" name=\"mobNo"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"15\"/>\n\
			<label>Email address</label>\n\
				<input type=\"text\" name=\"emailAddress"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"255\"/>\n\
				<span class=\"required\" id=\"emailAddress"+num+"Req\">*</span>\n\
			<label>D.O.B (DD/MM/YYYY)</label>\n\
				<input type=\"text\" name=\"DOB"+num+"\" class=\"contactLine\" value=\"\" maxlength=\"12\"/>\n\
				<span class=\"required\" id=\"DOB"+num+"Req\">*</span>\n\
			<label>Marital Status</label>\n\
				<select class=\"maritalStatus\" name=\"maritalStatus"+num+"\" onchange=\"required(this, 'combobox');\">\n\
					<option value=\"\">Please Select</option>\n\
					<option value=\"Married\">Married</option>\n\
					<option value=\"Single\">Single</option>\n\
					<option value=\"Divorced\">Divorced</option>\n\
					<option value=\"LWP\">Living with Partner</option>\n\
				</select>\n\
				<span class=\"required\" id=\"maritalStatus"+num+"Req\">*</span>\n\
		</div>";
	Container.innerHTML += text;
}

function BusinessAddress(Container, list){
	var text = "\n\<div id=\"Addresses"+list+"\">\n\
			<p>Please provide 5 years address history</p>\n\
			<div id=\"Address"+list+"-1\" class=\"Address\">\n\
				<h4>Current Address</h4>\n\
				<label>Address Line 1</label>\n\
					<input type=\"text\" name=\"addressA"+list+"-1\" class=\"addressLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"addressA"+list+"-1Req\">*</span>\n\
				<label>Address Line 2</label>\n\
					<input type=\"text\" name=\"addressB"+list+"-1\" class=\"addressLine\" value=\"\" maxlength=\"255\"/>\n\
				<label>Town/City</label>\n\
					<input type=\"text\" name=\"addressC"+list+"-1\" class=\"addressLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"addressC"+list+"-1Req\">*</span>\n\
				<label>Postcode</label>\n\
					<input type=\"text\" name=\"postcode"+list+"-1\" class=\"addressLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"postcode"+list+"-1Req\">*</span>\n\
				<label>Accomodation Type</label>\n\
				<select class=\"accomType\" name=\"accomType"+list+"-1\" onchange=\"required(this, 'combobox');\">\n\
					<option value=\"\">Please Select</option>\n\
					<option value=\"Owner\">Owner</option>\n\
					<option value=\"TenantPF\">Tenant (Private Furnished)</option>\n\
					<option value=\"TenantPU\">Tenant (Private Unfurnished)</option>\n\
					<option value=\"TenantC\">Tenant (Council)</option>\n\
					<option value=\"LWP\">Living with Parents</option>\n\
					<option value=\"Other\">Other</option>\n\
				</select>\n\
				<span class=\"required\" id=\"accomType"+list+"-1Req\">*</span>\n\
				<div class=\"addressTerm\">\n\
				<label>Years at Address</label>\n\
				<input type=\"text\" class=\"years\" name=\"addressYears"+list+"-1\">\n\
				<span class=\"required\" id=\"addressYears"+list+"-1Req\">*</span>\n\
				<label>Months at Address</label>\n\
				<input type=\"text\" class=\"months\" name=\"addressMonths"+list+"-1\">\n\
				<span class=\"required\" id=\"addressMonths"+list+"-1Req\">*</span>\n\
				</div>\n\
			</div>\n\
		</div>\n\
		<a id=\"addAddress"+list+"\" class=\"addAddress\" onclick=\"addAddress("+list+", 2);\">Add Address</a>";
	Container.innerHTML += text;
}

function BusinessEmployment(Container, list) {
	var text = "<div id=\"Jobs"+list+"\">\n\
			<p>Please provide 5 years employment history</p>\n\
			<div id=\"Job"+list+"-1\" class=\"Job\">\n\
				<h3>Previous Employment</h3>\n\
				<label>Employer Name</label>\n\
					<input type=\"text\" name=\"jobEmpName"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"jobEmpName"+list+"-1Req\">*</span>\n\
				<label>Address Line 1</label>\n\
					<input type=\"text\" name=\"jobAddressA"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"jobAddressA"+list+"-1Req\">*</span>\n\
				<label>Address Line 2</label>\n\
					<input type=\"text\" name=\"jobAddressB"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"255\"/>\n\
				<label>Town/City</label>\n\
					<input type=\"text\" name=\"jobAddressC"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"jobAddressC"+list+"-1Req\">*</span>\n\
				<label>Postcode</label>\n\
					<input type=\"text\" name=\"jobPostcode"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"jobPostcode"+list+"-1Req\">*</span>\n\
				<label>Telephone number</label>\n\
					<input type=\"text\" name=\"jobTelNo"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"15\"/>\n\
					<span class=\"required\" id=\"jobTelNo"+list+"-1Req\">*</span>\n\
				<label>Occupation</label>\n\
					<input type=\"text\" name=\"jobOccupation"+list+"-1\" class=\"jobLine\" value=\"\" maxlength=\"255\"/>\n\
					<span class=\"required\" id=\"jobOccupation"+list+"-1Req\">*</span>\n\
				<label>Occupation Basis</label>\n\
					<select class=\"jobLine\" name=\"jobBasis"+list+"-1\" onchange=\"required(this, 'combobox');\">\n\
						<option value=\"\">Please Select</option>\n\
						<option value=\"fullTime\">Full Time</option>\n\
						<option value=\"partTime\">Part Time</option>\n\
						<option value=\"selfEmployed\">Self Employed</option>\n\
					</select>\n\
					<span class=\"required\" id=\"jobBasis"+list+"-1Req\">*</span>\n\
				<div class=\"jobTerm\">\n\
				<label>Years Employed</label>\n\
				<input type=\"text\" class=\"years\" name=\"jobYears"+list+"-1\">\n\
				<span class=\"required\" id=\"jobYears"+list+"-1Req\">*</span>\n\
				<label>Months Employed</label>\n\
				<input type=\"text\" class=\"months\" name=\"jobMonths"+list+"-1\">\n\
				<span class=\"required\" id=\"jobMonths"+list+"-1Req\">*</span>\n\
				</div>\n\
			</div>\n\
		</div>\n\
		<a id=\"addJob"+list+"\" class=\"addJob\" onclick=\"addJob("+list+", 2);\">Add Job</a>";
	Container.innerHTML += text;
}