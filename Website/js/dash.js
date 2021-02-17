



function scrollAnimation(pid, string) {
    if (pid.classList.contains("dashboard")) {
        console.log("yes");
        pid.classList.toggle("dashboard");
        pid.classList.add(string);
        pid.classList.add("animate");
        pid.ontransitionend=() => {
            pid.classList.remove("animate");
        }
    }
    if (pid.classList.contains("appointments")) {
        pid.classList.remove("appointments");
        pid.classList.add(string);
        pid.classList.add("animate");
        pid.ontransitionend=() => {
            pid.classList.remove("animate");
        }
    }
}