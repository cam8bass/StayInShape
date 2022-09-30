import * as model from "./model.js";
import filterClub from "./view/filterClubView.js";
import filterPartner from "./view/filterPartnerView.js";

const controleActiveClub = function () {
  filterClub.render(model.clubs.allActiveClubs);
};

const controleDisabledClub = function () {
  filterClub.render(model.clubs.allDisabledClubs);
};

const controleAllClubs = function () {
  filterClub.render(model.clubs.allClubs);
};

// === Partner ===

const controleAllPartner = function () {
  filterPartner.render(model.partner.allPartner);
};

const controleDisabledPartner = function () {
  filterPartner.render(model.partner.allDisabledPartner);
};

const controleActivePartner = function () {
  filterPartner.render(model.partner.allActivePartner);
};

const init = function () {
  filterClub.clubsProfileHandlerActive(controleActiveClub);
  filterClub.clubsProfileHandlerDisabled(controleDisabledClub);
  filterClub.clubsProfileHandlerAll(controleAllClubs);

  filterPartner.partnerProfileHandlerActive(controleActivePartner);
  filterPartner.partnerProfileHandlerDisabled(controleDisabledPartner);
  filterPartner.partnerProfileHandlerAll(controleAllPartner);
};
init();
