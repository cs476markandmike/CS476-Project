//addClient.js
//Holds all the functions for the addCleint page

function ValidateClient(event){
	var elements = event.currentTarget;
	var formValid = true;

	var firstName = elements[1].value;
	var lastName = elements[2].value;
	var phone = elements[3].value;
	var address = elements[4].value;
	var caseType = elements[5].value;

	var phoneRegex = /^\d{10}$/;

	if(firstName == null || firstName == ""){
		document.getElementById("first_name_msg").innerHTML="Please Fill in client first name.";
		formValid = false;
	}

	if(lastName == null || lastName == ""){
		document.getElementById("last_name_msg").innerHTML="Please fill in client last name.";
		formValid = false;
	}

	if(phone == null || phone == "" || !phoneRegex.test(phone)){
		document.getElementById("phone_msg").innerHTML="Please fill in a valid phone number (3065555555).";
		formValid = false;
	}

	if(address == null || address == ""){
		document.getElementById("address_msg").innerHTML="Please fill in client address.";
		formValid = false;
	}

	if(formValid == false){
		event.preventDefault();
	}

}

function ResetClient(event){

}