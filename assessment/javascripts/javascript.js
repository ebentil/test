// JavaScript Document

function check_empty(){
	var lname=document.form1.lname;
	var fname=document.form1.fname;
	if (lname.value.length == 0 ) {
		alert("Last Name should not be empty!");
		lname.focus();
		return error;
				
	} else if (fname.value.length == 0) {
		alert("Last Name should not be empty!");
		fname.focus();
		return error;
	}
}