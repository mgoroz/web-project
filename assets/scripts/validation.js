function validateForm() {
    let name = document.forms["bookingForm"]["name"].value;
    let email = document.forms["bookingForm"]["email"].value;
    let phone = document.forms["bookingForm"]["phone"].value;
    let address = document.forms["bookingForm"]["address"].value;
  
    if (!validateName(name)) {
      alert("Invalid name.");
      return false;
    }
  
    if (!validateEmail(email)) {
      alert("Invalid email.");
      return false;
    }
  
    if (!validatePhone(phone)) {
      alert("Invalid phone.");
      return false;
    }
  
    if (!validateAddress(address)) {
      alert("Invalid address.");
      return false;
    }
  
    return true;
  }
  
  function validateName(name) {
    return /^[a-zA-Z-' ]+$/.test(name);
  }
  
  function validateEmail(email) {
    return /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email);
  }
  
  function validatePhone(phone) {
    return /^[0-9\-\(\)\/\+\s]*$/.test(phone);
  }
  
  function validateAddress(address) {
    return !/;/.test(address);
  }
  