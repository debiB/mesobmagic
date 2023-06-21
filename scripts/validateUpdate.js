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
  
  function validateDob() {
	const dobInput = document.getElementById('dob');
	const dobError = document.getElementById('dob-error');
	const dobValue = parseInt(dobInput.value);
  
	if (isNaN(dobValue)) {
	  dobError.innerHTML = 'Date of Birth is required';
	  return false;
	}else if((new Date(dobValue))>= new Date("2013-01-01") ){
		dobError.innerHTML = 'You must be born after 2013-01-01 to use this site.' ;
		return false;
	}
	 else {
	  dobError.innerHTML = '';
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
  function photo() {
    var photoInput = document.getElementById("profileImage");
    var photoError = document.getElementById("photoError");

    if (photoInput.files.length === 0) {
      photoError.textContent = "Photo is required";
      return false;
    } else {
      var allowedFormats = ["jpg", "jpeg", "png"]; 
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
        photoError.textContent = ""; 

        return true;
      }



    }
  }
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
  
  function validateEditForm() {
	const isValidFirstName = validateFirstName();
	const isValidLastName = validateLastName();
	const isValidEmail = validateEmail();
	const isValidPassword = validatePassword();
	const isValidConfirmPassword = validateConfirmPassword();
	const isValidDob = validateDob();
	const isValidJobTitle = validateJobTitle();
	const isValidCountry = validateCountry();
    const isValidPhoto = true;

    console.log(isValidPhoto)
  
	if (
	  isValidFirstName &&
	  isValidLastName &&
	  isValidEmail &&
	  isValidPassword &&
	  isValidConfirmPassword &&
	  isValidDob &&
	  isValidJobTitle &&
	  isValidCountry &&
      isValidPhoto
	) {
	//   alert("Update successful.")
	  return true;
	} else {
	//   document.getElementById('success-message').innerHTML = '';
	  return false;
	}
  }
  
  document.getElementById('edit-form-submit').addEventListener('click', function (event) {
	event.preventDefault(); // Prevent form submission
		if(validateEditForm()){

			var formData = new FormData();
			formData.append('first_name', $('#first-name').val());
			formData.append('last_name', $('#last-name').val());
			formData.append('email', $('#email').val());
			formData.append('pass', $('#password').val());
			formData.append('photo', $('#profileImage')[0].files[0]);
			formData.append('dob', $('#dob').val());
			formData.append('job', $('#job-title').val());
			formData.append('country', $('#country').val());
			formData.append('withPass', $('#chpass').css('display') != "none");

			$.ajax({
				url: '../php/editUser.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
				console.log(response);
				window.location = '../php/home_page.php';
				},
				error: function(xhr, status, error) {
				alert('An error occurred while saving the data.');
				console.log(error);
				}
			});

			
		}
   
  });