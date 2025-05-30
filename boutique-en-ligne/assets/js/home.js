const API_KEY = "ab55f219e1a842bea225f2d3c54eaa1c"; 
const featuredDiv = document.getElementById('featured-games');

fetch(`https://api.rawg.io/api/games?key=${API_KEY}&ordering=-added&page_size=8`)
  .then(res => res.json())
  .then(data => {
    featuredDiv.innerHTML = data.results.map(game => `
      <div class="game-card">
        <img src="${game.background_image}" alt="${game.name}">
        <h3>${game.name}</h3>
        <p>Note : ${game.rating}/5</p>
        <a href="jeux.php?game=${game.id}" class="see-detail-btn">Voir</a>
      </div>
    `).join('');
  });
