function strip_text(value, pattern) {
	if(typeof(pattern) == 'undefined') pattern = / /g;
	return value.replace(pattern, '');
}
function rstrip(value, lookfor) {
	if(value.lastIndexOf(lookfor) == (value.length - lookfor.length)) {
		return value.substring(0, value.lastIndexOf(lookfor));
	}
	return value;
}

function autofill_modcreate_form(form) {
	if(form.modulename.value == '') {
		form.modulename.value = strip_text(form.label.value);
	} else {
		form.modulename.value = strip_text(form.modulename.value);
	}
	if(form.label.value == '') form.label.value = form.modulename.value;
}
function autofill_fldcreate_form(form) {
	var fieldname = form.fieldname.value;
	if(fieldname != '') {
		form.fieldname.value = strip_text(fieldname); // Avoid spaces in fieldname
		if(form.columnname.value == '') form.columnname.value = strip_text(fieldname.toLowerCase());
		//if(form.label.value == '') form.label.value = 'LBL_' + fieldname.toUpperCase();
		if(form.label.value=='')   form.label.value= strip_text(fieldname, / |_/g);
		if(form.trlabel.value=='') form.trlabel.value= form.label.value;
	}
}
function autofill_tbcreate_form(form) {
	/*var tablename = form.tablename.value;
	if(tablename != '') {
		if(form.refcolumn.value == '') {
			var usecolumnname = '';
			if(tablename.indexOf('_') == -1) usecolumnname = tablename;
			else usecolumnname = tablename.substring(tablename.indexOf('_')+1);
			usecolumnname = rstrip(usecolumnname, 'cf');
			usecolumnname = rstrip(usecolumnname, 'rel');
			usecolumnname = usecolumnname + "id";

			form.refcolumn.value = usecolumnname;
		}
	}
	var refcolumn = form.refcolumn.value;
	var tabletype = form.tabletype.value;
	
	var buildquery= '';
	if(tabletype == 'BASE') buildquery = "CREATE TABLE " + tablename + "(" + refcolumn + " INTEGER)";

	if(form.sqlquery.value == '') form.sqlquery.value = buildquery;*/	
}
