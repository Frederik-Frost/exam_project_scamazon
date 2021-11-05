<?php
    $_title = 'Signup';
    require_once(__DIR__.'/../components/header.php'); // This doesnt read variables??
    // require_once('components/header.php'); // this does

    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>   
<div id="signupPage">
    <form id="signupForm" onsubmit="return false">
        <h1>Sign up</h1>
        <div class="formGroup">
            <label for="name">First name</label>
            <input name="name" type="text" placeholder="Enter your first name">
        </div>
        <div class="formGroup">
            <label for="lastName">Last name</label>
            <input name="lastName" type="text" placeholder="Enter your last name">
        </div>
        <div class="formGroup">
            <label for="email">Email</label>
            <input name="email" type="text" placeholder="Enter your email address">
        </div>
        <div class="formGroup">
            <label for="phone">Phone number</label>
            <input name="phone" type="text" placeholder="Enter your phone number">
        </div>
        <div class="formGroup">
            <label for="password">Password</label>
            <input name="password" type="password" placeholder="Enter a password"   autocomplete="on">
        </div>
        <button onclick="signUp()">Sign up</button>
        <span class="txtSmall">Already have an account? <a href="login">login</a> </span>
    </form>
    <div class="succesMessage">
        <p>Thank you for signing up! Check your email and verify your account!</p>
    </div>
</div>
<script src="../js/validator.js"></script> 
<script src="../js/signup.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>