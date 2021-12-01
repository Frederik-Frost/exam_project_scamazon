<?php
  $user_name = $_SESSION['user_name'];
  $user_last_name = $_SESSION['user_last_name'];
  
  
  $lang = $_SESSION['application_language'] ?? 'en';
  if(isset($_GET['lang']) && $_GET['lang'] != 'en' && $_GET['lang'] != 'da'){$lang = 'en';}
  // $lang = $lang ?? 'en';
  require_once(__DIR__.'/../lang/dictionary.php');
?>
<nav>
    <div id="mainNav">
      <i class="fas fa-bars mobile" onclick="toggleNav()"></i>
      <div class="logo"> <a href="/"><img src="/../assets/svg/scamlogo.svg" alt="scamazon logo"></a></div>
      <div class="delivery" >📍<?= $text['1'][$lang] ?> </div>
      <div class="searchBar">
        <div class="searchBarDropdown">
          <select name="searchDropdown" id="searchDropdown">
            <option selected="selected" value="all"><?= $text['19'][$lang] ?></option>
            <option selected="selected" value="kitchen"><?= $text['20'][$lang] ?></option>
            <option selected="selected" value="computers"><?= $text['21'][$lang] ?></option>
            <option selected="selected" value="tv"><?= $text['22'][$lang] ?></option>
          </select>
        </div>
        <input type="text">
        <div class="searchIcon">
          <i class="fas fa-search"></i>
        </div>
      </div>
      <div class="dropdown languages"> 
          <div class="currentLang">
            <img <?php echo $lang == 'en' ?  'src="/../assets/png/united-kingdom-flag-square-small.png"' :  "src='/../assets/png/denmark-flag-square-xs.png'" ?>>
          </div>
        <div class="dropdownContent">
            <form onchange="changeLang(); return false" class="languageForm">
              <label> 
                <img src="/../assets/png/denmark-flag-square-xs.png"> 
                <span><?= $text['16'][$lang] ?></span> 
                <input type="radio" name="lang" value="da" >
              </label>
              <label> 
                <img src="/../assets/png/united-kingdom-flag-square-small.png"> 
                <span><?= $text['17'][$lang] ?></span> 
                <input type="radio" name="lang" value="en">
              </label>
            </form>
        </div>
      </div>
        <div class="dropdown sign-in">
            <p class="greeting textSmall"> <?= $text['12'][$lang], $user_name?></p>
            <span> 
              <?= (isset($user_name) ? $text['11'][$lang] : $text['2'][$lang]) ?>
            </span>
            <div class="dropdownContent dropdownSignup">
                <ul>
                  <?= isset($user_name) ? "<li><a href='account'>".$text['11'][$lang]."</a></li>" : "<li><a href='login'>".$text['2'][$lang]."</a></li>" ; ?>
                  <?= isset($user_name) ? "<li><a href='logout'>".$text['14'][$lang]."</a></li>" : "<li><a href='signup'>".$text['15'][$lang]."</a></li>" ; ?>
                </ul>
            </div>
        </div>
       <a href="products" class="productManagement"> <?= $text['3'][$lang] ?> </a>
      <div class="cart"><i class="fas fa-shopping-cart"></i><?= $text['4'][$lang] ?></div>
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
  <nav class="mobileNav" onclick="toggleNav()">
    <div class="closeBtn">
      <i class="fas fa-times"></i>
    </div>
    <div class="content">
      <form onchange="changeLang(); return false" class="languageForm">
                <label> 
                  <img src="/../assets/png/denmark-flag-square-xs.png"> 
                  <span><?= $text['16'][$lang] ?></span> 
                  <input type="radio" name="lang" value="da" >
                </label>
                <label> 
                  <img src="/../assets/png/united-kingdom-flag-square-small.png"> 
                  <span><?= $text['17'][$lang] ?></span> 
                  <input type="radio" name="lang" value="en">
                </label>
        </form>
      
      <a href="products" class="productManagement"> <?= $text['13'][$lang] ?> </a>
      <a href="/" class="productManagement"> <?= $text['18'][$lang] ?> </a>

      <div class="delivery" >📍<?= $text['1'][$lang] ?> </div>

    </div>
</nav>
<script src="../js/nav.js"></script>