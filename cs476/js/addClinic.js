function validateClinic(event){
	var elements = event.currentTarget;
	var formGood = true;

	var date = elements[1].value;
	var dateRegex = /^((0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01])[- /.](19|20)?[0-9]{2})*$/;

	if(date == null || date == "" || !dateRegex.test(date)){
		formGood = false;
		document.getElementById("date_msg").innerHTML="Date is not in proper format. Must Be (mm/dd/yyyy)";
	}

	if(formGood == false){
		event.preventDefault();
	}
}