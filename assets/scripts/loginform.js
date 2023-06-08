document.addEventListener('DOMContentLoaded', function () {
    var loginContainer = document.getElementById('login-container');
    var loginButton = document.getElementById('login-button');
    var loginForm = loginContainer.querySelector('.dropdown-login');

    loginButton.addEventListener('click', function (event) {
        event.stopPropagation();
        loginContainer.classList.toggle('show');
    });

    document.body.addEventListener('click', function (event) {
        if (!loginForm.contains(event.target) && event.target !== loginButton) {
            loginContainer.classList.remove('show');
        }
    });
});
