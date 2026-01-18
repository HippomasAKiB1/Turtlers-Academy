/**
 * TURTLERS ACADEMY - REGISTER PAGE JAVASCRIPT
 * Handles form validation and registration submission
 */

// ====================================================
// FORM HANDLING
// ====================================================

document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const roleRadios = document.querySelectorAll('input[name="role"]');
    const bioGroup = document.getElementById('bioGroup');

    // Show/hide bio field based on role selection
    roleRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'instructor') {
                bioGroup.style.display = 'block';
            } else {
                bioGroup.style.display = 'none';
            }
        });
    });

    // Handle form submission
    if (registerForm) {
        registerForm.addEventListener('submit', handleFormSubmit);
    }

    // Clear field errors on input
    const formInputs = document.querySelectorAll('.form-input');
    formInputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                clearFieldError(this);
            }
        });
    });

    // Listen for radio button changes
    roleRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            clearFieldError(this);
        });
    });
});

// ====================================================
// FORM SUBMISSION
// ====================================================

/**
 * Handle form submission
 * @param {Event} e - Form submission event
 */
function handleFormSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    // Validate form before submission
    if (!validateForm(form)) {
        showError('Please correct the errors below');
        return;
    }

    // Show loading state
    showLoading(form);

    // Submit form via AJAX
    fetch('../app/controllers/registerController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        hideLoading(form);

        if (data.success) {
            showSuccess(data.message);
            // Redirect to login after 2 seconds
            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2000);
        } else {
            showError(data.message);
            // Display field-specific errors
            if (data.errors && Object.keys(data.errors).length > 0) {
                Object.keys(data.errors).forEach(fieldName => {
                    const field = form.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        showFieldError(field, data.errors[fieldName]);
                    }
                });
            }
        }
    })
    .catch(error => {
        hideLoading(form);
        console.error('Error:', error);
        showError('An error occurred. Please try again.');
    });
}

// ====================================================
// VALIDATION FUNCTIONS
// ====================================================

/**
 * Validate entire form
 * @param {HTMLFormElement} form - Form to validate
 * @return {boolean} - True if valid, false otherwise
 */
function validateForm(form) {
    let isValid = true;

    // Get all form inputs (including radio buttons)
    const usernameInput = form.querySelector('input[name="username"]');
    const emailInput = form.querySelector('input[name="email"]');
    const fullNameInput = form.querySelector('input[name="full_name"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const passwordConfirmInput = form.querySelector('input[name="password_confirm"]');
    const roleInputs = form.querySelectorAll('input[name="role"]');
    const institutionInput = form.querySelector('input[name="institution"]');

    // Validate each field
    if (!validateField(usernameInput)) isValid = false;
    if (!validateField(emailInput)) isValid = false;
    if (!validateField(fullNameInput)) isValid = false;
    if (!validateField(passwordInput)) isValid = false;
    if (!validateField(passwordConfirmInput)) isValid = false;
    if (!validateRole(roleInputs)) isValid = false;

    // Check password match
    if (passwordInput.value !== passwordConfirmInput.value) {
        showFieldError(passwordConfirmInput, 'Passwords do not match');
        isValid = false;
    }

    return isValid;
}

/**
 * Validate a single field
 * @param {HTMLInputElement} field - Field to validate
 * @return {boolean} - True if valid, false otherwise
 */
function validateField(field) {
    if (!field) return true;

    const name = field.name;
    const value = field.value.trim();

    clearFieldError(field);

    // Required field validation
    if (!value) {
        const labels = {
            'full_name': 'Full name',
            'username': 'Username',
            'email': 'Email',
            'password': 'Password',
            'password_confirm': 'Password confirmation'
        };
        showFieldError(field, `${labels[name] || name} is required`);
        return false;
    }

    // Field-specific validation
    switch (name) {
        case 'username':
            if (value.length < 3) {
                showFieldError(field, 'Username must be at least 3 characters');
                return false;
            }
            if (value.length > 50) {
                showFieldError(field, 'Username cannot exceed 50 characters');
                return false;
            }
            if (!/^[a-zA-Z0-9_.]+$/.test(value)) {
                showFieldError(field, 'Username can only contain letters, numbers, dots, and underscores');
                return false;
            }
            break;

        case 'email':
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                showFieldError(field, 'Please enter a valid email address');
                return false;
            }
            break;

        case 'full_name':
            if (value.length < 3) {
                showFieldError(field, 'Full name must be at least 3 characters');
                return false;
            }
            break;

        case 'password':
            if (value.length < 6) {
                showFieldError(field, 'Password must be at least 6 characters');
                return false;
            }
            break;

        case 'password_confirm':
            const passwordField = field.form.querySelector('input[name="password"]');
            if (value !== passwordField.value) {
                showFieldError(field, 'Passwords do not match');
                return false;
            }
            break;
    }

    return true;
}

