function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}

window.addEventListener('DOMContentLoaded', () => {
    getItems();
})

async function getItems(){
    console.log("object!")
    let response = await fetch('getit', {
            'method': 'POST',
            'Content-Type': 'application/json'
        })
    let items = await response.json()
    console.log(response)
    console.log(items)
    // items.forEach(item => {
    //     addToList(item)
    // })
}   

function addToList(data){
    const itemElement = `<div class="item">
                            <div>${data.item_name} </div>
                        </div>`
    one("#items").insertAdjacentHTML("beforeend", itemElement)
} 