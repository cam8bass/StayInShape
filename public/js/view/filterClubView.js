import View from "./View.js";

class FilterClub extends View {
  _parentBtn = document.querySelector(".list__filter") ?? "";
  _parentElement = document.querySelector(".list");
  _errorMessage = "Aucun club ne correspond à votre recherche";
  _userType = "Club";

  clubsProfileHandlerActive = function (handler) {
    if (this._parentBtn) {
      this._parentBtn.addEventListener("click", function (e) {
        const btnActive = e.target.closest("#active-club");
        if (!btnActive) return;
        handler();
      });
    } else return;
  };

  clubsProfileHandlerDisabled = function (handler) {
    if (this._parentBtn) {
      this._parentBtn.addEventListener("click", function (e) {
        const btnDisabled = e.target.closest("#inactive-club");
        if (!btnDisabled) return;
        handler();
      });
    } else return;
  };

  clubsProfileHandlerAll = function (handler) {
    if (this._parentBtn) {
      this._parentBtn.addEventListener("click", function (e) {
        const btnAll = e.target.closest("#all-club");
        if (!btnAll) return;
        handler();
      });
    } else return;
  };

  _generateMarkup() {
    return this._data
      .map((profile) => this.displayFilteredClub(profile))
      .join("");
  }

  displayFilteredClub = function (profile) {
    this._clear();
    return `
      <a href="../../index.php?status=on&action=showClubProfile&id=
      ${profile.idClub} "
       class="list__link">

        <div class="list__block
        ${profile.status === "enabled" ? "active" : "inactive"} ">

        <img src="${profile.img} " alt=" picture profile" class="list__img" />

        <img src="./public/img/icons/${
          profile.status === "enabled"
            ? "icon-active-blue.png"
            : "icon-inactive-blue.png"
        }"
         alt="icone status" class="list__icon list__icon-active" />

          <ul class="list__list">

            <li class="list__item">
              <p class="list__text">Stay in shape :  ${profile.clubName} </p>
            </li>

            <li class="list__item">
              <p class="list__text">Responsable:
                ${profile.firstName} ${profile.lastName} </p>
            </li>

            <li class="list__item">
              <p class="list__text">Email :  ${profile.email} </p>
            </li>

            <li class="list__item">
              <p class="list__text">Type :  ${profile.type}</p>
            </li>

            <li class="list__item">
            <p class="list__text">Franchise responsable : ${
              profile.nameFranchiseOwner
            }</p>
            </li>

            <li class="list__item">
              <p class="list__text">Profil :  ${
                profile.status === "enabled" ? "Actif" : "Désactivé"
              } </p>
            </li>

          </ul>
        </div>
      </a>
      `;
  };
}

export default new FilterClub();
