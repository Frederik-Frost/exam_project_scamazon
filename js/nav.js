console.log("object")

function one(query){return document.querySelector(query)}
function all(query){return document.querySelectorAll(query)}

const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

console.log(params.lang)
// one(".current-lang").style.background = 'blue';



function changeLang(lang){
    //Should use routing for this
}

switch(params.lang){
    case 'dk':
        one(".current-lang img").src = "/../assets/png/denmark-flag-square-xs.png"
        break;
        case 'en':
            one(".current-lang img").src = "/../assets/png/united-kingdom-flag-square-small.png"
      break;
    default:
        one(".current-lang img").src =  "/../assets/png/united-kingdom-flag-square-small.png"
  }