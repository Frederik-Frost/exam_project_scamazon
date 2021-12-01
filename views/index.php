<?php
    $_title = 'scamazon';
    require_once(__DIR__.'/../components/header.php');
    session_start();
    // $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>  

<div id="home" class="mainContainer">
  <section id="heroImage">
      <!-- <img src="/../assets/svg/heroimg.svg" alt="scamazon hero image"> -->
      <img src="/../assets/svg/heroimg2.svg" alt="scamazon hero image">
  </section>

  <main>
    <section id="products">
      <h2><?= $text['34'][$lang] ?></h2>
      <div class="items"></div>
    </section>
    <section id="affiliateProducts">
      <h2><?= $text['35'][$lang] ?></h2>
      <div class="items"></div>
    </section>
  </main>
</div>

  <script src="../js/validator.js"></script>
  <script src="../js/home.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>