
const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

// console.log(params.lang)
// one(".current-lang").style.background = 'blue';

function setCurrentFlag(lang){
    console.log(lang)
    switch(lang){
        case 'da':
            one(".current-lang img").src = "/../assets/png/denmark-flag-square-xs.png"
            break;
            case 'en':
                one(".current-lang img").src = "/../assets/png/united-kingdom-flag-square-small.png"
          break;
        default:
            one(".current-lang img").src =  "/../assets/png/united-kingdom-flag-square-small.png"
    }
}

function changeLang(lang){
    //Should use routing for this
    console.log(window.location.href)    
    console.log(lang)
}

