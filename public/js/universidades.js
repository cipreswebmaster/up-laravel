/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/universidades.js ***!
  \***************************************/
// Habilitando buscador
var inputSearch = document.querySelector("input#search");
inputSearch.addEventListener("input", function (e) {
  var orderCiudad = document.getElementById("orderCiudad");
  var cards = document.querySelectorAll(".card");
  cards.forEach(function (card) {
    var cardText = card.querySelector(".info .title").innerText;

    if (cardText.toLowerCase().indexOf(e.target.value.toLowerCase()) == -1) {
      card.classList.add("non");
    } else if (card.classList.contains("non")) {
      if (!orderCiudad || orderCiudad.value == 0 || orderCiudad.value == card.dataset.ciudad) {
        card.classList.remove("non");
      }
    }
  });
});
/******/ })()
;