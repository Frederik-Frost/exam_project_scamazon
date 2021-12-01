let deleteEvent;
let itemId;
let itemList = [];
window.addEventListener('DOMContentLoaded', () => {
    getItems();
})

async function getItems(){
    try{
        let response = await fetch('get-products', {
            'method': 'POST',
            'Content-Type': 'application/json'
        })
        let items = await response.json()
        items.forEach(item => {
            addToList(item)
        })
    }catch(e){
        console.log(e)
    }
}   
function addToList(data){
    itemList.push(data)
    const itemElement = `<div class="item">
                            <div class="productImg" onclick="onUpdateImage()" data-id="${data.id}" data-image-path="${data.image_path}">
                                <i class="far fa-edit"></i>              
                                <img src="/../assets/product-images/${data.image_path}" alt="${data.image_path}">
                            </div>
                            <div class="titles">
                                <h4 class="mobileOnly">Titles</h4>
                                <div class="titleDa">
                                    <p><span>Da: </span><br class="desktopOnly"> ${data.title_da}</p>
                                </div>
                                <div class="titleEn">
                                    <p><span>En: </span><br class="desktopOnly"> ${data.title_en}</p>
                                </div>
                            </div>
                            <div class="descriptions">
                                <h4 class="mobileOnly">Descriptions</h4>
                                <div class="descDa">
                                   <p><span>Da: </span><br class="desktopOnly"> ${data.description_da}</p>
                                </div>
                                <div class="descDa">
                                    <p><span>En: </span><br class="desktopOnly"> ${data.description_en}</p>
                                </div>
                            </div>
                            <div class="price">
                                <h4 class="mobileOnly">Price</h4>
                                <p><span>DKK: </span><br class="desktopOnly">${data.price}</p>
                            </div>
                        
                            <div onclick="onUpdateItem()" data-id="${data.id}" data-name="${data.id}" data-price="${data.price}" class="updateItem">
                            <p class="mobileOnly">Edit: </p> <i class="fas fa-pen"></i>
                            </div>
                            <div onclick="onDeleteItem()" data-id="${data.id}" data-name="${data.title_en}" class="deleteItem">
                                <p class="mobileOnly">Delete: </p><i class="far fa-trash-alt"></i>
                            </div>
                            <label for="selectedID[${data.id}]" data-id="${data.id}" data-name="${data.item_name}" class="bulkAction">  
                                <p class="mobileOnly">Bulk delete: </p><input type="checkbox" id="selectedID[${data.id}]" class="idCheckbox" value="${data.id}"> 
                            </label>
                        </div>`
    _one("#items").insertAdjacentHTML("beforeend", itemElement)
}
function onUploadItem(){
    _one("#uploadModal").style.display = 'block'
}
async function uploadItem(){
    // let form = event.target.form;
    let file = _one("#uploadForm input[type='file']")
    let data = new FormData()
    
    _all("#uploadForm input").forEach(el => {
        if(el.type != "file"){
            data.append(el.name, el.value)
        }
    });
    _all("#uploadForm textarea").forEach(el => {
        data.append(el.name, el.value)
    });
    data.append('image',file.files[0])
    
    try{
        let conn = await fetch('upload-product', {
            'method': 'POST',
            'Content-Type': 'multipart/form-data',
            'body': data
        })
        let res = await conn.json()
        if(conn.ok){
            let data = res.data
            data.image_path = res.file.image.name
            data.id = res.id
            addToList(data)
            _all("#uploadForm input").forEach(e => { e.value = ''})
            _all("#uploadForm textarea").forEach(e => { e.innerText = ''})
            _one("#uploadModal").style.display = 'none'
        } 
    }catch(e){
        console.log(e)
    }
}
function onDeleteItem(){
    deleteEvent = event
    // itemId = event.target.getAttribute('data-id')
    let item = itemList.find(item => (item.id == event.target.getAttribute('data-id')))
    _one("#deleteModal p").innerText = `Really delete ${item.title_en} from product list?`
    _one("#deleteModal .idInput").value = item.id
    _one("#deleteModal .imagePathInput").value = item.image_path
    _one("#deleteModal").style.display = 'block';
}

