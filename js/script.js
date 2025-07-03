let captchaValue = null;
let isLoading = false;

function checkPasswordStrength(password) {
    const passwordStrengthText = document.getElementById('passwordStrengthText');
    const passwordSuggestionText = document.getElementById('passwordSuggestionText');
    if (!password) {
        passwordStrengthText.textContent = '';
        passwordSuggestionText.textContent = '';
        return;
    }

    if (/[()":]/.test(password)) {
        passwordStrengthText.textContent = 'Password contains forbidden characters';
        passwordStrengthText.style.color = 'red';
        passwordSuggestionText.textContent = '';
        return;
    }

    const hasSpecialChars = /[#$%@!&*]/.test(password);
    const hasNumbers = /\d/.test(password);
    const hasCapitalLetters = /[A-Z]/.test(password);
    let suggestions = [];

    if (hasSpecialChars && hasNumbers && hasCapitalLetters && password.length >= 8) {
        passwordStrengthText.textContent = 'Password strength: Strong';
        passwordStrengthText.style.color = 'green';
        passwordSuggestionText.textContent = 'Great! Your password is strong.';
    } else if ((hasNumbers || hasCapitalLetters) && password.length >= 6) {
        passwordStrengthText.textContent = 'Password strength: Medium';
        passwordStrengthText.style.color = 'orange';
        if (!hasSpecialChars) suggestions.push('add a special character');
        if (!hasNumbers) suggestions.push('add a number');
        if (!hasCapitalLetters) suggestions.push('add a capital letter');
        if (password.length < 8) suggestions.push('make it at least 8 characters');
        passwordSuggestionText.textContent = 'To make your password stronger, ' + suggestions.join(', ') + '.';
    } else {
        passwordStrengthText.textContent = 'Password strength: Weak';
        passwordStrengthText.style.color = 'red';
        suggestions = ['use capital letters', 'use numbers', 'use special characters', 'make it at least 8 characters'];
        passwordSuggestionText.textContent = 'Try to ' + suggestions.join(', ') + ' for a stronger password.';
    }
}

function togglePasswordVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function onCaptchaChange(value) {
    captchaValue = value;
}

function handleSubmit(event) {
    event.preventDefault();
    const errorAlert = document.getElementById('errorAlert');
    const successAlert = document.getElementById('successAlert');
    errorAlert.style.display = 'none';
    successAlert.style.display = 'none';

    const formData = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        confirmPassword: document.getElementById('confirmPassword').value
    };

    if (!formData.firstName || !formData.lastName || !formData.email || !formData.password || !formData.confirmPassword) {
        errorAlert.textContent = 'All fields are required';
        errorAlert.style.display = 'block';
        return;
    }

    if (formData.password !== formData.confirmPassword) {
        errorAlert.textContent = 'Passwords do not match';
        errorAlert.style.display = 'block';
        return;
    }

    if (!captchaValue) {
        errorAlert.textContent = 'Please complete the captcha';
        errorAlert.style.display = 'block';
        return;
    }

    const passwordStrengthText = document.getElementById('passwordStrengthText');
    if (passwordStrengthText.style.color === 'red') {
        errorAlert.textContent = 'Please choose a stronger password';
        errorAlert.style.display = 'block';
        return;
    }

    const submitButton = document.getElementById('submitButton');
    isLoading = true;
    submitButton.textContent = 'Signing Up...';
    submitButton.disabled = true;

    fetch('http://localhost/auth-system/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            first_name: formData.firstName,
            last_name: formData.lastName,
            email: formData.email,
            password: formData.password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            successAlert.textContent = 'Registration successful! You can now login.';
            successAlert.style.display = 'block';
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        } else {
            errorAlert.textContent = data.message || 'Registration failed';
            errorAlert.style.display = 'block';
        }
    })
    .catch(error => {
        errorAlert.textContent = 'Network error. Please try again.';
        errorAlert.style.display = 'block';
    })
    .finally(() => {
        isLoading = false;
        submitButton.textContent = 'Sign Up';
        submitButton.disabled = false;
    });
}

/**
 * Logout confirmation popup for sidebar logout button
 * Shows SweetAlert2 confirmation dialog. If confirmed, redirects to logout.php
 */
document.addEventListener('DOMContentLoaded', function () {
    const logoutLinks = document.querySelectorAll('a[href$="logout.php"]');
    logoutLinks.forEach(function (logoutLink) {
        logoutLink.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Always redirect to the correct logout.php path
                    window.location.href = '/SecureLoginRegister/php/logout.php';
                }
            });
        });
    });
});


