<?php
    $_title = 'scamazon';
    require_once(__DIR__.'/../components/header.php');
    session_start();
    // $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>  
<!-- start div left and right  -->
<div id="home" class="mainContainer">
  <section id="heroImage">
      <!-- <h1>scamazon</h1>
      <h2>It's all a scam</h2>
      <p>Nothing is legit</p>      -->
      <img src="/../assets/svg/heroimg.svg" alt="scamazon hero image">
  </section>

  <main>
    <section id="products">
      <h2>Trending products</h2>
      <div class="items"></div>
    </section>
    <section id="affiliateProducts">
      <h2>Partners products</h2>
      <div class="items"></div>
      

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
  <script src="../js/home.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>