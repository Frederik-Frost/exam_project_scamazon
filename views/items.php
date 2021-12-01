<?php
    $_title = 'Products';
    $page = 'items';
    require_once(__DIR__.'/../components/header.php');
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../bridges/session-check.php');   
    require_once(__DIR__.'/../components/nav.php');   
?>  
<main id="itemsPage" class="mainContainer">
    <div class="top">
        <h1><?= $text['36'][$lang] ?></h1>
        <div class="btns">
            <button class="btn btnPrimary" onclick="onUploadItem(); return false"><?= $text['37'][$lang] ?></button>
            <button onclick="onDeleteMultiple()" class="btn deleteBtnMobile"><?= $text['38'][$lang] ?></button>
        </div>
    </div>
    <div onclick="cancel()" id="uploadModal" class="modal">
        <div class="modalContent">
            <form id="uploadForm" onsubmit="validate(uploadItem); return false" method="POST" enctype="multipart/form-data">
                <h2><?= $text['37'][$lang] ?></h2>
                <div class="formGroup">
                    <label for="title_da"><?= $text['39'][$lang] ?></label>
                <input 
                    type="text" 
                    name="title_da"
                    data-validate="str"
                    data-min="2"
                    data-max="20"
                    class="titleInput"
                    placeholder="Product name"
                >
                </div>
                <div class="formGroup">
                    <label for="title_en"><?= $text['40'][$lang] ?></label>
                    <input 
                        type="text" 
                        name="title_en"
                        data-validate="str"
                        data-min="2"
                        data-max="20"
                        class="titleInput"
                        placeholder="Product name"
                    >
                </div>
                <div class="formGroup">
                    <label for="price"><?= $text['41'][$lang] ?></label>
                <input
                    type="number" 
                    name="price"
                    step=".01"
                    data-validate="str"
                    data-min="1"
                    class="priceInput"
                    placeholder="Price DKK"
                >
                </div>
                <div class="formGroup">
                    <label for="description_da"><?= $text['42'][$lang] ?></label>
                    <textarea 
                        type="text" 
                        name="description_da"
                        class="descriptionInput"
                        placeholder="Product description danish"
                        rows="4"
                    > <?= $text['42'][$lang] ?>
                    </textarea>
                </div>
                <div class="formGroup">
                    <label for="description_en"><?= $text['43'][$lang] ?></label>
                    <textarea 
                        type="text" 
                        name="description_en"
                        class="descriptionInput"
                        placeholder="Product description english"
                        rows="4"
                    > <?= $text['43'][$lang] ?>
                    </textarea>
                </div>

            <div class="fileInput">
                <input type="file" name="image" id="imageInput"  accept="image/*">
                <!-- <label for="file">Select file</label> -->
            </div>
                <button class="btn btnPrimary"><?= $text['44'][$lang] ?></button>
            </form>
        </div>
    </div>
    <div id="items">
        <div class="itemHeaders">
            <h4><?= $text['45'][$lang] ?></h4>
            <h4><?= $text['46'][$lang] ?></h4>
            <h4><?= $text['47'][$lang] ?></h4>
            <h4><?= $text['41'][$lang] ?></h4>
            <h4 class="updateItem"><?= $text['48'][$lang] ?></h4>
            <h4 class="deleteItem"><?= $text['49'][$lang] ?></h4>
            <button onclick="onDeleteMultiple()" class="btn"><?= $text['38'][$lang] ?></button>
        </div>
    </div>
</main>

<div onclick="cancel()" id="deleteModal" class="modal">
    <div class="modalContent">
        <form onsubmit="deleteItem(); return false">
            <h3><?= $text['50'][$lang] ?></h3>
            <p class="modalText"></p>
            <input type="hidden" name="id" class="idInput">
            <input type="hidden" name="image_path" class="imagePathInput">
            <div class="actions">
                <button type="submit" class="confirmBtn btn btnPrimary"><?= $text['49'][$lang] ?></button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn"><?= $text['32'][$lang] ?></button>
            </div>
        </form>
    </div>
</div>

<div onclick="cancel()" id="deleteMultipleModal" class="modal">
    <div class="modalContent">
        <form id="hiddenInputs" onsubmit="return false">
            <h3><?= $text['51'][$lang] ?></h3>
            <p class="modalText"></p>
            <div class="actions">
                <button onclick="deleteItems()" type="button" class="confirmBtn btn btnPrimary"><?= $text['49'][$lang] ?></button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn"><?= $text['32'][$lang] ?></button>
            </div>
        </form>
    </div>
</div>
    
<div onclick="cancel()" id="updateModal" class="modal">
    <div class="modalContent">
        <form onsubmit="validate(updateItem); return false">
            <h3><?= $text['52'][$lang] ?></h3>
            <p class="modalText"></p>
            <label for="title_da"><?= $text['39'][$lang] ?></label>
            <input 
                type="text" 
                name="title_da"
                data-validate="str"
                data-min="2"
                data-max="20"
                class="titleInputDA"
                placeholder="Product name"
            >
            <label for="title_en"><?= $text['40'][$lang] ?></label>
            <input 
                type="text" 
                name="title_en"
                data-validate="str"
                data-min="2"
                data-max="20"
                class="titleInputEN"
                placeholder="Product name"
            >
            <label for="price"><?= $text['41'][$lang] ?></label>
            <input
                type="number" 
                name="price"
                step=".01"
                data-validate="str"
                data-min="1"
                class="priceInput"
                placeholder="Price DKK"
            >
            <label for="description_da"><?= $text['42'][$lang] ?></label>
            <textarea 
                type="text" 
                name="description_da"
                class="descriptionInputDA"
                placeholder="Product description danish"
                rows="4"
            ></textarea>
            <label for="description_en"><?= $text['43'][$lang] ?></label>
            <textarea 
                type="text"     
                name="description_en"
                class="descriptionInputEN"
                placeholder="Product description english"
                rows="4"
            ></textarea>
            <input type="hidden" class="hiddenInput" name="id">
            <div class="actions">
                <button type="submit" class="confirmBtn btn btnPrimary"><?= $text['48'][$lang] ?></button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn"><?= $text['32'][$lang] ?></button>
            </div>
        </form>
    </div>
</div>
<div onclick="cancel()" id="updateImageModal" class="modal">
    <div class="modalContent">
        <form onsubmit="updateImage(); return false">
            <h3><?= $text['53'][$lang] ?></h3>
            <p class="modalText"></p>
            <input type="hidden" class="hiddenInput idInput" name="id">
            <input type="hidden" class="hiddenInput imagePath" name="image_path">
            <input type="file" name="image" accept="image/*">
            <div class="actions">
                <button type="submit" class="confirmBtn btn btnPrimary"><?= $text['48'][$lang] ?></button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn"><?= $text['32'][$lang] ?></button>
            </div>
        </form>
    </div>
</div>

<script src="js/validator.js"></script>
<script src="js/items.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>

