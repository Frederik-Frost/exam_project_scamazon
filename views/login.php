<?php
    $_title = 'Login';
    require_once(__DIR__.'/../components/header.php'); // This doesnt read variables??
    // require_once('components/header.php'); // this does

    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>   
<div id="loginPage" class="mainContainer">
    <!-- <form onsubmit="validate(login); return false"> -->
    <form onsubmit="return false" id="loginForm">
    <span class="infoTxt"></span>
        <h1>Login</h1>
        <div class="formGroup">
            <label for="email">Email</label>
            <input
            id="emailInput" 
            type="text" 
            name="email" 
            placeholder="Enter email"
            >
        </div>
        <div class="formGroup">
            <label for="password">Password</label>
            <input 
                id="passwordInput"
                type="password"
                name="password" 
                placeholder="Enter password"
                data-validate="str"
                data-min="6"
                data-max="20"
                autocomplete="on"
            >
        </div>
        <span class="errorMsg"></span>
        <button type="submit" onclick="login(event)">Login</button>
       <div class="alternateActions">
           <span class="txtSmall">No account? <a href="signup">Sign up</a> </span> 
           
           <span class="forgot-password">Forgot you password? <button onclick="toggleReset()" class="btn btnSmall">Reset</button> </span>
       </div>
    </form>
    <form onsubmit="return false" id="forgotPasswordForm" class="hidden">
        <h1>Forgot password</h1>
        <span>Enter your email address and we will sent you a link to reset your password</span>
        <div class="formGroup">
            <label for="email">Email</label>
            <input
            id="emailInputReset" 
            type="text" 
            name="email" 
            placeholder="Enter email"
            >
        </div>
        <span class="feedbackMsg"></span>
        <button type="submit" onclick="onResetPassword(event)">Send link</button>
        <span class="forgot-password">Back to<button onclick="toggleReset()" class="btn btnSmall">Login</button> </span>
    </form>
</div>

<script src="../js/validator.js"></script>
<script src="../js/login.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>