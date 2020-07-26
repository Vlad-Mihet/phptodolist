var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
    password.style.borderColor = 'red';
    confirm_password.style.borderColor = 'red';
  } else {
    confirm_password.setCustomValidity('');
    password.style.borderColor = '#0FCA7F';
    confirm_password.style.borderColor = '#0FCA7F';
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;