function validateFirstName() {
  var firstName = document.form.firstName.value;
  var alphaExp = /^[a-zA-Z\s]+$/;
  var errorElement = document.getElementById("firstNameError");

  if (!alphaExp.test(firstName)) {
    errorElement.textContent = "Please enter text for your first name!";
    document.form.firstName.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateLastName() {
  var lastName = document.form.lastName.value;
  var alphaExp = /^[a-zA-Z\s]+$/;
  var errorElement = document.getElementById("lastNameError");

  if (!alphaExp.test(lastName)) {
    errorElement.textContent = "Please enter text for your last name!";
    document.form.lastName.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateMatric() {
  var matric = document.form.matric.value;
  var matricExp = /^[a-zA-Z0-9]{9}$/;
  var errorElement = document.getElementById("matricError");

  if (!matric.match(matricExp)) {
    errorElement.textContent =
      "Please provide a valid matric number (9 digits)!";
    document.form.matric.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateIC() {
  var IC = document.form.IC.value;
  var ICExp = /^[0-9]{12}$/;
  var errorElement = document.getElementById("ICError");

  if (!IC.match(ICExp)) {
    errorElement.textContent = "Please provide a valid IC number (12 digits)!";
    document.form.IC.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateContactNo() {
  var contactNo = document.form.contactNo.value;
  var contactNoExp = /^[0-9]{10,11}$/;
  var errorElement = document.getElementById("contactNoError");

  if (!contactNo.match(contactNoExp)) {
    errorElement.textContent =
      "Please provide a valid contact number (10 or 11 digits)!";
    document.form.contactNo.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateEmail() {
  var emailID = document.form.email.value;
  var errorElement = document.getElementById("emailError");

  if (emailID != "") {
    var atPos = emailID.indexOf("@");
    var dotPos = emailID.lastIndexOf(".");
    var emailErrorText;

    if (dotPos != -1 && dotPos - atPos < 2) {
      emailErrorText = "@ and . must be at least 1 character apart";
    }
    if (atPos == 0) {
      emailErrorText = "Email address must not start with @";
    }
    if (atPos == -1) {
      emailErrorText = "Email address must contain @";
    }
    if (dotPos == -1) {
      emailErrorText = "Email address must contain '.'";
    }

    if (emailErrorText != null) {
      errorElement.textContent = emailErrorText;
      document.form.email.focus();
      return false;
    }
  }

  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateCourse() {
  var course = document.form.course.value;
  var alphaExp = /^[A-Za-z\s]+$/;
  var errorElement = document.getElementById("courseError");

  if (!alphaExp.test(course)) {
    errorElement.textContent =
      "Please enter a valid course name (alphabetic characters only)!";
    document.form.course.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateGPA() {
  var gpa = document.form.gpa.value;
  var errorElement = document.getElementById("GPAError");

  if (isNaN(gpa) || gpa < 0 || gpa > 4) {
    errorElement.textContent = "Please provide a valid GPA between 0 and 4.";
    document.form.gpa.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateUsername() {
  var username = document.form.username.value;
  var usernameExp = /^.{4,}$/;
  var errorElement = document.getElementById("usernameError");

  if (!username.match(usernameExp)) {
    errorElement.textContent =
      "Please provide a username with at least 4 characters!";
    document.form.username.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validatePassword() {
  var password = document.form.password.value;
  var passwordExp = /^.{4,}$/;
  var errorElement = document.getElementById("passwordError");

  if (!password.match(passwordExp)) {
    errorElement.textContent =
      "Please provide a password with at least 4 characters!";
    document.form.password.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function studentValidateStudent() {
  return validateContactNo() && validateEmail() && validatePassword();
}

function validateStudent() {
  return (
    validateFirstName() &&
    validateLastName() &&
    validateMatric() &&
    validateIC() &&
    validateContactNo() &&
    validateEmail() &&
    validateCourse() &&
    validateGPA() &&
    validateUsername() &&
    validatePassword()
  );
}

function validateCoordinator() {
  return (
    validateFirstName() &&
    validateLastName() &&
    validateEmail() &&
    validateUsername() &&
    validatePassword()
  );
}

function validateRequiredAmount() {
  var requiredAmount = document.form.requiredAmount.value;
  var errorElement = document.getElementById("requiredAmountError");

  if (requiredAmount <= 0) {
    errorElement.textContent =
      "Please provide a valid Required Amount as a positive integer.";
    document.form.requiredAmount.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateAllowance() {
  var allowance = document.form.allowance.value;
  var errorElement = document.getElementById("allowanceError");

  if (allowance <= 0) {
    errorElement.textContent =
      "Please provide a valid Allowance as a positive integer.";
    document.form.allowance.focus();
    return false;
  }
  errorElement.textContent = ""; // Clear the error message
  return true;
}

function validateTrainingSession() {
  return validateRequiredAmount() && validateAllowance();
}
