<?php
    $_title = 'Account';
    require_once(__DIR__.'/../components/header.php');
    session_start();
    // $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>  
<!-- start div left and right  -->

<div id="account" class="mainContainer">
    <div class="logo"> 
        <a href="/"><img src="/../assets/svg/scamlogo-black.svg" alt="scamazon logo"></a>
    </div>
    <form id="userInfoForm" onsubmit="validate(updateUserInfo); return false">
        <h1><?= $text['24'][$lang] ?></h1>
        <div class="formGroup">
            <label for="email">Email</label>
            <input name="email" type="text" placeholder="Enter your email address" value="<?= $_SESSION['user_email']?>" readonly>
        </div>
        <div class="formGroup">
            <label for="name"><?= $text['25'][$lang] ?></label>
            <input name="name" type="text" placeholder="Enter your first name" value="<?= $_SESSION['user_name']?>">
        </div>
        <div class="formGroup">
            <label for="lastName"><?= $text['26'][$lang] ?></label>
            <input name="lastName" type="text" placeholder="Enter your last name" value="<?= $_SESSION['user_last_name']?>">
        </div>
        <div class="formGroup">
            <label for="phone"><?= $text['27'][$lang] ?></label>
            <input name="phone" type="text" placeholder="Enter your phone number" value="<?= $_SESSION['user_phone']?>" >
        </div>
            <input name="id" type="hidden" value="<?= $_SESSION['user_id']?>" >
            <button type="submit" class="btn btnPrimary"><?= $text['33'][$lang] ?></button>
    </form>

    <button id="changePasswordBtn" class="btn" onclick="onChangePassword(); return false"><?= $text['28'][$lang] ?></button>
    <span class="textSuccess"></span>
    <span class="textDanger"></span>
    <div onclick="cancel()" id="changePasswordModal" class="modal">
    <div class="modalContent">
        <form onsubmit="validate(changePassword); return false">
            <h3><?= $text['28'][$lang] ?></h3>
            <p class="modalText"></p>
            <label for="old_password"><?= $text['29'][$lang] ?></label>
            <input 
                type="password" 
                name="old_password"
                data-validate="str"
                data-min="6"
                data-max="30"
                class="oldPasswordInput"
                placeholder="Old password"
                autocomplete="current-password"
                >
                <label for="new_password"><?= $text['30'][$lang] ?></label>
            <input 
                type="password" 
                name="new_password"
                data-validate="str"
                data-min="6"
                data-max="30"
                class="newPasswordInput"
                placeholder="New password"
                autocomplete="new-password"
            >
            <label for="repeat_password"><?= $text['31'][$lang] ?></label>
            <input 
                type="password" 
                name="repeat_password"
                data-validate="str"
                data-min="6"
                data-max="30"
                class="repeatPasswordInput"
                placeholder="Repeat new password"
                autocomplete="new-password"
            >
            <input type="hidden" class="hiddenInput" name="user_id" value="<?= $_SESSION['user_id']?>">
            <span class="errorMsg"></span>
            <div class="actions">
                <button type="submit" class="confirmBtn btn btnPrimary""><?= $text['28'][$lang] ?></button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn"><?= $text['32'][$lang] ?></button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="../js/validator.js"></script>
<script src="../js/account.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>