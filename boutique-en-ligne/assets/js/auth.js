// Onglets
const tabLogin = document.getElementById('tab-login');
const tabRegister = document.getElementById('tab-register');
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

tabLogin.onclick = () => {
  tabLogin.classList.add('active');
  tabRegister.classList.remove('active');
  loginForm.style.display = '';
  registerForm.style.display = 'none';
};
tabRegister.onclick = () => {
  tabRegister.classList.add('active');
  tabLogin.classList.remove('active');
  loginForm.style.display = 'none';
  registerForm.style.display = '';
};

// Connexion AJAX
loginForm.onsubmit = function(e) {
  e.preventDefault();
  document.getElementById('login-message').textContent = '';
  fetch('api/AuthController.php?action=login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      email: this.email.value,
      password: this.password.value
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      document.getElementById('login-message').style.color = 'green';
      document.getElementById('login-message').textContent = "Connexion réussie ! Redirection...";
      setTimeout(() => window.location.href = 'index.php', 1200);
    } else {
      document.getElementById('login-message').style.color = 'red';
      document.getElementById('login-message').textContent = "Email ou mot de passe incorrect.";
    }
  })
  .catch(() => {
    document.getElementById('login-message').style.color = 'red';
    document.getElementById('login-message').textContent = "Erreur serveur.";
  });
};

// Inscription AJAX
registerForm.onsubmit = function(e) {
  e.preventDefault();
  document.getElementById('register-message').textContent = '';
  const username = this.username.value.trim();
  const email = this.email.value.trim();
  const password = this.password.value;
  if (username.length < 3) {
    document.getElementById('register-message').style.color = 'red';
    document.getElementById('register-message').textContent = "Nom d'utilisateur trop court.";
    return;
  }
  if (!email.includes('@')) {
    document.getElementById('register-message').style.color = 'red';
    document.getElementById('register-message').textContent = "Email invalide.";
    return;
  }
  if (password.length < 6) {
    document.getElementById('register-message').style.color = 'red';
    document.getElementById('register-message').textContent = "Mot de passe trop court.";
    return;
  }
  fetch('api/AuthController.php?action=register', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, email, password })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      document.getElementById('register-message').style.color = 'green';
      document.getElementById('register-message').textContent = "Inscription réussie ! Redirection...";
      setTimeout(() => {
        tabLogin.click();
        document.getElementById('register-message').textContent = '';
      }, 1200);
    } else {
      document.getElementById('register-message').style.color = 'red';
      document.getElementById('register-message').textContent = "Erreur : email déjà utilisé.";
    }
  })
  .catch(() => {
    document.getElementById('register-message').style.color = 'red';
    document.getElementById('register-message').textContent = "Erreur serveur.";
  });
};
