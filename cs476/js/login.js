//login.js
//Javascript to validate form

function ValidateLogin(event){
	var elements = event.currentTarget;

	//store password and email from form into variables
	var email = elements[0].value;
	var password = elements[1].value;
	var formValid = true;

	var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
	var passwordRegex = /^\w{8,}$/;

	document.getElementById("email_msg");
	document.getElementById("password_msg");

	//validate if email is in correct format
	if(!emailRegex.test(email) || email == null || email == "" ){
		//returns formValid as false if email is not valid
		document.getElementById("email_msg").innerHTML="email not valid.";
		formValid = false;
	}

	//check if password is validas
	if(!passwordRegex.test(password) || password == null || password == ""){
		//returns form valid = false and prints error message
		document.getElementById("password_msg").innerHTML="password not valid.";
		formValid = false;
	}

	//prevent form from being submitted if formValid = false;
	if(formValid == false){
		event.preventDefault();
	}

}

function ResetLogin(event){
	document.getElementById("email_msg") = "";
	document.getElementById("password_msg") = "";
	document.getElementById("user_password") = "";
	document.getElementById("user_email") = "";
}