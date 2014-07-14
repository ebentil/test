// JavaScript Document

function check_empty_name(){
var str=document.getElementById("name");
//check required fields
var elname = document.getElementById("name").name;
if (str.value.length == 0 ) {
alert(elname+" Field should not be empty!")
str.focus()

	}
}

function check_integer(field_id){
  var f_id = field_id;
  //alert(yy);
var str=document.getElementById(f_id);
var numbers = /^[0-9]+$/;
if (!str.value.match(numbers)) {
str.value = str.value.substring(0, str.value.length - 1);
	} else {
		add(f_id);
	}
}

function add(f_id) {
	f_type = f_id.substr(3);
	var field1 = "ex1" + f_type;
	var field2 = "ex2" + f_type;
	var field3 = "ex3" + f_type;
	var field4 = "ex4" + f_type;
	
	var ex_1 =+document.getElementById(field1).value;
	var ex_2 =+document.getElementById(field2).value;
	var ex_3 =+document.getElementById(field3).value;
	var ex_4 =+document.getElementById(field4).value;
	
	 var total = ex_1 + ex_2 + ex_3 + ex_4; 
	//parseInt(total);
	var field_tot = "ex_tot" + f_type;
	
	document.getElementById(field_tot).value = total;
}