import { AJAX } from "./helpers.js";

export const clubs = {
  allActiveClubs: "",
  allDisabledClubs: "",
  allClubs: "",
};

export const partner = {
  allActivePartner: "",
  allDisabledPartner: "",
  allPartner: "",
};

// === FILTER PROFILE ===

const filterActiveProfile = function (data) {
  const allClubs = data;

  const allActiveClubs = allClubs.filter((user) => user.status === "enabled");
  return allActiveClubs;
};
const filterProfileDisable = function (data) {
  const allClubs = data;
  const allDisabledClubs = allClubs.filter(
    (user) => user.status === "disabled"
  );
  return allDisabledClubs;
};

const loadAllClubs = async function () {
  // Permet de récupérer tous les clubs
  const results = await AJAX("src/helpers/techClubFilter.php");
  const allActiveClubs = filterActiveProfile(results);
  const allDisabledClubs = filterProfileDisable(results);

  clubs.allClubs = results;
  clubs.allActiveClubs = allActiveClubs;
  clubs.allDisabledClubs = allDisabledClubs;
};

loadAllClubs();

const loadAllPartner = async function () {
  //Permet de récupérer tous les partenaires
  const results = await AJAX("src/helpers/techPartnerFilter.php");
  const allActivePartner = filterActiveProfile(results);
  const allDisabledPartner = filterProfileDisable(results);

  partner.allPartner = results;
  partner.allActivePartner = allActivePartner;
  partner.allDisabledPartner = allDisabledPartner;
};

loadAllPartner();
