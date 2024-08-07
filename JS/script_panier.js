const menu = document.getElementById("btnCode");

const sub = document.getElementById("btnSub");

const div = document.getElementById("promo");

display = menu.addEventListener("click", () => {
    if (div.classList.contains("hidden")) {
        div.classList.remove("hidden");
    } else {
        div.classList.add("hidden");
    }
});

display = sub.addEventListener("click", () => {
        div.classList.add("hidden");
    }
);

