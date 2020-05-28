//register.js
//JavaScript to validate register form

function ValidateLawyer(event) {
	
	var elements = event.currentTarget;
	var formValid = true;

	var firstName = elements[1].value;
	var lastName = elements[2].value;
	var email = elements[3].value;
	var workPhone = elements[4].value;
	var cellPhone = elements[6].value;
	var address = elements[6].value;
	var firm = elements[7].value;
	var barNumber = elements[8].value;

	var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
	

	//validate user_firstname
	if(firstName == null || firstName == ""){
		document.getElementById("user_firstname_msg").innerHTML="Please fill in your first name.";
		formValid = false;
	}

	if(lastName == null || lastName == ""){
		document.getElementById("user_lastname_msg").innerHTML="Please fill in your last name.";
		formValid = false;
	}

	if(!emailRegex.test(email) || email == null || email == ""){
		document.getElementById("user_email_msg").innerHTML="invalid email.";
		formValid = false;
	}

	if(workPhone == null || workPhone == ""){
		document.getElementById("user_workphone_msg").innerHTML="Please enter a valid phone number (13065555555).";
		formValid = false;
	}

	if(cellPhone == null || cellPhone == ""){
		document.getElementById("user_cellphone_msg").innerHTML="Please enter a valid phone number (13065555555).";
		formValid = false;
	}

	if(address == null || address == ""){
		document.getElementById("user_address_msg").innerHTML="Please fill in your firm's address.";
		formValid = false;
	}

	if(firm == null || firm == ""){
		document.getElementById("user_firm_msg").innerHTML="Please fill in your firm's name";
		formValid = false;
	}

	if(barNumber == null || barNumber == ""){
		document.getElementById("user_bar_msg").innerHTML="Please enter your bar number.";
		formValid = false;
	}

	if(formValid == false){
		event.preventDefault();
	}

}

function ResetRegister(event){

}