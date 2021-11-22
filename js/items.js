// function one(query){return document.querySelector(query)}
// function all(query){return document.querySelectorAll(query)}
let deleteEvent;
let itemId;
let itemList = [];
window.addEventListener('DOMContentLoaded', () => {
    getItems();
})

async function getItems(){
    let response = await fetch('get-products', {
            'method': 'POST',
            'Content-Type': 'application/json'
        })
    let items = await response.json()
    console.log(response)
    console.log(items)
    items.forEach(item => {
        addToList(item)
    })
}   
function addToList(data){
    itemList.push(data)
    const itemElement = `<div class="item">
                            <div class="productImg" onclick="onUpdateImage()" data-id="${data.id}" data-image-path="${data.image_path}">
                                <img src="/../assets/product-images/${data.image_path}" alt="${data.image_path}">
                            </div>
                            <div class="titles">
                                <div class="titleDa">
                                    <p><span>Da: </span><br> ${data.title_da}</p>
                                </div>
                                <div class="titleEn">
                                    <p><span>En: </span><br> ${data.title_en}</p>
                                </div>
                            </div>
                            <div class="descriptions">
                                <div class="descDa">
                                   <p><span>Da: </span><br> ${data.description_da}</p>
                                </div>
                                <div class="descDa">
                                    <p><span>En: </span><br> ${data.description_en}</p>
                                </div>
                            </div>
                            <div class="price">
                                <p><span>DKK: </span><br>${data.price}</p>
                            </div>
                            <div onclick="onUpdateItem()" data-id="${data.id}" data-name="${data.id}" data-price="${data.price}" class="updateItem">
                                <i class="fas fa-pen"></i>
                            </div>
                            <div onclick="onDeleteItem()" data-id="${data.id}" data-name="${data.title_en}" class="deleteItem">
                                <i class="far fa-trash-alt"></i>
                            </div>
                            <div data-id="${data.id}" data-name="${data.item_name}" class="bulkAction">  
                                <input type="checkbox" id="selectedID[${data.id}]" class="idCheckbox" value="${data.id}"> 
                            </div>
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
            console.log("appending")
            data.append(el.name, el.value)
        }
    });
    _all("#uploadForm textarea").forEach(el => {
        console.log(el.name, el.value)
        data.append(el.name, el.value)
    });
    data.append('image',file.files[0])
    console.log(data)
    
    let conn = await fetch('upload-product', {
        'method': 'POST',
        'Content-Type': 'multipart/form-data',
        'body': data
    })
    let res = await conn.json()
    console.log(res)
    if(conn.ok){
        let data = res.data
        data.image_path = res.file.image.name
        data.id = res.id
        console.log(data)
        addToList(data)
        _all("#uploadForm input").forEach(e => { e.value = ''})
        _all("#uploadForm textarea").forEach(e => { e.innerText = ''})
        _one("#uploadModal").style.display = 'none'
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
    console.log(form)
    const conn = await fetch('delete-product',{
        method: 'POST',
        body: new FormData(form)
    })
    const res = await conn.json()
    deleteEvent = null
    itemId = null
    _one("#deleteModal").style.display = 'none';
    console.log(res)
}
function onUpdateImage(){
    console.log(itemList)
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
            console.log("appending")
            data.append(el.name, el.value)
        }
    })
    data.append('image',file.files[0])
    console.log(data)
    let conn = await fetch('update-image',{
        method: 'POST',
        body: data
    })
    let res = await conn.json()
    console.log(res)
    console.log(conn)
    if(conn.ok){
        itemList = []
        _all(".item").forEach(itemNode => {
            console.log(itemNode)
            itemNode.remove();
        });
        getItems();
        _one("#updateImageModal").style.display = 'none';
    }
}
function onUpdateItem(){
    console.log(itemList)
    let item = itemList.find(item => (item.id == event.target.getAttribute('data-id')))
    _one("#updateModal p").innerText = `Updating ${item.id}`
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
    let conn = await fetch('update-product',{
        method: 'POST',
        body: data
    })
    let res = await conn.json()
    console.log(res)
    console.log(conn)
    if(conn.ok){
        itemList = []
        _all(".item").forEach(itemNode => {
            console.log(itemNode)
            itemNode.remove();
        });
        getItems();
        _one("#updateModal").style.display = 'none';
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
    let conn = await fetch('delete-products',{
        method: 'POST',
        body: new FormData(form)
    })
    let res = await conn.text()
        console.log(res)
        console.log(conn)
    if(conn.ok){
        itemList = []
        _all(".item").forEach(itemNode => {
            itemNode.remove();
        });
        getItems();
        _one("#deleteMultipleModal").style.display = 'none';
    }
}

function cancel(){
    if(!event.target.form && !event.target.classList.contains('modalContent') && !event.target.parentElement.classList.contains('modalContent') || event.target.classList.contains('cancelBtn') ){
        _all(".modal").forEach(e => {
            e.style.display = 'none';
        });
        deleteEvent = null
        itemId = null   
    }    
}