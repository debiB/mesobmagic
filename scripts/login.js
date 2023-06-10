const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('Login-signup-container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
// Function to validate the Email field in Sign In form
function validateSignInEmail() {
	const emailInput = document.getElementById('signin-email');
	const emailError = document.getElementById('signin-email-error');
	const emailValue = emailInput.value.trim();
  
	if (emailValue === '') {
	  emailError.innerHTML = 'Email is required';
	  return false;
	} else {
	  emailError.innerHTML = '';
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
  
  // Function to perform overall validation for Sign In form
  function validateSignInForm() {
	const isValidSignInEmail = validateSignInEmail();
	const isValidSignInPassword = validateSignInPassword();
  
	if (isValidSignInEmail && isValidSignInPassword) {
	  return true;
	} else {
	  return false;
	}
  }
  
  // Event listener for the Sign In form submission
  document.getElementById('signin-form').addEventListener('submit', function (event) {
	event.preventDefault(); // Prevent form submission
  
	if (validateSignInForm()) {
	  // If form validation is successful, proceed with submission
	  location.reload();
	}
  });
// Function to validate the First Name field
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
  
  // Function to validate the Last Name field
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
  
  // Function to validate the Email field
  function validateEmail() {
	const emailInput = document.getElementById('email');
	const emailError = document.getElementById('email-error');
	const emailValue = emailInput.value.trim();
  
	if (emailValue === '') {
	  emailError.innerHTML = 'Email is required';
	  return false;
	} else {
	  emailError.innerHTML = '';
	  return true;
	}
  }
  
  // Function to validate the Password field
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
  
  // Function to validate the Confirm Password field
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
  
  // Function to validate the Age field
  function validateAge() {
	const ageInput = document.getElementById('age');
	const ageError = document.getElementById('age-error');
	const ageValue = parseInt(ageInput.value);
  
	if (isNaN(ageValue)) {
	  ageError.innerHTML = 'Age is required';
	  return false;
	}else if(ageValue <= 10){
		ageError.innerHTML = 'Age must be greater than 10';
		return false;
	}
	 else {
	  ageError.innerHTML = '';
	  return true;
	}
  }
  // Function to validate the Job Title field
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
  // Function to validate the Country field in Sign Up form
function validateCountry() {
	const countrySelect = document.getElementById('lsup_country');
	const countryError = document.getElementById('country-error');
	const countryValue = countrySelect.value;
  
	if (countryValue === 'Select a country') {
	  countryError.innerHTML = 'Please select a country';
	  return false;
	} else {
	  countryError.innerHTML = '';
	  return true;
	}
  }
  
  // Function to perform overall validation for Sign Up form
  function validateSignUpForm() {
	const isValidFirstName = validateFirstName();
	const isValidLastName = validateLastName();
	const isValidEmail = validateEmail();
	const isValidPassword = validatePassword();
	const isValidConfirmPassword = validateConfirmPassword();
	const isValidAge = validateAge();
	const isValidJobTitle = validateJobTitle();
	const isValidCountry = validateCountry();
  
	if (
	  isValidFirstName &&
	  isValidLastName &&
	  isValidEmail &&
	  isValidPassword &&
	  isValidConfirmPassword &&
	  isValidAge &&
	  isValidJobTitle &&
	  isValidCountry
	) {
	  alert("Sign-up successful.")
	  return true;
	} else {
	  document.getElementById('success-message').innerHTML = '';
	  return false;
	}
  }
  
  // Event listener for the Sign Up form submission
  document.getElementById('signup-form').addEventListener('submit', function (event) {
	event.preventDefault(); // Prevent form submission
  
	if (validateSignUpForm()) {
	  // If form validation is successful, proceed with submission
	  location.reload();
	}
  });
  