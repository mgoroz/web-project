// Validation for login.php
function validateLoginForm(form) {
    const username = form.querySelector('input[name="username"]').value.trim();
    const password = form.querySelector('input[name="password"]').value.trim();

    if (username === "" || password === "") {
        alert("Please fill in all the fields.");
        return false;
    }
    return true;
}

// Validation for register.php
function validateRegisterForm(form) {
    const username = form.querySelector('input[name="username"]').value.trim();
    const email = form.querySelector('input[name="email"]').value.trim();
    const password = form.querySelector('input[name="password"]').value.trim();

    if (username === "" || email === "" || password === "") {
        alert("Please fill in all the fields.");
        return false;
    } else if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }
    return true;
}


function submitLoginForm(form, errorMessageElementId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "https://enos.itcollege.ee/~mgoroz/ics0008_group_project/utility/login.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = xhr.responseText.trim();
        if (response === "success") {
          window.location.href = "https://enos.itcollege.ee/~mgoroz/ics0008_group_project/index.php";
        } else {
          var errorElement = document.getElementById(errorMessageElementId);
          errorElement.innerText = response;
          errorElement.style.display = "block";
        }
      }
    }
  };

  var formData = new FormData(form);
  var encodedData = new URLSearchParams(formData).toString();
  xhr.send(encodedData);

  return false;
}

  