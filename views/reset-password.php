<?php
    // Verify the key (must be 32 characters)
    if(!isset($_GET['key'])){
        echo "mmm..... suspicious (key is missing)";
        exit();
    }
    if(strlen($_GET['key']) != 32){
        echo "mmm..... suspicious (key is not 32 chars)";
        exit();
    }
    $_title = 'Reset passsword';
    require_once(__DIR__.'/../components/header.php');

    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>   
<div id="resetPasswordPage" class="mainContainer">
    <div class="logo"> 
        <a href="/"><img src="/../assets/svg/scamlogo-black.svg" alt="scamazon logo"></a>
    </div>
    
    <form onsubmit="validate(newPassword); return false" id="newPasswordForm">
        <h1><?= $text['30'][$lang] ?></h1>
        <div class="formGroup">
            <label for="password"><?= $text['30'][$lang] ?></label>
            <input 
                id="passwordInput"
                type="password"
                name="password" 
                placeholder="Enter new password"
                data-validate="str"
                data-min="6"
                data-max="20"
                autocomplete="on"
            >
        </div>
        <div class="formGroup">
            <label for="repeatPassword"><?= $text['31'][$lang] ?></label>
            <input 
                id="repeatPasswordInput"
                type="password"
                name="repeatPassword" 
                placeholder="Repeat new password"
                data-validate="str"
                data-min="6"
                data-max="20"
                autocomplete="on"
            >
        </div>
        <input id="hiddenKeyInput" type="hidden" name="key">

        <span class="errorMsg"></span>
        <button type="submit" class="btn btnPrimary"><?= $text['30'][$lang] ?></button>
    </form>
</div>
<script src="../js/validator.js"></script>
<script src="../js/resetPassword.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>