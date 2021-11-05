async function signUp(){
    let conn = await fetch("signup", {
        'method': 'POST',
        'Content-Type': 'application/json',
        'body': new FormData(document.querySelector("#signupForm"))
    });
    let response = await conn.json()
    if(response && response.created == true){
        document.querySelector("#signupForm").style.display = "none";
        document.querySelector(".succesMessage").style.display = "block";
        console.log("You should have recieved an email to verify you new account")
    }
}

