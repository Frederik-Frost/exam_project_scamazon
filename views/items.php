<?php
    $_title = 'Products';
    $page = 'items';
    require_once(__DIR__.'/../components/header.php');
    $lang = $_GET['lang'] ?? 'en';
    require_once(__DIR__.'/../lang/dictionary.php');
    require_once(__DIR__.'/../bridges/session-check.php');   
    require_once(__DIR__.'/../components/nav.php');   
?>  
<main class="mainContainer">
    <h1>PRODUCTS</h1>
    <form id="uploadForm" onsubmit="validate(uploadItem); return false" method="POST" enctype="multipart/form-data">
        <input 
            type="text" 
            name="title_da"
            data-validate="str"
            data-min="2"
            data-max="20"
            class="titleInput"
            placeholder="Product name"
        >
        <input 
            type="text" 
            name="title_en"
            data-validate="str"
            data-min="2"
            data-max="20"
            class="titleInput"
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
            class="descriptionInput"
            placeholder="Product description danish"
        > Danish description</textarea>
        <textarea 
            type="text" 
            name="description_en"
            class="descriptionInput"
            placeholder="Product description english"
        > English description</textarea>

        <input type="file" name="image" id="imageInput"  accept="image/*">

        <button>Create product</button>
    </form>
        <table  id="items" cellspacing="0">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th class="updateItemHeader">Update</th>
                    <th class="deleteItemHeader">Delete</th>
                    <th class="deleteMultipleHeader">
                        <button onclick="onDeleteMultiple()">
                            Delete selected
                        </button>
                    </th>
                </tr>
                
            </table>
        
        
        <div onclick="cancel()" id="deleteModal" class="modal">
            <div class="modalContent">
                <p class="modalText"></p>
                <div class="actions">
                    <button onclick="deleteItem()" type="button" class="confirmBtn">Delete</button>
                    <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
                </div>
            </div>
        </div>

        <div onclick="cancel()" id="deleteMultipleModal" class="modal">
            <div class="modalContent">
                <form id="hiddenInputs" onsubmit="return false">
                    <p class="modalText"></p>
                    <div class="actions">
                        <button onclick="deleteItems()" type="button" class="confirmBtn">Delete</button>
                        <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div onclick="cancel()" id="updateModal" class="modal">
            <div class="modalContent">
                <p class="modalText"></p>
                <form onsubmit="validate(updateItem); return false">
                    <input 
                        type="text" 
                        name="item_name"
                        data-validate="str"
                        data-min="2"
                        data-max="20"
                        class="nameInput"
                        placeholder="Product name"
                    >
                    <input 
                        type="number" 
                        step=".01"
                        name="item_price"
                        data-validate="str"
                        data-min="1"
                        class="priceInput"
                        placeholder="Price DKK"
                    >
                    <input type="hidden" name="item_id" class="idInput">
                    <div class="actions">
                        <button type="submit" class="confirmBtn">Update</button>
                        <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

</main>
<script src="js/validator.js"></script>
<script src="js/items.js"></script>
<?php
    require_once(__DIR__.'/../components/footer.php');
?>

