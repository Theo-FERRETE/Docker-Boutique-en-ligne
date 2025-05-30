const API_KEY = "ab55f219e1a842bea225f2d3c54eaa1c"; 

const gamesDiv = document.getElementById('games');
const searchInput = document.getElementById('search');
const consoleSelect = document.getElementById('consoleFilter');

let currentPage = 1;
let currentQuery = '';
let currentPlatform = '';
const pageSize = 20;

// Affiche la liste des jeux dans le catalogue
function displayGames(games) {
  gamesDiv.innerHTML = '';
  if (!games || games.length === 0) {
    gamesDiv.innerHTML = "<p style='color:#ff9800;margin:2rem 0;text-align:center;'>Aucun jeu trouvé.</p>";
    return;
  }
  games.forEach((game) => {
    const card = document.createElement("div");
    card.className = "game-card";
    card.innerHTML = `
      <img src="${game.background_image}" alt="${game.name}" />
      <h3>${game.name}</h3>
      <p>Note : ${game.rating}/5</p>
      <a href="jeu.php?id=${game.id}" class="see-detail-btn">Voir</a>
    `;
    gamesDiv.appendChild(card);
  });
}

// Affiche la pagination
function displayPagination(hasPrev, hasNext) {
  let paginationDiv = document.getElementById("pagination");
  if (!paginationDiv) {
    paginationDiv = document.createElement("div");
    paginationDiv.id = "pagination";
    gamesDiv.parentNode.appendChild(paginationDiv);
  }
  paginationDiv.innerHTML = `
    <button ${hasPrev ? "" : "disabled"} onclick="goToPage(${currentPage - 1})">Précédent</button>
    <span>Page ${currentPage}</span>
    <button ${hasNext ? "" : "disabled"} onclick="goToPage(${currentPage + 1})">Suivant</button>
  `;
  paginationDiv.style.display = "flex";
}

// Récupère les jeux depuis l'API RAWG selon les filtres/recherche/page
function fetchGames(query = '', platform = '', page = 1) {
  currentQuery = query;
  currentPlatform = platform;
  currentPage = page;
  let url = `https://api.rawg.io/api/games?key=${API_KEY}&page_size=${pageSize}&page=${page}`;
  if (query && query.length > 2) url += `&search=${encodeURIComponent(query)}`;
  if (platform) url += `&parent_platforms=${platform}`;
  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      displayGames(data.results);
      displayPagination(!!data.previous, !!data.next);
    })
    .catch(() => {
      gamesDiv.innerHTML = "<p style='color:#ff9800;margin:2rem 0;text-align:center;'>Erreur lors du chargement des jeux.</p>";
      let paginationDiv = document.getElementById("pagination");
      if (paginationDiv) paginationDiv.style.display = "none";
    });
}

// Pour la pagination (accessible globalement)
window.goToPage = function (page) {
  fetchGames(currentQuery, currentPlatform, page);
};

// Recherche dynamique
searchInput.addEventListener("input", (e) => {
  const value = e.target.value;
  if (value.length > 2) fetchGames(value, consoleSelect.value, 1);
  else fetchGames('', consoleSelect.value, 1);
});

// Filtre plateforme
consoleSelect.addEventListener("change", () => {
  fetchGames(searchInput.value, consoleSelect.value, 1);
});

// Initialisation au chargement de la page
fetchGames();
