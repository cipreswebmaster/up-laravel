const cards = document.querySelectorAll(".card");

// Habilitando buscador
const inputSearch = document.querySelector("input#search");
inputSearch.addEventListener("input", function (e) {
    cards.forEach(function (card) {
        const cardText = card.querySelector(".card-title .title").innerText;
        if (
            cardText.toLowerCase().indexOf(e.target.value.toLowerCase()) == -1
        ) {
            card.classList.add("non");
        } else if (card.classList.contains("non")) card.classList.remove("non");
    });
});

//sHabilitando la selección por áreas
const areas = document.querySelectorAll(".area");
areas.forEach(function (area) {
    area.addEventListener("click", function (e) {
        const areaContainer = e.target.parentNode;
        const isActive = areaContainer.classList.contains("active");
        if (isActive) {
            areaContainer.classList.remove("active");
        } else {
            const actual = document.querySelector(".area.active");
            if (actual) actual.classList.remove("active");
            areaContainer.classList.add("active");
        }
        cards.forEach(function (card) {
            if (isActive || areaContainer.id == "all") {
                card.style.display = "block";
                return;
            }

            if (card.classList.contains(areaContainer.id)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
});
