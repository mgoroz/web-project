document.addEventListener('DOMContentLoaded', function () {
    var changePasswordButton = document.getElementById('change-password-button');
    var changePasswordFormContainer = document.getElementById('change-password-form-container');
    
    changePasswordButton.addEventListener('click', function () {
      if (changePasswordFormContainer.style.display === 'none') {
        changePasswordFormContainer.style.display = 'block';
      } else {
        changePasswordFormContainer.style.display = 'none';
      }
    });
});

function validateChangePasswordForm(form) {
  const currentPassword = form.current_password.value.trim();
  const newPassword = form.new_password.value.trim();
  const confirmPassword = form.confirm_password.value.trim();

  if (currentPassword === "") {
    alert("Please enter your current password.");
    return false;
  }

  if (newPassword === "" || confirmPassword === "") {
    alert("Please enter your new password and confirm it.");
    return false;
  }

  if (newPassword !== confirmPassword) {
    alert("New passwords do not match.");
    return false;
  }

  return true;
}