async function deleteItem(){
    deleteEvent.target.parentElement.remove()
    const form = event.target

    try{
        const conn = await fetch('delete-product',{
            method: 'POST',
            body: new FormData(form)
        })
        const res = await conn.json()
        deleteEvent = null
        itemId = null
        _one("#deleteModal").style.display = 'none';
    }catch(e){
        console.log(e)
    }
}

function onUpdateImage(){
    let item = itemList.find(item => (item.id == event.target.getAttribute('data-id')))
    _one("#updateImageModal .idInput").value = item.id
    _one("#updateImageModal .imagePath").value = item.image_path
    _one("#updateImageModal").style.display = 'block'
}

async function updateImage(){
    let file = _one("#updateImageModal input[type='file']")
    let data = new FormData()
    
    _all("#updateImageModal input").forEach(el => {
        if(el.type != "file"){
            data.append(el.name, el.value)
        }
    });
    data.append('image',file.files[0])

    try{
        let conn = await fetch('update-image',{
            method: 'POST',
            body: data
        })
    
        let res = await conn.json()
        console.log(res)
        if(conn.ok){
            itemList = []
            _all(".item").forEach(itemNode => {
                itemNode.remove();
            });
            getItems();
            _one("#updateImageModal").style.display = 'none';
        }
    }catch(e){
        console.log(e)
    }
}
function onUpdateItem(){
    let item = itemList.find(item => (item.id == event.target.getAttribute('data-id')))
    _one("#updateModal .titleInputDA").value = item.title_da
    _one("#updateModal .titleInputEN").value = item.title_en
    _one("#updateModal .priceInput").value = item.price       
    _one("#updateModal .descriptionInputDA").innerText = item.description_da
    _one("#updateModal .descriptionInputEN").innerText = item.description_en
    _one("#updateModal .hiddenInput").value = item.id
    _one("#updateModal").style.display = 'block'
}

async function updateItem(){
    const form = event.target
    let data = new FormData(form)

    try{
        let conn = await fetch('update-product',{
            method: 'POST',
            body: data
        })
        let res = await conn.json()
        console.log(res)
        
        if(conn.ok){
            itemList = []
            _all(".item").forEach(itemNode => {
                console.log(itemNode)
                itemNode.remove();
            });
            getItems();
            _one("#updateModal").style.display = 'none';
        }
    }catch(e){
        console.log(e)
    }
}

function onDeleteMultiple(){
    let itemIdList = 0
    _all("#hiddenInputs input").forEach(staged => { staged.remove(); })
    _all(".idCheckbox").forEach(id => {
        if(id.checked){
            itemIdList ++;
            const hiddenInput = `<input type="hidden" name="delete_item[]" value="${id.value}">`
            _one("#hiddenInputs").insertAdjacentHTML("beforeend", hiddenInput)
        }
    })
    _one("#deleteMultipleModal p").innerText = `You are about to delete ${itemIdList} ${itemIdList != 1 ? 'items' : 'item'}`
    _one("#deleteMultipleModal").style.display = 'block';
}
async function deleteItems() {
    const form = event.target.form
    try{
        let conn = await fetch('delete-products',{
            method: 'POST',
            body: new FormData(form)
        })
        let res = await conn.json()
            console.log(res)
    
        if(conn.ok){
            itemList = []
            _all(".item").forEach(itemNode => {
                itemNode.remove();
            });
            getItems();
            _one("#deleteMultipleModal").style.display = 'none';
        }
    }catch(e){
        console.log(e)
    }
}

function cancel(){
    if(event.target.classList.contains('modal') || event.target.classList.contains('cancelBtn') || event.target.classList.contains('cancelBtn')){
        _all(".modal").forEach(e => {
            e.style.display = 'none';
        });
        deleteEvent = null
        itemId = null  
    }
}