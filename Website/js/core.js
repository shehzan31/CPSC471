/*
    Authors:            Tyler Hartleb,
    Initial Date:       02/05/2021
    Last Update:        02/05/2021
    Version:            0.1

    This provides core javascript functions.
*/

/* The purpose of this function is to toggle a class onto a html id */
function toggleClassActive(id) {
    id.classList.toggle("active");
}

/* The purpose of this is to determine when the transition for the mobile menu has ended */
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

/* This combines the previous two functions to create a smooth scrolling animation for the mobile menu */
function smoothScroll(id, sid) {
    menuAnimation(id, sid);
    toggleClassActive(id);
}