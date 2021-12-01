
const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

// console.log(params.lang)
// one(".current-lang").style.background = 'blue';
function toggleNav(){
    if(event.target.classList.contains('mobileNav') || event.target.classList.contains('fa-bars') ){
        document.querySelector(".mobileNav").classList.toggle("menuActive")
    }
}

async function changeLang(){
    let langRes = await setLang()
    console.log(langRes)
    localStorage.setItem('application_language', langRes);
    window.location.reload()
}

function setLang(){
    let lang = document.querySelector('.languageForm input[name="lang"]:checked').value
    let data = new FormData()
    data.append('language', lang)

    return new Promise((resolve, reject) => {
        fetch('change-language', {
            'method': 'POST',
            'Content-Type': 'application/json',
            'body': data
        }).then((response) => resolve(response.json()))
      });
}