<?php
    $_title = 'Amazon';
    require_once(__DIR__.'/../components/header.php');
    session_start();
    
    $user_name = $_SESSION['user_name'];
    $user_last_name = $_SESSION['user_last_name'];
    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../components/nav.php');
?>  
      <!-- start div left and right  -->
      <div id="main-container">
        <section>
            left panel
        </section>

        <!-- items will appear -->
        <main>
          <!-- blue printing -->
          <div id="items">
            

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

          </div>
        </main>
      </div>
      <!-- end div left and right  -->
      <script src="../js/app.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>