import * as helpers from "./helpers.js";

const searchInput = document.querySelector("#search");
const searchResult = document.querySelector(".searchResults__block");
const btnClose = document.querySelector(".searchResults__btn");
const overlay = document.querySelector(".searchResults");

let dataArray = [];

const displayAllUserList = function (usersList) {
  usersList.forEach((user) => {
    const listItem = document.createElement("a");
    listItem.setAttribute(
      "href",
      `../../index.php?status=on&action=${
        user.type === "Club" ? "showClubProfile" : "showPartnerProfile"
      }&id=${user.type === "Club" ? user.idClub : user.idPartner}`
    );

    listItem.setAttribute("class", "searchResults__link");

    listItem.innerHTML = `
 
    <img src="${user.img}" alt="profile picture" class="searchResults__item searchResults__item-img">
      <p class="searchResults__item">${user.firstName}</p>
      <p class="searchResults__item">${user.lastName}</p>
      <p class="searchResults__item">${user.type}</p>
      <a href="mailto:${user.email}" class="searchResults__item searchResults__item-email">${user.email}</a>
      `;

    searchResult.appendChild(listItem);
  });
};

const searchAllUser = async function () {
  //Permet de récupérer les info des users
  const results = await helpers.AJAX("src/helpers/techSearch.php");
  // Permet de trier les users récupérés
  dataArray = helpers.orderList(results);
  displayAllUserList(dataArray);
};

// Permet de filter les données lors de la saisie dans l'input
searchInput.addEventListener("input", function (e) {
  searchResult.innerHTML = "";
  const searchedString = e.target.value.toLowerCase().replace(/\s/g, "");
  const filterArr = helpers.filterData(searchedString, dataArray);
  displayAllUserList(filterArr);
});

const init = function () {
  searchAllUser();
  helpers.windowOpenHandler(searchInput, searchResult, overlay);
  helpers.windowCloseHandler(btnClose, searchResult, overlay);
};
init();
