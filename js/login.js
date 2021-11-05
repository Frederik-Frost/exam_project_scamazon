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
})


async function login(event){
    let form = event.target.form; //cant use event.target when using santiagos validator??
    console.log("object")
    console.log(form)
    let conn = await fetch('userlogin', {
        'method': 'POST',
        'Content-Type': 'application/json',
        'body': new FormData(form)
    })
    let res = await conn.json()
    if(conn.ok){
        location.href = "/"
    } else{
        document.querySelector(".errorMsg").innerText = res.info;
    }
}

async function onResetPassword(event){
    let form = event.target.form;
    let conn = await fetch('reset-password-request', {
        'method': 'POST',
        'Content-Type': 'application/json',
        'body': new FormData(form)
    })
    let res = await conn.json()
    console.log(res)
    document.querySelector(".feedbackMsg").innerText = res.info;
    if(conn.ok){
        
    }

}



function toggleReset(){
    console.log("object")
    document.querySelectorAll("form").forEach(e => {
        e.classList.toggle("hidden")
    })
}
