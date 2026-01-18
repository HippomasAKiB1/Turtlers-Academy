

<link rel="stylesheet" href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/css/register.css">

<section class="register-container">
    <div class="register-wrapper">
        <div class="register-card">
            <!-- Logo -->
            <div class="register-header">
                <h1 class="register-title">&lt;Turtlers<span class="accent">Academy</span></h1>
                <p class="register-subtitle">Create your account and start learning</p>
            </div>

            <!-- Registration Form -->
            <form id="registerForm" class="register-form">
                <!-- Account Type Selection -->
                <div class="form-group">
                    <label class="form-label">Account Type</label>
                    <div class="account-type-group">
                        <label class="radio-label">
                            <input type="radio" name="role" value="student" required>
                            <span class="radio-text">
                                <span class="role-title">Student</span>
                                <span class="role-desc">Take courses and learn</span>
                            </span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="role" value="instructor" required>
                            <span class="radio-text">
                                <span class="role-title">Instructor</span>
                                <span class="role-desc">Create and teach courses</span>
                            </span>
                        </label>
                    </div>
                    <span class="error-message" id="roleError"></span>
                </div>

                <!-- Full Name Field -->
                <div class="form-group">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input 
                        type="text" 
                        id="full_name" 
                        name="full_name" 
                        class="form-input" 
                        placeholder="Enter your full name"
                        required>
                    <span class="error-message" id="full_nameError"></span>
                </div>

                <!-- Username Field -->
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input" 
                        placeholder="Choose a username (3-50 characters)"
                        required>
                    <span class="error-message" id="usernameError"></span>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Enter your email address"
                        required>
                    <span class="error-message" id="emailError"></span>
                </div>

                <!-- Institution Field -->
                <div class="form-group">
                    <label for="institution" class="form-label">Institution (Optional)</label>
                    <input 
                        type="text" 
                        id="institution" 
                        name="institution" 
                        class="form-input" 
                        placeholder="Your school, college, or organization">
                    <span class="error-message" id="institutionError"></span>
                </div>

                <!-- Bio Field (for Instructors) -->
                <div class="form-group" id="bioGroup" style="display: none;">
                    <label for="bio" class="form-label">Professional Bio (Optional)</label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        class="form-input form-textarea" 
                        placeholder="Tell students about your experience and expertise"
                        rows="3"></textarea>
                    <span class="error-message" id="bioError"></span>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="Enter a strong password (6+ characters)"
                        required>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirm" 
                        name="password_confirm" 
                        class="form-input" 
                        placeholder="Confirm your password"
                        required>
                    <span class="error-message" id="password_confirmError"></span>
                </div>

                <!-- General Error Message -->
                <div class="alert alert-error" id="errorAlert" style="display: none;">
                    <span id="errorMessage"></span>
                </div>

                <!-- Success Message -->
                <div class="alert alert-success" id="successAlert" style="display: none;">
                    <span id="successMessage">Account created successfully! Redirecting to login...</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-register-submit">
                    <span class="btn-text">Create Account</span>
                    <span class="btn-loader" id="btnLoader" style="display: none;">
                        <i class="spinner"></i>
                    </span>
                </button>
            </form>

            <!-- Sign In Link -->
            <div class="register-footer">
                <p>Already have an account? 
                    <a href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/login.php" class="signin-link">Sign in here</a>
                </p>
            </div>
        </div>

        <!-- Illustration Side -->
        <div class="register-illustration">
            <div class="illustration-content">
                <h2>Join Our Community</h2>
                <p>Start your learning journey with Turtlers Academy</p>
                <div class="benefits">
                    <div class="benefit-item">
                        <span class="benefit-icon">🎓</span>
                        <span>Expert Instructors</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">📚</span>
                        <span>Quality Content</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">🏆</span>
                        <span>Earn Certificates</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">💡</span>
                        <span>Interactive Learning</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/js/register.js"></script>



<?php include __DIR__ . "/../../partials/footer.php"; ?>
