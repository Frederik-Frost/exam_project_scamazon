function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}

window.addEventListener('DOMContentLoaded', () => {
    const params = Object.fromEntries(urlSearchParams.entries());
    if(params.passwordDidReset){
        one(".infoTxt").innerText = 'You can now log in with your new password';
        one(".infoTxt").classList.add('textSuccess')
    }
    if(params.requestNewReset){
        toggleReset();
    }
    if(params.loginNeeded){
        one(".infoTxt").innerText = 'Please login before you can manage products';
        one(".infoTxt").classList.add('textDanger')
    }
    one("body").style.background = '#fff';
})

async function login(){
    try{
        let form = event.target;
        let conn = await fetch('userlogin', {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': new FormData(form)
        })
        let res = await conn.json()
        if(conn.ok){
            location.href = params.loginNeeded ? params.loginNeeded : "/" 
        } else one(".errorMsg").innerText = res.info;
    } catch(e){
        console.log(e)
        one(".errorMsg").innerText = "System under maintenance - try again later";
    }
}

async function onResetPassword(){
    try{
        let form = event.target;
        let conn = await fetch('reset-password-request', {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': new FormData(form)
        })
        let res = await conn.json()
        console.log(res)
        one(".feedbackMsg").innerText = res.info;
        if(res.success == true) one(".feedbackMsg").classList.add("textSuccess")
        else one(".feedbackMsg").classList.add("textDanger")
        
    } catch(e){
        console.log(e)
        one(".feedbackMsg").innerText =  "System under maintenance - try again later";
    }
}

function toggleReset(){
        all("form").forEach(e => {
        e.classList.toggle("hidden")
    })
}
