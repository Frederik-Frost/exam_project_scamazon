window.addEventListener('DOMContentLoaded', () => {
 console.log("object")
})

async function updateUserInfo(){
    const form = event.target
    try{
        let conn = await fetch("update-user", {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': new FormData(form)
        });
        let response = await conn.json()
       console.log(conn)
       console.log(response)
    } catch(e){
        console.log(e)
    }
}