/**
 * Validate role selection
 * @param {NodeList} roleInputs - Role radio buttons
 * @return {boolean} - True if valid
 */
function validateRole(roleInputs) {
    const checked = Array.from(roleInputs).some(radio => radio.checked);

    if (!checked) {
        const errorSpan = document.getElementById('roleError');
        if (errorSpan) {
            errorSpan.textContent = 'Please select an account type';
            errorSpan.classList.add('show');
        }
        return false;
    }

    const errorSpan = document.getElementById('roleError');
    if (errorSpan) {
        errorSpan.classList.remove('show');
    }

    return true;
}

// ====================================================
// ERROR/SUCCESS DISPLAY
// ====================================================

/**
 * Show field-level error
 * @param {HTMLInputElement} field - Form field
 * @param {string} message - Error message
 */
function showFieldError(field, message) {
    field.classList.add('error');

    const errorElementId = field.name + 'Error';
    const errorElement = document.getElementById(errorElementId);

    if (errorElement) {
        errorElement.textContent = message;
        errorElement.classList.add('show');
    }
}

/**
 * Clear field-level error
 * @param {HTMLInputElement} field - Form field
 */
function clearFieldError(field) {
    field.classList.remove('error');

    const errorElementId = field.name + 'Error';
    const errorElement = document.getElementById(errorElementId);

    if (errorElement) {
        errorElement.textContent = '';
        errorElement.classList.remove('show');
    }
}

/**
 * Show error alert
 * @param {string} message - Error message
 */
function showError(message) {
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');

    if (errorMessage) {
        errorMessage.textContent = message;
    }

    if (errorAlert) {
        errorAlert.classList.add('show');
        errorAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

/**
 * Show success alert
 * @param {string} message - Success message
 */
function showSuccess(message) {
    const successAlert = document.getElementById('successAlert');
    const successMessage = document.getElementById('successMessage');

    if (successMessage) {
        successMessage.textContent = message;
    }

    if (successAlert) {
        successAlert.classList.add('show');
        successAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

// ====================================================
// LOADING STATE
// ====================================================

/**
 * Show loading state on submit button
 * @param {HTMLFormElement} form - Form being submitted
 */
function showLoading(form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoader = submitBtn.querySelector('.btn-loader');

    if (submitBtn) {
        submitBtn.disabled = true;
    }

    if (btnText) {
        btnText.style.display = 'none';
    }

    if (btnLoader) {
        btnLoader.style.display = 'inline-block';
    }
}

/**
 * Hide loading state on submit button
 * @param {HTMLFormElement} form - Form being submitted
 */
function hideLoading(form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoader = submitBtn.querySelector('.btn-loader');

    if (submitBtn) {
        submitBtn.disabled = false;
    }

    if (btnText) {
        btnText.style.display = 'inline';
    }

    if (btnLoader) {
        btnLoader.style.display = 'none';
    }
}

// ====================================================
// UTILITY FUNCTIONS
// ====================================================

/**
 * Check if user is logged in
 * @return {boolean} - True if logged in
 */
function isUserLoggedIn() {
    return typeof USER_LOGGED_IN !== 'undefined' && USER_LOGGED_IN === true;
}
