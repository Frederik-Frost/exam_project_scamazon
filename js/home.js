function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}
// let urlSearchParams;
// let params;
window.addEventListener('DOMContentLoaded', () => {
    // urlSearchParams = new URLSearchParams(window.location.search);
    // params = Object.fromEntries(urlSearchParams.entries());
    getProduct();
    getAffiliateProduct();
})

async function getProduct(){
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
    const languageData = findLanguageData(data)
    const itemElement = `<div class="item product">
                            <h3>${languageData.title}</h3>
                            <img src="../assets/product-images/${data.image_path}" alt="img">
                            <div>${languageData.description}</div>
                            <div class="price">DKK ${data.price}</div>
                            <button onclick="addToBasket(); return false" class="btn btnPrimary">Add to basket</button>
                        </div>`
    one("#products .items").insertAdjacentHTML("beforeend", itemElement)
} 

async function getAffiliateProduct(){
    let response = await fetch('get-affiliate-products', {
        'method': 'POST',
        'Content-Type': 'application/json'
    })
    let items = await response.json()
    console.log(response)
    console.log(items)
    items.forEach(item => {
        addToAffiliateList(item)
    })
}

function addToAffiliateList(data){   
    const languageData = findLanguageData(data)
    const itemElement = `<div class="item affiliateProduct">
                            <h3>${languageData.title}</h3>
                            <img src='https://coderspage.com/2021-F-Web-Dev-Images/${data.image}'>
                            <div>${languageData.description}</div>
                            <div class="price">DKK ${data.price}</div>
                            <button onclick="addToBasket(); return false" class="btn btnPrimary">Add to basket</button>
                        </div>`
    one("#affiliateProducts .items").insertAdjacentHTML("beforeend", itemElement)
} 

function findLanguageData(data) {
    switch(params.lang){ // Params already defined in nav.js
        case 'da': return {title: data.title_da, description: data.description_da || data.description}   
        case 'en': return {title: data.title_en, description: data.description_en || data.description}
        default: return {title: data.title_en, description: data.description_en || data.description}
    }
}