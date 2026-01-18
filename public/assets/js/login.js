/**
 * TURTLERS ACADEMY - LOGIN PAGE SCRIPTS
 * Handles form validation and submission
 */

// ====================================================
// FORM SUBMISSION
// ====================================================

const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const submitBtn = document.querySelector('.btn-login-submit');
const errorAlert = document.getElementById('errorAlert');
const successAlert = document.getElementById('successAlert');
const errorMessage = document.getElementById('errorMessage');
const successMessage = document.getElementById('successMessage');

/**
 * Display error message
 * @param {string} message - Error message to display
 */
function showError(message) {
    errorMessage.textContent = message;
    errorAlert.style.display = 'block';
    successAlert.style.display = 'none';
}

/**
 * Display success message
 * @param {string} message - Success message to display
 */
function showSuccess(message) {
    successMessage.textContent = message;
    successAlert.style.display = 'block';
    errorAlert.style.display = 'none';
}

/**
 * Hide all alerts
 */
function hideAlerts() {
    errorAlert.style.display = 'none';
    successAlert.style.display = 'none';
}

/**
 * Show loading state on button
 */
function showLoading() {
    submitBtn.disabled = true;
    document.querySelector('.btn-text').style.display = 'none';
    document.getElementById('btnLoader').style.display = 'inline-block';
}

/**
 * Hide loading state on button
 */
function hideLoading() {
    submitBtn.disabled = false;
    document.querySelector('.btn-text').style.display = 'inline-block';
    document.getElementById('btnLoader').style.display = 'none';
}

/**
 * Clear field error
 * @param {string} fieldName - Field name (username or password)
 */
function clearFieldError(fieldName) {
    const errorElement = document.getElementById(`${fieldName}Error`);
    const inputElement = document.getElementById(fieldName);
    
    if (errorElement) {
        errorElement.textContent = '';
    }
    if (inputElement) {
        inputElement.classList.remove('error');
    }
}

/**
 * Show field error
 * @param {string} fieldName - Field name (username or password)
 * @param {string} message - Error message
 */
function showFieldError(fieldName, message) {
    const errorElement = document.getElementById(`${fieldName}Error`);
    const inputElement = document.getElementById(fieldName);
    
    if (errorElement) {
        errorElement.textContent = message;
    }
    if (inputElement) {
        inputElement.classList.add('error');
    }
}

/**
 * Validate form before submission
 * @returns {boolean} - True if valid, false otherwise
 */
function validateForm() {
    const username = usernameInput.value.trim();
    const password = passwordInput.value;
    
    let isValid = true;

    // Clear previous errors
    clearFieldError('username');
    clearFieldError('password');

    // Validate username
    if (!username) {
        showFieldError('username', 'Username or email is required');
        isValid = false;
    } else if (username.length < 3) {
        showFieldError('username', 'Username must be at least 3 characters');
        isValid = false;
    }

    // Validate password
    if (!password) {
        showFieldError('password', 'Password is required');
        isValid = false;
    } else if (password.length < 6) {
        showFieldError('password', 'Password must be at least 6 characters');
        isValid = false;
    }

    return isValid;
}

/**
 * Handle form submission
 */
loginForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    // Clear previous alerts
    hideAlerts();

    // Validate form
    if (!validateForm()) {
        return;
    }

    // Show loading state
    showLoading();

    try {
        // Prepare form data
        const formData = new FormData(loginForm);

        // Send login request
        const response = await fetch('login.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            // Show success message
            showSuccess(result.message);

            // Redirect after 2 seconds
            setTimeout(() => {
                window.location.href = result.redirect || 'index.php';
            }, 1500);
        } else {
            // Show error message
            showError(result.message);

            // Show field errors if available
            if (result.errors) {
                Object.keys(result.errors).forEach(field => {
                    showFieldError(field, result.errors[field]);
                });
            }

            hideLoading();
        }
    } catch (error) {
        console.error('Login error:', error);
        showError('An error occurred. Please try again.');
        hideLoading();
    }
});

// ====================================================
// REAL-TIME VALIDATION
// ====================================================

/**
 * Real-time username validation
 */
usernameInput.addEventListener('blur', function() {
    const username = this.value.trim();
    
    if (username && username.length < 3) {
        showFieldError('username', 'Username must be at least 3 characters');
    } else {
        clearFieldError('username');
    }
});

/**
 * Real-time password validation
 */
passwordInput.addEventListener('blur', function() {
    const password = this.value;
    
    if (password && password.length < 6) {
        showFieldError('password', 'Password must be at least 6 characters');
    } else {
        clearFieldError('password');
    }
});

/**
 * Clear errors on input
 */
usernameInput.addEventListener('input', function() {
    if (this.value.trim()) {
        clearFieldError('username');
    }
});

passwordInput.addEventListener('input', function() {
    if (this.value) {
        clearFieldError('password');
    }
});

// ====================================================
// PAGE INITIALIZATION
// ====================================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('Login page initialized');
    // Auto-focus username field
    usernameInput.focus();
});

// ====================================================
// KEYBOARD SHORTCUTS
// ====================================================

/**
 * Allow Enter key to submit form
 */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && (e.target === usernameInput || e.target === passwordInput)) {
        loginForm.dispatchEvent(new Event('submit'));
    }
});
