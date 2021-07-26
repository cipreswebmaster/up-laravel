const inputSearch = document.querySelector("input#search");
inputSearch.addEventListener("input", function (e) {
    const cards = document.querySelectorAll(".card");
    cards.forEach(function (card) {
        const cardText = card.querySelector(".card-title .title").innerText;
        if (
            cardText.toLowerCase().indexOf(e.target.value.toLowerCase()) == -1
        ) {
            card.classList.add("non");
        } else if (card.classList.contains("non")) card.classList.remove("non");
    });
});
