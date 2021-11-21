<?php
    $_title = 'Amazon';
    require_once(__DIR__.'/../components/header.php');
    session_start();
    // $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>  
<!-- start div left and right  -->
<div id="home" class="mainContainer">
  <section id="heroImage">
      <h1>amaztolen</h1>
      <h2>Everything is stolen</h2>
      <p>Nothing is legit</p>

      <?= $user_name ?>
      <?= $lang ?>  
     
  </section>

  <main>
    <section id="products">
        <!-- <div class="item">
            <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_UY436_FMwebp_QL65_.jpg" alt="img">
          <div>
            <div>CanaKit Raspberry Pi 4 8GB Starter Kit - 8GB RAM</div>
            <div>⭐⭐⭐⭐⭐ 8,256</div>
            <div>$ 119.99</div>
            <div>Ships to Denmark</div>
            <div>More buying choices</div>
            <div>$110 (6 used &amp; new offers)</div>
          </div>
        </div> -->
    </section>
    <section id="affiliateProducts">
        <?php // Getting the content for other shops and looping over products.
          // $data = json_decode(file_get_contents("shop.txt"));
          // foreach($data as $item){
          //     echo "<div> {$item->id}</div>";
          //     echo "<div> {$item->title}</div>";
          //     echo "<div> {$item->price}</div>";
          //     echo "<img style='height:100px;' src='https://coderspage.com/2021-F-Web-Dev-Images/{$item->image}' >";
          // }
        ?>
    </section>
  </main>
</div>

  <script src="../js/validator.js"></script>
  <script src="../js/app.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>