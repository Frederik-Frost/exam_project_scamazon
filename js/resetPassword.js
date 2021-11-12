function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}

window.addEventListener('DOMContentLoaded', () => {
    const params = Object.fromEntries(urlSearchParams.entries());
    one("#hiddenKeyInput").value = params.key
})

async function newPassword(event){
    let form = event.target.form;
    if(one("#passwordInput").value != one("#repeatPasswordInput").value){
    } else{
        let conn = await fetch('new-password', {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': new FormData(form)
        })
        let res = await conn.json()
        
        if(conn.ok){
            location.href = "/login?passwordDidReset=true"
        } else if(res.info == "Wrong key"){
            one('.errorMsg').innerHTML = 'This link is outdated - request a new one if needed <a href="login?requestNewReset=true">here</button>';
        } else{ one('.errorMsg').innerText = res.info}
    }
}