/**
 * TURTLERS ACADEMY - AUTHENTICATION POPUP MODULE
 * Displays modal popup when user tries to access protected features without login
 */

// ====================================================
// LOGIN REQUIRED POPUP
// ====================================================

/**
 * Show login required popup modal
 */
function showLoginRequiredPopup() {
    // Create modal if it doesn't exist
    let modal = document.getElementById('login-required-modal');
    
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'login-required-modal';
        modal.className = 'login-required-modal';
        modal.innerHTML = `
            <div class="modal-overlay"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Login Required</h2>
                    <button class="modal-close" onclick="closeLoginRequiredPopup()">&times;</button>
                </div>
                <div class="modal-body">
                    <p>You need to be logged in to access this feature.</p>
                    <p>Create an account or sign in to continue.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeLoginRequiredPopup()">
                        Cancel
                    </button>
                    <a href="login.php" class="btn btn-primary">
                        Log In
                    </a>
                    <a href="register.php" class="btn btn-primary-alt">
                        Sign Up
                    </a>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        
        // Add styles
        addLoginRequiredStyles();
        
        // Add event listeners
        setupLoginRequiredListeners(modal);
    }
    
    // Show modal
    modal.classList.add('active');
}

/**
 * Close login required popup modal
 */
function closeLoginRequiredPopup() {
    const modal = document.getElementById('login-required-modal');
    if (modal) {
        modal.classList.remove('active');
    }
}

/**
 * Add CSS styles for login required modal
 */
function addLoginRequiredStyles() {
    const styleId = 'login-required-styles';
    
    // Check if styles already exist
    if (document.getElementById(styleId)) {
        return;
    }
    
    const style = document.createElement('style');
    style.id = styleId;
    style.textContent = `
        .login-required-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }
        
        .login-required-modal.active {
            display: flex;
        }
        
        .login-required-modal .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
        }
        
        .login-required-modal .modal-content {
            position: relative;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 90%;
            animation: slideUp 0.3s ease;
            overflow: hidden;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-required-modal .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e5e5e5;
        }
        
        .login-required-modal .modal-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        
        .login-required-modal .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            color: #999;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .login-required-modal .modal-close:hover {
            background: #f5f5f5;
            color: #333;
        }
        
        .login-required-modal .modal-body {
            padding: 20px;
        }
        
        .login-required-modal .modal-body p {
            margin: 10px 0;
            color: #666;
            line-height: 1.6;
            font-size: 14px;
        }
        
        .login-required-modal .modal-body p:first-child {
            margin-top: 0;
        }
        
        .login-required-modal .modal-footer {
            display: flex;
            gap: 10px;
            padding: 20px;
            border-top: 1px solid #e5e5e5;
            justify-content: flex-end;
            flex-wrap: wrap;
        }
        
        .login-required-modal .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-required-modal .btn-primary {
            background: #ff7b00;
            color: #ffffff;
        }
        
        .login-required-modal .btn-primary:hover {
            background: #e06a00;
            transform: translateY(-2px);
        }
        
        .login-required-modal .btn-primary-alt {
            background: transparent;
            color: #ff7b00;
            border: 1.5px solid #ff7b00;
        }
        
        .login-required-modal .btn-primary-alt:hover {
            background: #ff7b00;
            color: #ffffff;
        }
        
        .login-required-modal .btn-secondary {
            background: #f5f5f5;
            color: #333;
            border: 1px solid #e5e5e5;
        }
        
        .login-required-modal .btn-secondary:hover {
            background: #e5e5e5;
        }
        
        @media (max-width: 480px) {
            .login-required-modal .modal-content {
                width: 95%;
            }
            
            .login-required-modal .modal-footer {
                flex-direction: column;
            }
            
            .login-required-modal .modal-footer .btn {
                width: 100%;
            }
        }
    `;
    
    document.head.appendChild(style);
}

/**
 * Setup event listeners for login required modal
 * @param {HTMLElement} modal - Modal element
 */
function setupLoginRequiredListeners(modal) {
    // Close when clicking overlay
    const overlay = modal.querySelector('.modal-overlay');
    if (overlay) {
        overlay.addEventListener('click', closeLoginRequiredPopup);
    }
    
    // Close with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeLoginRequiredPopup();
        }
    });
}

// ====================================================
// PROTECTED FUNCTIONS
// ====================================================

/**
 * Enroll in course with protection
 * @param {number} courseId - Course ID
 */
function enrollCourseProtected(courseId) {
    if (!isUserLoggedIn()) {
        showLoginRequiredPopup();
        return;
    }
    
    enrollCourse(courseId);
}

/**
 * Show course details with protection
 * @param {number} courseId - Course ID
 */
function showCourseDetailsProtected(courseId) {
    if (!isUserLoggedIn()) {
        showLoginRequiredPopup();
        return;
    }
    
    showCourseDetails(courseId);
}

/**
 * Check if user is logged in
 * @returns {boolean} - True if logged in, false otherwise
 */
function isUserLoggedIn() {
    return typeof USER_LOGGED_IN !== 'undefined' && USER_LOGGED_IN === true;
}

// ====================================================
// INITIALIZATION
// ====================================================

/**
 * Initialize authentication popup module
 */
function initAuthPopup() {
    console.log('[AUTH-POPUP] Module initialized');
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initAuthPopup();
});

// Also initialize immediately in case DOM is already loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAuthPopup);
} else {
    initAuthPopup();
}
