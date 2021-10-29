function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}

// window.addEventListener('DOMContentLoaded', () => {
//     getItems();
// })

// async function getItems(){
//     let response = await fetch('../api/fetch-items.php')
//     let items = await response.json()
//     items.forEach(item => {
//         addToList(item)
//     })
// }   

function addToList(data){
    const itemElement = `<div class="item">
                            <div>${data.item_name} </div>
                        </div>`
    one("#items").insertAdjacentHTML("beforeend", itemElement)
} 