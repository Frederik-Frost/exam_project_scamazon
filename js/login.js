async function login(event){
    let form = event.target.form; //cant use event.target when using santiagos validator??
    // console.log(form)
    // const email = document.querySelector("#emailInput");
    // const password = document.querySelector("#passwordInput");
    // const loginData = {
    //     email: email.value,
    //     password: password.value,
    // }
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