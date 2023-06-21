const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('Login-signup-container');
signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

function validEmail(){
	var formData = new FormData();
	formData.append("check_email", "email");
	formData.append('email', document.getElementById("email").value);
  
	var xhr = new XMLHttpRequest();
	var isEmailValid = true; 
  
	xhr.open("POST", "filterUser.php", false);
  
	xhr.onreadystatechange = function () {
	  if (xhr.readyState === XMLHttpRequest.DONE) {
		if (xhr.status === 200) {
		  console.log(xhr.responseText);
		  if (xhr.responseText === "false") {
			isEmailValid = false;
		  }
		} else {
		  console.log("Request failed with status: " + xhr.status);
		}
	  }
	};
  
	xhr.send(formData);
  
	return isEmailValid;
  

}
function validateSignInEmail() {
	const emailInput = document.getElementById('signin-email');
	const emailError = document.getElementById('signin-email-error');
	const emailValue = emailInput.value.trim();

	if (emailValue === '') {
		emailError.innerHTML = 'Email is required';
		return false;
	} else {
		// if(!validEmail()){
		// emailError.innerHTML = 'Email is not registered.';
		// return false;
		// }
		return true;

	}
}

// Function to validate the Password field in Sign In form
function validateSignInPassword() {
	const passwordInput = document.getElementById('signin-password');
	const passwordError = document.getElementById('signin-password-error');
	const passwordValue = passwordInput.value;

	if (passwordValue === '') {
		passwordError.innerHTML = 'Password is required';
		return false;
	} else if (passwordValue.length < 8) {
		passwordError.innerHTML = 'Password should be at least 8 characters long';
		return false;
	} else {
		passwordError.innerHTML = '';
		return true;
	}
}


var validLogin = function(email, password){
	var formData = new FormData();
	formData.append("func2", "email-pass");
	formData.append('email', email);
	formData.append('password', password);
  
	var xhr = new XMLHttpRequest();
	var isEmailValid = true; 
  
	xhr.open("POST", "filterUser.php", false);
  
	xhr.onreadystatechange = function () {
	  if (xhr.readyState === XMLHttpRequest.DONE) {
		if (xhr.status === 200) {
		  console.log(xhr.responseText);
		  if (xhr.responseText != "") {
			document.getElementById('signin-email-error').innerHTML = xhr.responseText;
			isEmailValid = false;
		  }
		} else {
		  console.log("Request failed with status: " + xhr.status);
		}
	  }
	};
  
	xhr.send(formData);
	return isEmailValid;

}
function validateSignInForm() {
	const isValidSignInEmail = validateSignInEmail();
	const isValidSignInPassword = validateSignInPassword();
	const email = document.getElementById('signin-email').value;
	const pass = document.getElementById('signin-password').value;
	const isValidSignIn = validLogin(email, pass);


	

	if (isValidSignInEmail && isValidSignInPassword && isValidSignIn) {
		return true;
	} else {
		return false;
	}
}

// Event listener for the Sign In form submission
document.getElementById('signin-form').addEventListener('submit', function (event) {
	event.preventDefault(); 

	if (validateSignInForm()) {
		// console.log("here")
		event.target.submit();
		// window.location = "search.php";
		
	}
});


function validateFirstName() {
	const firstNameInput = document.getElementById('first-name');
	const firstNameError = document.getElementById('first-name-error');
	const firstNameValue = firstNameInput.value.trim();
	if (firstNameValue === '') {
		firstNameError.innerHTML = 'First Name is required';
		return false;
	}
	else if (!/^[a-zA-Z0-9-\s]+$/.test(firstNameValue)) {
		firstNameError.innerHTML = 'Invalid first name. First name should contain alphanumeric characters, space, and a hyphen.';
		return false;
	} else {
		firstNameError.innerHTML = '';
		return true;
	}
}

function validateLastName() {
	const lastNameInput = document.getElementById('last-name');
	const lastNameError = document.getElementById('last-name-error');
	const lastNameValue = lastNameInput.value.trim();
	if (lastNameValue === '') {
		lastNameError.innerHTML = 'Last Name is required';
		return false;
	} else if (!/^[a-zA-Z0-9-\s]+$/.test(lastNameValue)) {
		lastNameError.innerHTML = 'Invalid last name. Last name should contain alphanumeric characters, space, and a hyphen.';
		return false;
	} else {
		lastNameError.innerHTML = '';
		return true;
	}
}

function checkEmailValidity() {
	var formData = new FormData();
	formData.append("func", "email");
	formData.append('email', document.getElementById("email").value);
  
	var xhr = new XMLHttpRequest();
	var isEmailValid = true; // Flag to track email validity
  
	xhr.open("POST", "filterUser.php", false);
  
	xhr.onreadystatechange = function () {
	  if (xhr.readyState === XMLHttpRequest.DONE) {
		if (xhr.status === 200) {
		  console.log(xhr.responseText);
		  if (xhr.responseText == "false") {
			// document.getElementById('email-error').innerHTML = "Email is already in use.";
			isEmailValid = false;
		  }
		} else {
		  console.log("Request failed with status: " + xhr.status);
		}
	  }
	};
  
	xhr.send(formData);
  
	return isEmailValid;
  }
  
  
function validateEmail() {
	
	const emailInput = document.getElementById('email');
	const emailError = document.getElementById('email-error');
	const emailValue = emailInput.value.trim();
	emailError.innerHTML = "";


	if (emailValue === '') {
		emailError.innerHTML = 'Email is required';
		return false;
	} else {

		if (!checkEmailValidity()) {
			emailError.innerHTML = "Email is already in use."
			return false
		}
			// emailError.innerHTML = "";
			return true;
		
	}
}

