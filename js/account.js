async function updateUserInfo(){
    _one(".textDanger").innerText = null
    _one(".textSuccess").innerText = null
    try{
        const form = event.target
        console.log(form)
        let conn = await fetch("update-user", {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': new FormData(form)
        });
        let response = await conn.json()
        if(conn.status != 200) _one(".textDanger").innerText = response.info
        else _one(".textSuccess").innerText = response.info;
    } catch(e){
        _one(".textDanger").innerText = response.info
    }
}

function onChangePassword(){
    _one("#changePasswordModal").style.display = 'block';
}

async function changePassword(){
    const newPass = _one("#changePasswordModal .newPasswordInput")
    const repeatPass = _one("#changePasswordModal .repeatPasswordInput")
    if(newPass.value === repeatPass.value){
        try{
            const form = event.target
            let conn = await fetch("change-password", {
                'method': 'POST',
                'Content-Type': 'application/json',
                'body': new FormData(form)
            });
            let response = await conn.json()
            if(conn.status != 200){
                _one("#changePasswordModal .errorMsg").innerText = response.info
            } else{
                _one("#changePasswordModal").style.display = 'none';
                _one(".textSuccess").innerText = response.info;
            }
        } catch(e){
            console.log(e)
        }
    } else{
        _one("#changePasswordModal .errorMsg").innerText = 'new password and repeat password dont match'
    }
}

function cancel(){
    if(event.target.classList.contains('modal') || event.target.classList.contains('cancelBtn')){
        _all(".modal").forEach(e => {
            e.style.display = 'none';
        });
    }
}