<?php
  $lang = $_GET['lang'] ?? 'en';
  require_once(__DIR__.'/../lang/dictionary.php');
?>
<nav>
    <div id="main-nav">
      <div class="logo">Amazon</div>
      <div class="delivery" >📍<?= $text['1'][$lang] ?> </div>
      <div class="search-bar">
        <input type="text">
      </div>
      <div class="dropdown languages">
          <div class="current-lang">
              <img>
          </div>
        <div class="dropdown-content">
            <img onclick="changeLang('dk')" src="/../assets/png/denmark-flag-square-xs.png">
            <img onclick="changeLang('en')" src="/../assets/png/united-kingdom-flag-square-small.png">
            <!-- <img onclick="changeLang('dk')" src="https://www.worldometers.info/img/flags/da-flag.gif">
            <img onclick="changeLang('en')" src="https://www.worldometers.info/img/flags/uk-flag.gif"> -->
        </div>
      </div>
        <div class="dropdown sign-in">
                <p class="greeting text-small"> <?= $text['12'][$lang], $user_name?></p>
               <span> 
                    <?= (isset($user_name) ? $text['11'][$lang] : $text['2'][$lang]) ?>
               </span>
            <div class="dropdown-content dropdown-signup">
                <ul>
                    <li><a href="login">Sign in</a></li>
                    <li><a href="signup">New? sign up</a></li>
                </ul>
            </div>
        </div>
      <div class="returns"><?= $text['3'][$lang] ?></div>
      <div class="cart"><?= $text['4'][$lang] ?></div>
    </div>
    <div class="sub-nav">
        <div class="menu">
          <div class="burger-menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div><?= $text['5'][$lang] ?></div>
        </div>
        <div><?= $text['6'][$lang] ?></div>
        <div><?= $text['7'][$lang] ?></div>
        <div><?= $text['8'][$lang] ?></div>
        <div><?= $text['9'][$lang] ?></div>
        <div><?= $text['10'][$lang] ?></div>
    </div>
  </nav>  
<script src="../js/nav.js"></script>