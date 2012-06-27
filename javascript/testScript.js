function getAddressFields(num) {
return '<h3>Previous Address</h3>\n\
				<label>Address Line 1</label>\n\
					<input type="text" name="addressA'+num+'" class="addressLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="addressA'+num+'Req">*</span>\n\
				<label>Address Line 2</label>\n\
					<input type="text" name="addressB'+num+'" class="addressLine" value="" maxlength="255"/>\n\
				<label>Town/City</label>\n\
					<input type="text" name="addressC'+num+'" class="addressLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="addressC'+num+'Req">*</span>\n\
				<label>Postcode</label>\n\
					<input type="text" name="postcode'+num+'" class="addressLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="postcode'+num+'Req">*</span>\n\
				<label>Accomodation Type</label>\n\
				<select class="accomType" name="accomType'+num+'" onchange="required(this);">\n\
					<option value="">&mdash;&mdash;&nbsp;Please select&nbsp;&mdash;&mdash;</option>\n\
					<option value="Owner">Owner</option>\n\
					<option value="TenantPF">Tenant (Private Furnished)</option>\n\
					<option value="TenantPU">Tenant (Private Unfurnished)</option>\n\
					<option value="TenantC">Tenant (Council)</option>\n\
					<option value="LWP">Living with Parents</option>\n\
					<option value="Other">Other</option>\n\
				</select>\n\
				<span class="required" id="accomType'+num+'Req">*</span>\n\
				<div class="addressTerm">\n\
				<label>Years at Address</label>\n\
				<select class="years" name="addressYears'+num+'">\n\
					<option value="0">0</option>\n\
					<option value="1">1</option>\n\
					<option value="2">2</option>\n\
					<option value="3">3</option>\n\
					<option value="4">4</option>\n\
					<option value="5">5</option>\n\
				</select>\n\
				<label>Months at Address</label>\n\
				<select class="months" name="addressMonths'+num+'">\n\
					<option value="0">0</option>\n\
					<option value="1">1</option>\n\
					<option value="2">2</option>\n\
					<option value="3">3</option>\n\
					<option value="4">4</option>\n\
					<option value="5">5</option>\n\
					<option value="6">6</option>\n\
					<option value="7">7</option>\n\
					<option value="8">8</option>\n\
					<option value="9">9</option>\n\
					<option value="10">10</option>\n\
					<option value="11">11</option>\n\
					<option value="12">12</option>\n\
				</select>\n\
				</div>\n\
				<a class="remAddress" onclick="remAddress('+num+');">Remove Address</a>';
}

function getJobsFields(num){
	return '<h3>Previous Employment</h3>\n\
				<label>Employer Name</label>\n\
					<input type="text" name="jobEmpName'+num+'" class="jobLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="jobEmpName'+num+'Req">*</span>\n\
				<label>Address Line 1</label>\n\
					<input type="text" name="jobAddressA'+num+'" class="jobLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="jobAddressA'+num+'Req">*</span>\n\
				<label>Address Line 2</label>\n\
					<input type="text" name="jobAddressB'+num+'" class="jobLine" value="" maxlength="255"/>\n\
				<label>Town/City</label>\n\
					<input type="text" name="jobAddressC'+num+'" class="jobLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="jobAddressC'+num+'Req">*</span>\n\
				<label>Postcode</label>\n\
					<input type="text" name="jobPostcode'+num+'" class="jobLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="jobPostcode'+num+'Req">*</span>\n\
				<label>Telephone number</label>\n\
					<input type="text" name="jobTelNo'+num+'" class="jobLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="jobTelNo'+num+'Req">*</span>\n\
				<label>Occupation</label>\n\
					<input type="text" name="jobOccupation'+num+'" class="jobLine" value="" onchange="required(this);" maxlength="255"/>\n\
					<span class="required" id="jobOccupation'+num+'Req">*</span>\n\
				<label>Occupation Basis</label>\n\
					<select class="basis" name="jobBasis'+num+'" onchange="required(this);">\n\
						<option value=""></option>\n\
						<option value="fullTime">Full Time</option>\n\
						<option value="partTime">Part Time</option>\n\
						<option value="selfEmployed">Self Employed</option>\n\
					</select>\n\
					<span class="required" id="jobBasis'+num+'Req">*</span>\n\
				<div class="jobTerm">\n\
				<label>Years at Job</label>\n\
				<select class="years" name="jobYears'+num+'">\n\
					<option value="0">0</option>\n\
					<option value="1">1</option>\n\
					<option value="2">2</option>\n\
					<option value="3">3</option>\n\
					<option value="4">4</option>\n\
					<option value="5">5</option>\n\
				</select>\n\
				<label>Months at Job</label>\n\
				<select class="months" name="jobMonths'+num+'">\n\
					<option value="0">0</option>\n\
					<option value="1">1</option>\n\
					<option value="2">2</option>\n\
					<option value="3">3</option>\n\
					<option value="4">4</option>\n\
					<option value="5">5</option>\n\
					<option value="6">6</option>\n\
					<option value="7">7</option>\n\
					<option value="8">8</option>\n\
					<option value="9">9</option>\n\
					<option value="10">10</option>\n\
					<option value="11">11</option>\n\
					<option value="12">12</option>\n\
				</select>\n\
				</div>\n\
				<a class="remJob" onclick="remJob('+num+');">Remove Job</a>';
}

function addAddress(num) {
	//add new address div inside Addresses
	var addressList = document.getElementById('Addresses');
	var newAddress = document.createElement('div');
	newAddress.setAttribute('id',"Address"+num);
	newAddress.setAttribute('class',"Address");
	newAddress.innerHTML = getAddressFields(num);
	addressList.appendChild(newAddress);
	
	//change the addAddress button 
	var addAddress = document.getElementById('addAddress');
	addAddress.setAttribute('onclick', 'addAddress('+(num+1)+');');
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent) ){
		var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
		if (ieversion>=6)
			addAddress.parentNode.innerHTML = addAddress.parentNode.innerHTML;
	}
}

function remAddress(num) {
	var remove = confirm("Are you sure you want remove this address?");
	if(remove) {
		var addressList = document.getElementById('Addresses');
		var oldAddress = document.getElementById('Address'+num);
		addressList.removeChild(oldAddress);
	}
}

function addJob(num) {
	//add new job div inside Jobs
	var jobList = document.getElementById('Jobs');
	var newJob = document.createElement('div');
	newJob.setAttribute('id',"Job"+num);
	newJob.setAttribute('class',"Job");
	newJob.innerHTML = getJobsFields(num);
	jobList.appendChild(newJob);
	
	//change the addJob button 
	var addJob = document.getElementById('addJob');
	addJob.setAttribute('onclick', 'addJob('+(num+1)+');');
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent) ){
		var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
		if (ieversion>=6)
			addJob.parentNode.innerHTML = addJob.parentNode.innerHTML;
	}
}

function remJob(num) {
	var remove = confirm("Are you sure you want remove this address?");
	if(remove) {
		var jobList = document.getElementById('Jobs');
		var oldJob = document.getElementById('Job'+num);
		jobList.removeChild(oldJob);
	}
}

function required(inputName) {
	if (inputName.value==null||inputName.value==""||inputName.selectedIndex == 0){
		var name = inputName.name + "Req";
		var requiredSpan = document.getElementById(name);
		requiredSpan.innerHTML = "*";
	}
	else{
		var name = inputName.name + "Req";
		var requiredSpan = document.getElementById(name);
		requiredSpan.innerHTML = "";
	}
}

function validEmail(email){
	var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if(pattern.test(email.value))
	{
		alert("!");
	}
}