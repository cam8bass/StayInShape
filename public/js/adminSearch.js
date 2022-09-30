import * as helpers from "./helpers.js"

const searchInput = document.querySelector("#search");
const searchResult = document.querySelector(".searchResults__block");
const btnClose = document.querySelector(".searchResults__btn");
const overlay = document.querySelector(".searchResults");

let dataArray = [];

// Permet de créer les éléments de la liste
const displayUserTechList = function (usersList) {
  usersList.forEach((user) => {
    const listItem = document.createElement("div");
    listItem.setAttribute("class", "searchResults__list");
    listItem.innerHTML = `
      <p class="searchResults__item">${user.firstName}</p>
      <p class="searchResults__item">${user.lastName}</p>
      <a href="mailto:${user.email}" class="searchResults__item searchResults__item-email">${user.email}</a>`;

    searchResult.appendChild(listItem);
  });
};

const searchAllTech = async function () {
  //Permet de récupérer les infos des users
  const results = await helpers.AJAX("src/helpers/adminSearch.php");
  // Permet de trier les users récupérés
  dataArray = helpers.orderList(results);
  displayUserTechList(dataArray);
};

// Permet de filtrer les données lors de la saisie dans l'input
searchInput.addEventListener("input", function (e) {
  searchResult.innerHTML = "";
  const searchedString = e.target.value.toLowerCase().replace(/\s/g, "");
  const filterArr = helpers.filterData(searchedString, dataArray);
  displayUserTechList(filterArr);
});


const init = function () {
  searchAllTech();
  helpers.windowOpenHandler(searchInput, searchResult, overlay);
  helpers.windowCloseHandler(btnClose, searchResult, overlay);
};
init();
