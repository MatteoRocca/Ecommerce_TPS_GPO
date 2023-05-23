function darkMode() {
    var checkbox = document.getElementById("checkbox");
    var body = document.body;
    if (checkbox.checked == true) {
        body.classList.add("dark-mode");
        document.cookie = "darkmode=1; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";
    } else {
        body.classList.remove("dark-mode");
        document.cookie = "darkmode=0; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";
    }
}
function darkModeApplay() {
    var checkbox = document.getElementById("checkbox");
    var body = document.body;
    body.classList.add("dark-mode");
    checkbox.checked = true;
}