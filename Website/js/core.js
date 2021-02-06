function toggleClassActive(id) {
    id.classList.toggle("active");
}

function menuAnimation(id, sid) {
    if (id.classList.contains("active")) {
        id.classList.add("menu_closing");
        sid.ontransitionend=() => {
            id.classList.remove("menu_closing");
        };
    }
    else {
        id.classList.add("menu_opening")
        sid.ontransitionend=() => {
            id.classList.remove("menu_opening");
        };
    }

}

function smoothScroll(id, sid) {
    menuAnimation(id, sid);
    toggleClassActive(id);
}