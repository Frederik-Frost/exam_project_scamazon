function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}
let deleteEvent;
let itemId;
let itemList = [];
window.addEventListener('DOMContentLoaded', () => {
    getItems();
})

async function getItems(){
    console.log("object!")
    let response = await fetch('getproducts', {
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
    const itemElement = `<tr class="item">
                            <td class="productImg"><img src="/../assets/product-images/${data.image_path}" alt="${data.image_path}"</td>
                            <td>${data.title_da}</td>
                            <td>${data.title_en}</td>
                            <td>${data.price}</td>
                            <td onclick="onUpdateItem()" data-id="${data.id}" data-name="${data.id}" data-price="${data.price}" class="updateItem"><i class="fas fa-pen"></i></i></td>
                            <td onclick="onDeleteItem()" data-id="${data.id}" data-name="${data.title_en}" class="deleteItem"><i class="far fa-trash-alt"></i></td>
                            <td data-id="${data.item_id}" data-name="${data.item_name}" class="bulk-action">  
                                <input type="checkbox" id="selectedID[${data.item_id}]" class="idCheckbox" value="${data.item_id}"> 
                            </td>
                        </tr>`
    one("#items").insertAdjacentHTML("beforeend", itemElement)
}


async function uploadItem(){
    // let form = event.target.form;
    let file = one("input[type='file']")
    let data = new FormData()
    
    all("#uploadForm input").forEach(el => {
        if(el.type != "file"){
            console.log("appending")
            data.append(el.name, el.value)
        }
    });
    all("#uploadForm textarea").forEach(el => {
        data.append(el.name, el.textContent)
    });
    data.append('image',file.files[0])
    console.log(data)
    
    let conn = await fetch('uploadproduct', {
        'method': 'POST',
        // 'Content-Type': 'application/json',
        'Content-Type': 'multipart/form-data',
        'body': data
    })
    let res = await conn.json()
    console.log(res)
    if(conn.ok){
        let data = res.data
        data.image_path = res.file.image.name
        console.log(data)
        addToList(data)
        // addToList({id: res.id, title_da: "as", title_en: "asd", price: "asd", description_en: "", description_da: "", image_path: ""  })
        all("#uploadForm input").forEach(e => {
            e.value = ''
        })
        all("#uploadForm textarea").forEach(e => {
            e.innerText = ''
        })
        one("#uploadForm .titleInput").focus()
    } 
}
function onDeleteItem(){
    deleteEvent = event
    itemId = event.target.getAttribute('data-id')
    _one("#deleteModal p").innerText = `Really delete ${event.target.getAttribute('data-id')} from product list?`
    _one("#deleteModal").style.display = 'block';
}

async function deleteItem(){
    deleteEvent.target.parentElement.remove()
    const conn = await fetch('delete-product?item_id='+ itemId,{
        method: 'GET'
    })
    const res = await conn.json()
    deleteEvent = null
    itemId = null
    _one("#deleteModal").style.display = 'none';
    console.log(res)
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