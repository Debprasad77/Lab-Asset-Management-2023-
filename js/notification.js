
const popup = document.getElementById("popup_form")

function Notifi() {
    popup.classList.toggle("show")
}

window.onclick=(e)=>{
    if (!e.target.matches('.fa-bell')) {
        if(popup.classList.contains('show')){
            popup.classList.remove('show')
        }
    }
}


popup.addEventListener("click",e=>e.stopPropagation())


