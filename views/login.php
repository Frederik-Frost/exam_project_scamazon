<?php
    $_title = 'Login';
    require_once(__DIR__.'/../components/header.php');
    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>   
<div id="loginPage" class="mainContainer">
    <div class="logo"> 
        <a href="/"><img src="/../assets/svg/scamlogo-black.svg" alt="scamazon logo"></a>
    </div>
    <form onsubmit="validate(login); return false" id="loginForm">
        <span class="infoTxt"></span>
        <h1>Sign in</h1>
        <div class="formGroup">
            <label for="email">Email</label>
            <input
                id="emailInput" 
                type="text" 
                name="email" 
                placeholder="Enter email"
                data-validate="email"
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
        <button type="submit" class="btn btnPrimary">Sign in</button>
       <div class="alternateActions">
           <span>No account? <a href="signup">Sign up</a> </span> 
           <br>
           <span>Forgot you password? <span onclick="toggleReset()" class="link"> Reset</span> </span>
       </div>
    </form>
    <form onsubmit="validate(onResetPassword); return false" id="forgotPasswordForm" class="hidden">
        <h1>Password assistance</h1>
        <p>Enter your email address and we will sent you a link to reset your password</p>
        <div class="formGroup">
            <label for="email">Email</label>
            <input
                id="emailInputReset" 
                type="text" 
                name="email" 
                placeholder="Enter email"
                data-validate="email"
            >
        </div>
        <span class="feedbackMsg"></span>
        <button type="submit" class="btn btnPrimary" >Send link</button>
        <div class="alternateActions">
            <span class="forgot-password">Back to<span onclick="toggleReset()" class="link"> Login</span> </span>
        </div>
    </form>
</div>

<script src="../js/validator.js"></script>
<script src="../js/login.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>