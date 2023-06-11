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
    const passwordField = document.getElementById('chpass');
  
    if(passwordField.style.display == "none"){return true;}
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
    const passwordField = document.getElementById('chpass');
	const confirmPasswordValue = confirmPasswordInput.value;
    if(passwordField.style.display == "none"){return true;}
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
  function photo() {
    var photoInput = document.getElementById("profileImage");
    var photoError = document.getElementById("photoError");

    if (photoInput.files.length === 0) {
      photoError.textContent = "Photo is required";
      return false;
    } else {
      var allowedFormats = ["jpg", "jpeg", "png"]; // Add more allowed formats if needed
      var fileExtension = photoInput.files[0].name.split(".").pop().toLowerCase();
      var file = photoInput.files[0];
  
    var maxSize = 2 * 1024 * 1024; 
    
    if (file.size > maxSize) {
      photoError.textContent = "The selected photo exceeds 2 MB.";
      return false;
    } 
   
      if (!allowedFormats.includes(fileExtension)) {
        photoError.textContent = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
        return false;
      } else {
        photoError.textContent = ""; // Clear any previous error message
        return true;
      }



    }
  }
  // Function to validate the Country field in Sign Up form
function validateCountry() {
	const countrySelect = document.getElementById('country');
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
  function validateEditForm() {
	const isValidFirstName = validateFirstName();
	const isValidLastName = validateLastName();
	const isValidEmail = validateEmail();
	const isValidPassword = validatePassword();
	const isValidConfirmPassword = validateConfirmPassword();
	const isValidAge = validateAge();
	const isValidJobTitle = validateJobTitle();
	const isValidCountry = validateCountry();
    const isValidPhoto = photo();

    console.log(isValidPhoto)
  
	if (
	  isValidFirstName &&
	  isValidLastName &&
	  isValidEmail &&
	  isValidPassword &&
	  isValidConfirmPassword &&
	  isValidAge &&
	  isValidJobTitle &&
	  isValidCountry &&
      isValidPhoto
	) {
	  alert("Update successful.")
	  return true;
	} else {
	//   document.getElementById('success-message').innerHTML = '';
	  return false;
	}
  }
  
  // Event listener for the Sign Up form submission
  document.getElementById('edit-form-submit').addEventListener('click', function (event) {
	// event.preventDefault(); // Prevent form submission
   
  });