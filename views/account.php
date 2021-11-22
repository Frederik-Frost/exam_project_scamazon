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
    <form id="userInfoForm" onsubmit="validate(updateUserInfo); return false">
        <h1>Your account</h1>
        <div class="formGroup">
            <label for="email">Email</label>
            <input name="email" type="text" placeholder="Enter your email address" value="<?= $_SESSION['user_email']?>" disabled readonly>
        </div>
        <div class="formGroup">
            <label for="name">First name</label>
            <input name="name" type="text" placeholder="Enter your first name" value="<?= $_SESSION['user_name']?>">
        </div>
        <div class="formGroup">
            <label for="lastName">Last name</label>
            <input name="lastName" type="text" placeholder="Enter your last name" value="<?= $_SESSION['user_last_name']?>">
        </div>
        <div class="formGroup">
            <label for="phone">Phone number</label>
            <input name="phone" type="text" placeholder="Enter your phone number" value="<?= $_SESSION['user_phone']?>" >
        </div>
            <input name="id" type="hidden" value="<?= $_SESSION['user_id']?>" >
        <button type="submit">Update info</button>
    </form>

    <button>Change password</button>
</div>
<script src="../js/validator.js"></script>
<script src="../js/account.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>