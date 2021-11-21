<p>Upload a stolen item</p>    
<form id="uploadProductForm" onsubmit="validate(); return false" > 
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
    <input 
        type="text" 
        name="description_da"
        data-validate="str"
        data-min="0"
        data-max="255"
        class="descriptionInput"
        placeholder="Product description danish"
    >
    <text 
        type="text" 
        name="description_en"
        data-validate="str"
        data-min="0"
        data-max="255"
        class="descriptionInput"
        placeholder="Product description english"
    >

    <input type="file" name="image" id="imageInput">

    <button>Create product</button>
</form>
<script src="../js/upload.js"></script>
<script src="../js/validator.js"></script>
