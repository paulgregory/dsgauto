<?php
function getSelectMenu($qrySelect, $name, $value, $label, $selected, $first)
{
	$strSelect = "";
	$strSelect = $strSelect . "<select name=\"$name\" onchange=\"doSearch(this.name, this.options[this.selectedIndex].value);\">";
	if($first!=""){
		$strSelect = $strSelect . "<option value=\"\" selected=\"selected\">$first</option> ";
	}
	while ($rstSelect = mysql_fetch_array($qrySelect)){
		$strValue = $rstSelect[$value];
		$strLabel = $rstSelect[$label];
		$strSelected = "";
		if ($first=="" && $selected==$strValue){
			$strSelected = " selected=\"selected\"";
		}
		$strSelect = $strSelect . "<option value=\"$strValue\"$strSelected>$strLabel</option> ";
	}
	$strSelect = $strSelect . "</select>";
	return $strSelect;
}

function getSelectCar($qrySelect, $name, $value, $label, $selected, $first)
{
	$strSelect = "";
	$strSelect = $strSelect . "\n<select name=\"$name\" onchange=\"form.SectionJump.value = 'vehicle';contact.submit();\">\n";
	if($first!=""){
		$strSelect = $strSelect . "<option value=\"\" selected=\"selected\">$first</option>\n";
	}	
	while ($rstSelect = mysql_fetch_array($qrySelect)){
		$strValue = $rstSelect[$value];
		$strLabel = $rstSelect[$label];
		$strSelected = "";
		if ($first=="" && $selected==$strValue){
			$strSelected = " selected";
		}
		$strSelect = $strSelect . "<option value=\"$strValue\"$strSelected>$strLabel</option>\n";
	}
	$strSelect = $strSelect . "</select>\n";
	return $strSelect;
}

function getSelectFinance($qrySelect, $name, $value, $label, $selected, $first)
{
	$strSelect = "";
	$strSelect = $strSelect . "\n<select name=\"$name\" onchange=\"form.SectionJump.value = 'finance';contact.submit();\">\n";
	if($first!=""){
		$strSelect = $strSelect . "<option value=\"\" selected=\"selected\">$first</option>\n";
	}
	while ($rstSelect = mysql_fetch_array($qrySelect)){
		$strValue = $rstSelect[$value];
		$strLabel = $rstSelect[$label];
		$strSelected = "";
		if ($first=="" && $selected==$strValue){
			$strSelected = " selected";
		}
		$strSelect = $strSelect . "<option value=\"$strValue\"$strSelected>$strLabel</option>\n";
	}
	$strSelect = $strSelect . "</select>\n";
	return $strSelect;
}


function getSelConNoRefresh($qrySelect, $name, $value, $label, $selected, $first)
{
	$strSelect = "";
	$strSelect = $strSelect . "\n<select name=\"$name\">\n";
	if($first!=""){
		$strSelect = $strSelect . "<option value=\"\" selected>$first</option>\n";
	}
	while ($rstSelect = mysql_fetch_array($qrySelect)){
		$strValue = $rstSelect[$value];
		$strLabel = $rstSelect[$label];
		$strSelected = "";
		if ($first=="" && $selected==$strValue){
		$strSelected = " selected=\"selected\"";
		}
		$strSelect = $strSelect . "<option value=\"$strValue\"$strSelected>$strLabel</option>\n";
	}
	$strSelect = $strSelect . "</select>\n";
	return $strSelect;
}

function getOptions($options, $values, $name_of_control, $bln_addheader)
{ 
	//Generates a List of Options Based on suppled list csv and values csv.
	//Checks for postback, and selects correct value for display.
	//ARRAYS MUST HABE SAME NUMBER OF ELEMENTS
	//Declare String to store list data
	$OptionList = "";
	//Firstly, split options / values into arrays
	$arrOptions = split(",", $options);
	$arrValues =  split(",", $values);
	if (isset($_POST["$name_of_control"])){
		for ($optioncounter = 0; $optioncounter < count($arrOptions); $optioncounter++){
			if ($_POST["$name_of_control"] == $arrValues[$optioncounter]){
				$OptionList .= "<option value=\"{$arrValues[$optioncounter]}\" selected=\"selected\">{$arrOptions[$optioncounter]}</option>\n";
			}
			else{
				$OptionList .= "<option value=\"{$arrValues[$optioncounter]}\">{$arrOptions[$optioncounter]}</option>\n";
			}
		}
	}
	else{ //Simply Render options
		for ($optioncounter = 0; $optioncounter < count($arrOptions); $optioncounter++){
			$OptionList .= "<option value=\"{$arrValues[$optioncounter]}\">{$arrOptions[$optioncounter]}</option>\n";
		}
	}
	if ($bln_addheader == "1"){
		return "<option value=\"\">--Please Select--</option>" . $OptionList;
	}
	else{
		return $OptionList;
	}
}
?>