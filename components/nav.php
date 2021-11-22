<?php
  $user_name = $_SESSION['user_name'];
  $user_last_name = $_SESSION['user_last_name'];
  $lang = $_GET['lang'] ?? 'en';
  if(isset($_GET['lang']) && $_GET['lang'] != 'en' && $_GET['lang'] != 'da'){$lang = 'en';}
  // $lang = $lang ?? 'en';
  require_once(__DIR__.'/../lang/dictionary.php');
?>
<nav>
    <div id="mainNav">
      <div class="logo"> <a href="/"><img src="/../assets/svg/scamlogo.svg" alt="scamazon logo"></a></div>
      <div class="delivery" >📍<?= $text['1'][$lang] ?> </div>
      <div class="searchBar">
        <input type="text">
      </div>
      <div class="dropdown languages"> 
          <div class="currentLang">
            <img <?php echo $lang == 'en' ?  'src="/../assets/png/united-kingdom-flag-square-small.png"' :  "src='/../assets/png/denmark-flag-square-xs.png'" ?>>
          </div>
        <div class="dropdownContent">
            <img onclick="changeLang('da')" src="/../assets/png/denmark-flag-square-xs.png">
            <img onclick="changeLang('en')" src="/../assets/png/united-kingdom-flag-square-small.png">
            <!-- <img onclick="changeLang('dk')" src="https://www.worldometers.info/img/flags/da-flag.gif">
            <img onclick="changeLang('en')" src="https://www.worldometers.info/img/flags/uk-flag.gif"> -->
        </div>
      </div>
        <div class="dropdown sign-in">
                <p class="greeting textSmall"> <?= $text['12'][$lang], $user_name?></p>
               <span> 
                  <?= (isset($user_name) ? $text['11'][$lang] : $text['2'][$lang]) ?>
               </span>
            <div class="dropdownContent dropdownSignup">
                <ul>
                  <?= isset($user_name) ? "<li><a href='account'>Account</a></li>" : "<li><a href='login'>Sign in</a></li>" ; ?>
                  <?= isset($user_name) ? "<li><a href='logout'>Logout</a></li>" : "<li><a href='signup'>New? sign up</a></li>" ; ?>
                </ul>
            </div>
        </div>
       <a href="products" class="productManagement"> <?= $text['3'][$lang] ?> </a>
      <div class="cart"><?= $text['4'][$lang] ?></div>
    </div>
    <div class="subNav">
        <div class="menu">
          <div class="burgerMenu">
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