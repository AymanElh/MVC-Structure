<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center mb-4">Register</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <div class="col">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="firstName"
                           class="form-control <?php echo $model->hasError('firstName') ? ' is-invalid' : '' ?>"
                           value="<?php echo $model->firstName; ?>" id="firstName"
                           placeholder="Choose a username">
                    <div class="invalid-feedback"><?php echo $model->getFirstError('firstName'); ?></div>
                </div>
                <div class="col">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="lastName" class="form-control" id="lastName"
                           placeholder="Choose a username">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       placeholder="Create a password"
                >
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword"
                       placeholder="Repeat password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreeTerms">
                <label class="form-check-label" for="agreeTerms">I agree to the Terms and Conditions</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
</div>