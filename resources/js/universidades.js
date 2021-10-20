// Habilitando buscador
const inputSearch = document.querySelector("input#search");
inputSearch.addEventListener("input", function (e) {
    const orderCiudad = document.getElementById("orderCiudad");
    const cards = document.querySelectorAll(`.card`);
    cards.forEach(function (card) {
        const cardText = card.querySelector(".info .title").innerText;
        if (
            cardText.toLowerCase().indexOf(e.target.value.toLowerCase()) == -1
        ) {
            card.classList.add("non");
        } else if (card.classList.contains("non")) {
            if (
                !orderCiudad ||
                orderCiudad.value == 0 ||
                orderCiudad.value == card.dataset.ciudad
            ) {
                card.classList.remove("non");
            }
        }
    });
});
