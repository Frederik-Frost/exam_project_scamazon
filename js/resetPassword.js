window.addEventListener('DOMContentLoaded', () => {
    const params = Object.fromEntries(urlSearchParams.entries());
    _one("#hiddenKeyInput").value = params.key
    _one("body").style.background = '#fff';
})

async function newPassword(){
    const form = event.target;
    if(_one("#passwordInput").value != _one("#repeatPasswordInput").value){
        _one('.errorMsg').innerHTML = 'Passwords dont match';
    } else{
        try{
            let conn = await fetch('new-password', {
                'method': 'POST',
                'Content-Type': 'application/json',
                'body': new FormData(form)
            })
            let res = await conn.json()
            
            if(conn.ok){
                location.href = "/login?passwordDidReset=true"
            } else if(res.info == "Wrong key"){
                _one('.errorMsg').innerHTML = 'This link is outdated - request a new _one if needed <a href="login?requestNewReset=true">here</button>';
            } else{ _one('.errorMsg').innerText = res.info}
        }catch(e){
            console.log(e)
            _one('.errorMsg').innerHTML = 'System under maintenance - try again later';
        }
    }
}