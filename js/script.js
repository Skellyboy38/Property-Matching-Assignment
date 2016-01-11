var email = false;
var login = false;
var phoneNumber = false;
var password = false;
var confirm = false;
var firstName = false;
var lastName = false;

function validateFirstName() {		//Method to validate the first name
	var x = document.getElementById("register").first_name.value;	//Gets the value of the first name text field
	var check = document.createElement("img");						//Create two elements of type image
	var ex = document.createElement("img");
	var source = document.getElementById("imageFirstName");			//Source targets the empty span where the image will appear

	check.src = "../images/check.jpg";		//The source of each image file (a check mark and an "x")
	ex.src = "../images/x.jpg";
	ex.height = 15;							//Dimensions of the images
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {				//If a node exists, remove it before continuing (gets rid of the appended image)
		source.removeChild(source.firstChild);
	}
	if(x.search(/[A-Za-z\-]+$/) != 0) {		//Write a check or an x to the html file depending on if the regular expression was met
		source.appendChild(ex);
		firstName = false;
	}
	else {
		source.appendChild(check);
		firstName = true;
	}
}
//From here on out, every function behaves the same way as "validateFirstName()" (see above for the logic)
function validateLastName() {
	var x = document.getElementById("register").last_name.value;
	var check = document.createElement("img");
	var ex = document.createElement("img");
	var source = document.getElementById("imageLastName");

	check.src = "../images/check.jpg";
	ex.src = "../images/x.jpg";
	ex.height = 15;
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {
		source.removeChild(source.firstChild);
	}
	if(x.search(/[A-Za-z\-]+$/) != 0) {
		source.appendChild(ex);
		lastName = false;
	}
	else {
		source.appendChild(check);
		lastName = true;
	}
}

function validatePhoneNumber() {
	var x = document.getElementById("register").phone_number.value;
	var check = document.createElement("img");
	var ex = document.createElement("img");
	var source = document.getElementById("imagePhone");

	check.src = "../images/check.jpg";
	ex.src = "../images/x.jpg";
	ex.height = 15;
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {
		source.removeChild(source.firstChild);
	}
	if(x.search(/\(\d{3}\)\d{3}\-\d{4}$/) < 0) {
		source.appendChild(ex);
		phoneNumber = false;
	}
	else {
		source.appendChild(check);
		phoneNumber = true;
	}
}

function validateEmail() {
	var x = document.getElementById("register").email.value;
	var check = document.createElement("img");
	var ex = document.createElement("img");
	var source = document.getElementById("imageEmail");

	check.src = "../images/check.jpg";
	ex.src = "../images/x.jpg";
	ex.height = 15;
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {
		source.removeChild(source.firstChild);
	}
	if(x.search(/[\w\.]*@[A-Za-z0-9]+\.[A-Za-z0-9]+$/) != 0) {
		source.appendChild(ex);
		email = false;
	}
	else {
		source.appendChild(check);
		email = true;
	}
}

function validateLogin() {
	var x = document.getElementById("register").login.value;
	var check = document.createElement("img");
	var ex = document.createElement("img");
	var source = document.getElementById("imageLogin");

	check.src = "../images/check.jpg";
	ex.src = "../images/x.jpg";
	ex.height = 15;
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {
		source.removeChild(source.firstChild);
	}
	if(x.search(/[A-Za-z0-9]{6,}$/) != 0) {
		source.appendChild(ex);
		login = false;
	}
	else {
		source.appendChild(check);
		login = true;
	}
}

function validatePassword() {
	var x = document.getElementById("register").password.value;
	var check = document.createElement("img");
	var ex = document.createElement("img");
	var source = document.getElementById("imagePassword");

	check.src = "../images/check.jpg";
	ex.src = "../images/x.jpg";
	ex.height = 15;
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {
		source.removeChild(source.firstChild);
	}
	if(x.search(/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/) != 0) {
		source.appendChild(ex);
		password = false;
	}
	else {
		source.appendChild(check);
		password = true;
	}
}

function validateConfirm() {
	var x = document.getElementById("register").password_confirm.value;
	var y = document.getElementById("register").password.value;
	var check = document.createElement("img");
	var ex = document.createElement("img");
	var source = document.getElementById("imageConfirm");

	check.src = "../images/check.jpg";
	ex.src = "../images/x.jpg";
	ex.height = 15;
	ex.width = 15;
	check.height = 15;
	check.width = 15;

	while(source.firstChild) {
		source.removeChild(source.firstChild);
	}
	if(x != y) {
		source.appendChild(ex);
		confirm = false;
	}
	else {
		source.appendChild(check);
		confirm = true;
	}
}
//check() makes sure that every variable to be validated is "true" before continuing
function check() {
	var x = document.getElementById("register").first_name.value;
	var y = document.getElementById("register").last_name.value;
	var z = document.getElementById("tennent_radio").checked;
	var w = document.getElementById("owner_radio").checked;

	validateFirstName(); validateLastName(); validatePhoneNumber(); validateEmail(); validateLogin(); validatePassword(); validateConfirm();

	if(login && email && password && confirm && phoneNumber && firstName && lastName
		&& (x.length > 0) && (y.length > 0) && (z || w)) {
		return true;
	}
	else {
		alert("You did not enter all the required information");
		return false;
	}
}
//--------------------------------------------------------------------------------------------------------------------------
var title = false; 
var place = false; 
var price = false; 
var message = false;
var availability = false;

function validateTitle() {
	var titleValue = document.getElementById("ad").title.value;
	if(titleValue.length > 0) {
		title = true;
	}
}

function validateLocation() {
	var locationValue = document.getElementById("ad").location.value;
	if(locationValue.length > 0) {
		place = true;
	}
}

function validatePrice() {
	var priceValue = document.getElementById("ad").price.value;
	if(priceValue.length > 0) {
		price = true;
	}
}

function validateMessage() {
	var messageValue = document.getElementById("ad").message.value;
	if(messageValue.length > 0) {
		message = true;
	}
}

function validateAvailability() {
	var availabilityValue = document.getElementById("ad").availability.value;
	if(availabilityValue.length > 0) {
		availability = true;
	}
}

function validateAd() {

	validateTitle(); validateLocation(); validatePrice(); validateMessage(); validateAvailability(); 
	if(title && place && price && message && availability) {
		return true;
	}
	else {
		alert("You didn't enter all the fields correctly.");
		return false;
	}
}
//--------------------------------------------------------------------------------------------------
function deleteAd() {
	confirm("Are you sure you want to delete this ad?");
}

function tenantProfile() {
	var gender = document.getElementById("new_tenant_profile").gender.checked.value;
	var age = document.getElementById("new_tenant_profile").age.value;
	var occupation = document.getElementById("new_tenant_profile").occupation.value;
	var income = document.getElementById("new_tenant_profile").income.value;

	if(gender.length > 0 && age.length > 0 && occupation.length > 0 && income.length > 0) {
		return true;
	}
	else {
		alert("You didn't fill in all the information.");
		return false;
	}
}