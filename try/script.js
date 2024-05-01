document.addEventListener("DOMContentLoaded", function () {
    var loginForm = document.querySelector('.login-container form');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        // Get the values of email and password input fields
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Perform any necessary validation here

        // Redirect to home.html
        window.location.href = 'home.html';
    });
});