function validatePassword() {
	const passwordInput = document.getElementById('password');
	const passwordError = document.getElementById('password-error');
	const passwordValue = passwordInput.value;

	if (passwordValue === '') {
		passwordError.innerHTML = 'Password is required';
		return false;
	} else if (passwordValue.length < 8) {
		passwordError.innerHTML = 'Password should be at least 8 characters';
		return false;
	} else {
		passwordError.innerHTML = '';
		return true;
	}
}

function validateConfirmPassword() {
	const passwordInput = document.getElementById('password');
	const confirmPasswordInput = document.getElementById('confirm-password');
	const confirmPasswordError = document.getElementById('confirm-password-error');
	const confirmPasswordValue = confirmPasswordInput.value;

	if (confirmPasswordValue === '') {
		confirmPasswordError.innerHTML = 'Confirming your Password is required';
		return false;
	} else if (confirmPasswordValue !== passwordInput.value) {
		confirmPasswordError.innerHTML = 'Passwords do not match';
		return false;
	} else {
		confirmPasswordError.innerHTML = '';
		return true;
	}
}

function validateAge() {
	const ageInput = document.getElementById('age');
	const ageError = document.getElementById('age-error');
	const ageValue = parseInt(ageInput.value);

	if (isNaN(ageValue)) {
		ageError.innerHTML = 'Date of Birth is required';
		return false;
	}
	else {
		ageError.innerHTML = '';
		return true;
	}
}
function validateJobTitle() {
	const jobTitleInput = document.getElementById('job-title');
	const jobTitleError = document.getElementById('job-title-error');
	const jobTitleValue = jobTitleInput.value.trim();
	if (jobTitleValue === '') {
		jobTitleError.innerHTML = 'Job Title is required';
		return false;
	}
	else if (!/^[a-zA-Z0-9-\s]+$/.test(jobTitleValue)) {
		jobTitleError.innerHTML = 'Invalid job title. Job Title should contain alphanumeric characters,space, and a hyphen.';
		return false;
	} else {
		jobTitleError.innerHTML = '';
		return true;
	}
}
function validateProfilePicture() {
	var photoInput = document.getElementById("profile_picture");
	var photoError = document.getElementById("profile-picture-error");

	if (photoInput.files.length === 0) {
		photoError.textContent = "Photo is required";
		return false;
	} else {
		var allowedFormats = ["jpg", "jpeg", "png"]; 
		var file = photoInput.files[0];
		var fileSize = file.size / (1024 * 1024);
		var fileExtension = file.name.split(".").pop().toLowerCase();

		if (!allowedFormats.includes(fileExtension)) {
			photoError.textContent = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
			return false;
		} else if (fileSize > 2) {
			photoError.textContent = "File size exceeds the limit of 2MB.";
			return false;
		} else {
			photoError.textContent = "";
			return true;
		}
	}
}


function validateCountry() {
	const countrySelect = document.getElementById('lsup_country');
	const countryError = document.getElementById('country-error');
	const countryValue = countrySelect.value;
	const othercountry = document.getElementById("other-country-options");
	const othercountryValue = othercountry.value.trim();

	if (countryValue === 'Select a country' && othercountryValue === '') {
		countryError.innerHTML = 'Please select a country';
		return false;
	} if (countryValue != 'Select a country' && othercountryValue != '') {
		countryError.innerHTML = 'Invalid input. Either enter your country on the input field or choose it from dropdown box.';
		return false;
	}
	if (othercountryValue != '' && !/^[a-zA-Z0-9-\s]+$/.test(othercountryValue)) {
		countryError.innerHTML = 'Invalid country name. Country name should contain alphanumeric characters, space, and a hyphen.';
		return false;
	} else {
		countryError.innerHTML = '';
		return true;
	}
}

function validateSignUpForm() {
	const isValidFirstName = validateFirstName();
	const isValidLastName = validateLastName();
	const isValidEmail = validateEmail();
	const isValidPassword = validatePassword();
	const isValidConfirmPassword = validateConfirmPassword();
	const isValidAge = validateAge();
	const isValidJobTitle = validateJobTitle();
	const isValidCountry = validateCountry();
	const isValidpp = validateProfilePicture();

	if (
		isValidFirstName &&
		isValidLastName &&
		isValidEmail &&
		isValidPassword &&
		isValidConfirmPassword &&
		isValidAge &&
		isValidJobTitle &&
		isValidCountry &&
		isValidpp
	) {
		alert("Sign-up successful.")
		return true;
	} else {
		const maincon = document.getElementsByClassName("Login-signup-container")[0];
		maincon.style.height = '170vh';

		return false;
	}
}

document.getElementById('signup-form').addEventListener('submit', function (event) {
	event.preventDefault(); // Prevent form submission

	if (validateSignUpForm()) {
		console.log("succ")
		event.target.submit();

	}
});
function previewProfilePicture(event) {
	var fileInput = event.target;
	var previewImage = document.getElementById("preview_image");

	if (fileInput.files && fileInput.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			previewImage.src = e.target.result;
			previewImage.style.display = "block";
		};

		reader.readAsDataURL(fileInput.files[0]);
	}
}
function resize() {
	const maincon = document.getElementsByClassName("Login-signup-container")[0];
	maincon.style.height = '70rem';
}
function mainResize() {
	const maincon = document.getElementsByClassName("Login-signup-container")[0];
	maincon.style.height = '60rem';
}
function minorResize() {
	const maincon = document.getElementsByClassName("Login-signup-container")[0];
	maincon.style.height = '60rem';
}