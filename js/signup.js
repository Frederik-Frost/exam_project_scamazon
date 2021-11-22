
window.addEventListener('DOMContentLoaded', () => {
    _one("body").style.background = '#fff';
})

async function signUp(){
    let conn = await fetch("signup", {
        'method': 'POST',
        'Content-Type': 'application/json',
        'body': new FormData(_one("#signupForm"))
    });
    let response = await conn.json()
    if(response && response.created == true){
        _one("#signupForm").style.display = "none";
        _one(".succesMessage").style.display = "block";
        console.log("You should have recieved an email to verify you new account")
    }
}

