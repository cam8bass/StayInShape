// === Permet d'établir la connection ===
export const AJAX = async function (url) {
  try {
    const fetchPro = fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const res = await fetchPro;
    const data = await res.json();
    if (!res.ok) throw new Error(`${data.message} (${res.status})`);
    return data;
  } catch (error) {
    throw error;

  }
};

// === Permet de trier les utilisateurs par nom et prénom ===
export const orderList = function (data) {
  const orderData = data.sort((a, b) => {
    if (a.firstName && a.lastName < b.firstName && b.lastName) {
      return -1;
    }

    if (a.firstName && a.lastName > b.firstName && b.lastName) {
      return 1;
    }
    return 0;
  });
  return orderData;
};

// === Permet de filter des données ===
export const filterData = function (searchedString, dataArray) {
  const filterArr = dataArray.filter(
    (el) =>
      el.firstName.toLowerCase().includes(searchedString) ||
      el.lastName.toLowerCase().includes(searchedString) ||
      `${el.firstName + el.lastName}`
        .toLowerCase()
        .replace(/\s/g, "")
        .includes(searchedString) ||
      `${el.lastName + el.firstName}`
        .toLowerCase()
        .replace(/\s/g, "")
        .includes(searchedString)
  );
  return filterArr;
};

// === Permet de fermer et d'ouvrir une modale ===
export const openSearchResult = function (window, background) {
  window.classList.remove("hidden");
  background.classList.remove("hidden");
};

export const closeSearchResult = function (window, background) {
  window.classList.add("hidden");
  background.classList.add("hidden");
};

export const windowOpenHandler = function (searchInput, searchResult, overlay) {
  // Permet d'ouvrir la fenetre de recherche
  searchInput.addEventListener("click", function () {
    openSearchResult(searchResult, overlay);
  });
};

export const windowCloseHandler = function (btnClose, searchResult, overlay) {
  // Permet de fermer la fenetre avec l'aide du bouton de fermeture
  btnClose.addEventListener("click", function () {
    closeSearchResult(searchResult, overlay);
  });

  // Permet de fermet la fenetre à l'aide de la touche echap
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && !searchResult.classList.contains("hidden")) {
      closeSearchResult(searchResult, overlay);
    }
  });
};


