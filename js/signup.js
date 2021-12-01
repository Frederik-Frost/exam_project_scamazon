window.addEventListener('DOMContentLoaded', () => {
    _one("body").style.background = '#fff';
})
async function signUp(){
    try{
        let conn = await fetch("signup", {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': new FormData(_one("#signupForm"))
        });
        let response = await conn.json()
        if(response && response.created == true){
            _one("#signupForm").style.display = "none";
            _one(".succesMessage").style.display = "block";
            sendWelcomeSMS(response)
        }
    }catch(e){
        console.log(e)
        _one(".errorMsg").innerText = "System under maintenance - try again later";
    }
}
async function sendWelcomeSMS(info){
    try{
        const smsData = new FormData();
        const message = `Hello ${info.user_name}, welcome to Scamazon! remember to buy nothing its all a scam`
        smsData.append('phone', info.user_phone)
        smsData.append('sms', message)
        let conn = await fetch("send-sms", {
            'method': 'POST',
            'body': smsData
        });
        let response = await conn.json()
        console.log(response)
    }catch(e){
        console.log(e)
        _one(".errorMsg").innerText = "System under maintenance - try again later";
    }
}