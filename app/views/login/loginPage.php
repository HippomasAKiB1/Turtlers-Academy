<?php include __DIR__ . "/../partials/header.php"; ?>

<link rel="stylesheet" href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/css/login.css">

<section class="login-container">
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Logo -->
            <div class="login-header">
                <h1 class="login-title">&lt;Turtlers<span class="accent">Academy</span></h1>
                <p class="login-subtitle">Welcome back! Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="login-form">
                <!-- Username Field -->
                <div class="form-group">
                    <label for="username" class="form-label">Username or Email</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input" 
                        placeholder="Enter your username or email"
                        required>
                    <span class="error-message" id="usernameError"></span>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="Enter your password"
                        required>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-footer">
                    <label class="checkbox-label">
                        <input type="checkbox" id="rememberMe" name="rememberMe">
                        <span>Remember me</span>
                    </label>
                    <a href="#forgot" class="forgot-link">Forgot password?</a>
                </div>

                <!-- General Error Message -->
                <div class="alert alert-error" id="errorAlert" style="display: none;">
                    <span id="errorMessage"></span>
                </div>

                <!-- Success Message -->
                <div class="alert alert-success" id="successAlert" style="display: none;">
                    <span id="successMessage">Login successful! Redirecting...</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login-submit">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-loader" id="btnLoader" style="display: none;">
                        <i class="spinner"></i>
                    </span>
                </button>
            </form>

            <!-- Sign Up Link -->
            <div class="login-footer">
                <p>Don't have an account? 
                    <a href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/register.php" class="signup-link">Create one now</a>
                </p>
            </div>
        </div>

        <!-- Illustration Side -->
        <div class="login-illustration">
            <div class="illustration-content">
                <h2>Learn with Turtlers Academy</h2>
                <p>Join thousands of students exploring new skills and knowledge</p>
                <div class="features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Expert instructors</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Flexible learning</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Certificates</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/js/login.js"></script>

<?php include __DIR__ . "/../../partials/footer.php"; ?>
