(function () {
    var openBtn = document.getElementById("navMenuOpen");
    var menu = document.getElementById("navMenu");

    if (!openBtn || !menu) {
        return;
    }

    openBtn.addEventListener("click", function () {
        var isOpen = menu.classList.toggle("is-open");
        openBtn.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
})();
