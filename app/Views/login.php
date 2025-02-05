<h1 class="mb-3">Login Page</h1>
<?php $form = App\Core\Form\Form::begin("POST");?>

<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordField(); ?>

<div class="d-grid">
    <button type="submit" class="btn btn-success">Login</button>
</div>

<?php echo App\Core\Form\Form::end(); ?>


<!--<div class="container mt-5">-->
<!--    <div class="row">-->
<!--        <!-- Login Form -->-->
<!--        <div class="col-md-6 mb-4">-->
<!--            <div class="form-container">-->
<!--                <h2 class="text-center mb-4">Login</h2>-->
<!--                <form>-->
<!--                    <div class="mb-3">-->
<!--                        <label for="loginEmail" class="form-label">Email address</label>-->
<!--                        <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email"-->
<!--                               required>-->
<!--                    </div>-->
<!--                    <div class="mb-3">-->
<!--                        <label for="loginPassword" class="form-label">Password</label>-->
<!--                        <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password"-->
<!--                               required>-->
<!--                    </div>-->
<!--                    <div class="mb-3 form-check">-->
<!--                        <input type="checkbox" class="form-check-input" id="rememberMe">-->
<!--                        <label class="form-check-label" for="rememberMe">Remember me</label>-->
<!--                    </div>-->
<!--                    <div class="d-grid">-->
<!--                        <button type="submit" class="btn btn-primary">Login</button>-->
<!--                    </div>-->
<!--                    <div class="text-center mt-3">-->
<!--                        <a href="#" class="text-decoration-none">Forgot Password?</a>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->