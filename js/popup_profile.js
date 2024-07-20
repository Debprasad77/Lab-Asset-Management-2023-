
const popupProfile = document.getElementById("popup_profile");

function PopupProfile() {
  popupProfile.classList.toggle("showp");
}


window.addEventListener('click',clickOutside)

function clickOutside(p) {
    if (!p.target.matches(".fa-user-circle")) {
      popupProfile.classList.remove("showp");

        

    }
}


popupProfile.addEventListener("click", (e) => e.stopPropagation());
