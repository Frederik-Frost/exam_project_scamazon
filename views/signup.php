<?php
    $_title = 'Signup';
    require_once(__DIR__.'/../components/header.php'); // This doesnt read variables??
    // require_once('components/header.php'); // this does

    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>   
<div id="signupPage">
    
    <div class="logo"> 
        <a href="/"><img src="/../assets/svg/scamlogo-black.svg" alt="scamazon logo"></a>
    </div>

    <form id="signupForm" onsubmit="validate(signUp); return false">
        <h1><?= $text['55'][$lang] ?></h1>
        <div class="formGroup">
            <label for="name"><?= $text['25'][$lang] ?></label>
            <input 
                name="name"
                type="text" 
                placeholder="Enter your first name"
                data-validate="str"
                data-min="2"
                data-max="30"
            >
        </div>
        <div class="formGroup">
            <label for="lastName"><?= $text['26'][$lang] ?></label>
            <input 
                name="lastName" 
                type="text" 
                placeholder="Enter your last name"
                data-validate="str"
                data-min="2"
                data-max="30"    
            >
        </div>
        <div class="formGroup">
            <label for="email">Email</label>
            <input 
                name="email" 
                type="text" 
                placeholder="Enter your email address"
                data-validate="email"
            >
        </div>
        <div class="formGroup">
            <label for="phone"><?= $text['27'][$lang] ?></label>
            <input 
                name="phone" 
                type="text" 
                placeholder="Enter your phone number"
                data-validate="int"
                data-min="8"
                data-max="8"
            >
        </div>
        <div class="formGroup">
            <label for="password">Password</label>
            <input 
                name="password" 
                type="password" 
                placeholder="Enter a password" 
                autocomplete="on"
                data-validate="str"
                data-min="6"
                data-max="30"
            >
        </div>
        <button type="submit" class="btn btnPrimary"><?= $text['55'][$lang] ?></button>
        <span class="errorMsg"></span>
        <div class="alternateActions">
            <span class="txtSmall"><?= $text['56'][$lang] ?> <a href="login">login</a> </span>
        </div>
    </form>
    <div class="succesMessage">
        <p><?= $text['56'][$lang] ?></p>
    </div>
</div>
<script src="../js/validator.js"></script> 
<script src="../js/signup.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>