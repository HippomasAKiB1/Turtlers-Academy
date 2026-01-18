/**
 * TURTLERS ACADEMY - HOME PAGE SCRIPTS
 * Handles course details popup and enrollment functionality
 */

// ====================================================
// COURSE DETAILS POPUP
// ====================================================

/**
 * Show course details in popup
 * @param {number} courseId - The course ID
 */
function showCourseDetails(courseId) {
    if (!courseId || isNaN(courseId)) {
        console.error('Invalid course ID');
        return;
    }

    const popup = document.getElementById('course-popup');
    const popupBody = document.getElementById('popup-body');

    // Show loading state
    popupBody.innerHTML = '<p style="text-align: center; color: #666;">Loading course details...</p>';
    popup.classList.add('active');

    // Fetch course details
    fetch(`course.php?action=courseDetails&id=${courseId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            popupBody.innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading course details:', error);
            popupBody.innerHTML = '<p style="color: red;">Error loading course details. Please try again.</p>';
        });
}

/**
 * Close course details popup
 */
function closeCoursePopup() {
    const popup = document.getElementById('course-popup');
    popup.classList.remove('active');
    setTimeout(() => {
        document.getElementById('popup-body').innerHTML = '';
    }, 300);
}

// Close popup when clicking outside of it
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('course-popup');

    if (popup) {
        window.addEventListener('click', function(event) {
            if (event.target === popup) {
                closeCoursePopup();
            }
        });
    }
});

// ====================================================
// ENROLLMENT FUNCTIONALITY
// ====================================================

/**
 * Check if user is logged in
 * @returns {boolean} - True if logged in, false otherwise
 */
function isUserLoggedIn() {
    return typeof USER_LOGGED_IN !== 'undefined' && USER_LOGGED_IN === true;
}

/**
 * Enroll student in a course with login check
 * @param {number} courseId - The course ID to enroll in
 */
function enrollCourse(courseId) {
    if (!courseId || isNaN(courseId)) {
        console.error('Invalid course ID');
        return;
    }

    // Check if user is logged in
    if (!isUserLoggedIn()) {
        // Show login required popup
        if (typeof showLoginRequiredPopup === 'function') {
            showLoginRequiredPopup();
        } else {
            alert('Please log in to enroll in a course.');
            window.location.href = 'login.php';
        }
        return;
    }

    // Redirect to enrollment page with course ID
    window.location.href = `enroll.php?id=${courseId}`;
}

// ====================================================
// SMOOTH SCROLLING
// ====================================================

/**
 * Smooth scroll to section
 * @param {string} sectionId - The section ID to scroll to
 */
function smoothScroll(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// ====================================================
// UTILITY FUNCTIONS
// ====================================================

/**
 * Escape HTML special characters for safe display
 * @param {string} text - Text to escape
 * @returns {string} Escaped text
 */
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

/**
 * Format price to currency format
 * @param {number} price - Price value
 * @returns {string} Formatted price
 */
function formatPrice(price) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(price);
}

/**
 * Truncate text to specified length
 * @param {string} text - Text to truncate
 * @param {number} maxLength - Maximum length
 * @returns {string} Truncated text
 */
function truncateText(text, maxLength = 100) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + '...';
    }
    return text;
}

// ====================================================
// PAGE INITIALIZATION
// ====================================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize page
    initializeHome();
});

function initializeHome() {
    console.log('Home page initialized');
    // Add any initialization logic here
}

// ====================================================
// DEBUG LOGGING (can be disabled in production)
// ====================================================

/**
 * Log debug information
 * @param {string} message - Debug message
 * @param {*} data - Additional data to log
 */
function debugLog(message, data = null) {
    if (typeof DEBUG !== 'undefined' && DEBUG) {
        console.log(`[HOME] ${message}`, data || '');
    }
}
