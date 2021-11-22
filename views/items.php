<?php
    $_title = 'Products';
    $page = 'items';
    require_once(__DIR__.'/../components/header.php');
    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../bridges/session-check.php');   
    require_once(__DIR__.'/../components/nav.php');   
?>  
<main id="itemsPage" class="mainContainer">
    <div class="top">
        <h1>PRODUCTS</h1>
        <button class="btn btnPrimary" onclick="onUploadItem(); return false">Upload new product</button>
    </div>
    <div onclick="cancel()" id="uploadModal" class="modal">
        <div class="modalContent">
            <form id="uploadForm" onsubmit="validate(uploadItem); return false" method="POST" enctype="multipart/form-data">
                <h2>Upload new product</h2>
            <div class="formGroup">
                    <label for="title_da">Title danish</label>
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
                    <label for="title_en">Title english</label>
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
                    <label for="price">price</label>
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
                    <label for="description_da">Description danish</label>
                    <textarea 
                        type="text" 
                        name="description_da"
                        class="descriptionInput"
                        placeholder="Product description danish"
                        rows="4"
                    > Danish description
                    </textarea>
                </div>
                <div class="formGroup">
                    <label for="description_en">Description english</label>
                    <textarea 
                        type="text" 
                        name="description_en"
                        class="descriptionInput"
                        placeholder="Product description english"
                        rows="4"
                    > English description
                    </textarea>
                </div>

                <input type="file" name="image" id="imageInput"  accept="image/*">
                <button class="btn btnPrimary">Create product</button>
            </form>
        </div>
    </div>
    <div id="items">
        <div class="itemHeaders">
            <h4>Image</h4>
            <!-- <h4>Title da</h4> -->
            <h4>Title</h4>
            <h4>Description</h4>
            <h4>Price</h4>
            <!-- <h4>Description da</h4> -->
            <h4 class="updateItem">Update</h4>
            <h4 class="deleteItem">Delete</h4>
            <button onclick="onDeleteMultiple()" class="btn">Delete selected</button>
        </div>
    </div>
</main>

<div onclick="cancel()" id="deleteModal" class="modal">
    <div class="modalContent">
        <p class="modalText"></p>
        <form onsubmit="deleteItem(); return false">
            <input type="hidden" name="id" class="idInput">
            <input type="hidden" name="image_path" class="imagePathInput">
            <div class="actions">
                <button type="submit" class="confirmBtn btn btnPrimary">Delete</button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div onclick="cancel()" id="deleteMultipleModal" class="modal">
    <div class="modalContent">
        <form id="hiddenInputs" onsubmit="return false">
            <p class="modalText"></p>
            <div class="actions">
                <button onclick="deleteItems()" type="button" class="confirmBtn btn btnPrimary"">Delete</button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn">Cancel</button>
            </div>
        </form>
    </div>
</div>
    
<div onclick="cancel()" id="updateModal" class="modal">
    <div class="modalContent">
        <p class="modalText"></p>
        <form onsubmit="updateItem(); return false">
            <input 
                type="text" 
                name="title_da"
                data-validate="str"
                data-min="2"
                data-max="20"
                class="titleInputDA"
                placeholder="Product name"
            >
            <input 
                type="text" 
                name="title_en"
                data-validate="str"
                data-min="2"
                data-max="20"
                class="titleInputEN"
                placeholder="Product name"
            >
            <input
                type="number" 
                name="price"
                step=".01"
                data-validate="str"
                data-min="1"
                class="priceInput"
                placeholder="Price DKK"
            >
            <textarea 
                type="text" 
                name="description_da"
                class="descriptionInputDA"
                placeholder="Product description danish"
            ></textarea>
            <textarea 
                type="text"     
                name="description_en"
                class="descriptionInputEN"
                placeholder="Product description english"
            ></textarea>
            <input type="hidden" class="hiddenInput" name="id">
            <div class="actions">
                <button type="submit" class="confirmBtn btn btnPrimary"">Update</button>
                <button onclick="cancel()" type="reset" class="cancelBtn btn">Cancel</button>
            </div>
        </form>
    </div>
</div>
<div onclick="cancel()" id="updateImageModal" class="modal">
    <div class="modalContent">
        <p class="modalText"></p>
        <form onsubmit="updateImage(); return false">
            <input type="hidden" class="hiddenInput idInput" name="id">
            <input type="hidden" class="hiddenInput imagePath" name="image_path">
            <input type="file" name="image" accept="image/*">
            <div class="actions">
                <button type="submit" class="confirmBtn">Update</button>
                <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script src="js/validator.js"></script>
<script src="js/items.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>

