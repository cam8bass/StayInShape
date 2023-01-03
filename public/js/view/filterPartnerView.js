import View from "./View.js";

class FilterPartner extends View {
  _parentBtn = document.querySelector(".list__filter") ?? "";
  _parentElement = document.querySelector(".list");
  _errorMessage = "Aucun partenaire ne correspond à votre recherche";
  _userType = "Partner";

  partnerProfileHandlerActive = function (handler) {
    if (this._parentBtn) {
      this._parentBtn.addEventListener("click", function (e) {
        const btnActive = e.target.closest("#active-partner");
        if (!btnActive) return;
        handler();
      });
    } else return;
  };

  partnerProfileHandlerDisabled = function (handler) {
    if (this._parentBtn) {
      this._parentBtn.addEventListener("click", function (e) {
        const btnDisabled = e.target.closest("#inactive-partner");
        if (!btnDisabled) return;
        handler();
      });
    } else return;
  };

  partnerProfileHandlerAll = function (handler) {
    if (this._parentBtn) {
      this._parentBtn.addEventListener("click", function (e) {
        const btnAll = e.target.closest("#all-partner");
        if (!btnAll) return;
        handler();
      });
    } else return;
  };

  _generateMarkup() {
    return this._data
      .map((profile) => this.displayFilteredPartner(profile))
      .join("");
  }

  displayFilteredPartner = function (profile) {
    this._clear();
    return `
      <a href="../../index.php?status=on&action=showPartnerProfile&id=${profile.idPartner} "
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
              <p class="list__text">Stay in shape :  ${
                profile.franchiseName
              } </p>
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
            <p class="list__text">Nombre de clubs : ${
              profile.attachedClub === ""
                ? "0"
                : profile.attachedClub.split(",").length
            } </p>
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

export default new FilterPartner();
