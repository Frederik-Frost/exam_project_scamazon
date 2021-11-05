<?php
    //To do: Verify the key (must be 32 characters)
    if(!isset($_GET['key'])){
        echo "mmm..... suspicious (key is missing)";
        exit();
    }
    if(strlen($_GET['key']) != 32){
        echo "mmm..... suspicious (key is not 32 chars)";
        exit();
    }
    echo $_GET['key'];

    $_title = 'Reset passsword';
    require_once(__DIR__.'/../components/header.php');

    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>   
<div id="resetPasswordPage" class="mainContainer">
    <!-- <form onsubmit="validate(login); return false"> -->
    <form onsubmit="return false" id="newPasswordForm"> 
        <h1>New password</h1>
   
        <div class="formGroup">
            <label for="password">New password</label>
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
            <label for="repeatPassword">Repeat password</label>
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
        <button type="submit" onclick="newPassword(event)">New password</button>
    </form>
</div>
<script src="../js/validator.js"></script>
<script src="../js/resetPassword.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>