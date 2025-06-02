window.addEventListener("scroll", function() {
    const pageTop = document.getElementById("pageTop");
    if (window.scrollY > 1000) {
        pageTop.classList.add("show");
    } else {
        pageTop.classList.remove("show");
    }
});
document.getElementById("pageTop").addEventListener("click", function(e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});