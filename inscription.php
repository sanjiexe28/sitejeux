<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription — LudoShop</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

<!-- NAVBAR -->
<header>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">
                <div class="logo-die">
                    <span class="shake-die" id="shake-die" title="Lancez le dé !">🎲</span>
                </div>
                LudoShop
            </a>

            <ul class="nav-links">
                <li><a href="catalogue.php">Catalogue</a></li>
                <li><a href="catalogue.php?cat=nouveautes">Nouveautés</a></li>
                <li><a href="catalogue.php?cat=jdr">Jeux de rôle</a></li>
                <li><a href="catalogue.php?cat=figurines">Figurines</a></li>
                <li><a href="forum.php">Forum</a></li>
            </ul>

            <div class="nav-right">
                <input class="search-input" type="text" placeholder='Ex : "jeu où je peux gagner"…'>
                <button class="icon-btn" title="Mes envies">♡</button>
                <a href="panier.php">
                    <button class="icon-btn" title="Mon panier">
                        🛒 <span class="cart-badge">3</span>
                    </button>
                </a>
            </div>
        </div>
    </nav>
</header>

<!-- SECTION INSCRIPTION -->
<section class="section">
    <div class="container">

        <div class="auth-box">

            <h2 class="auth-title">Inscription</h2>

            <form>

                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" placeholder="Pseudo gamer" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="exemple@mail.com" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" placeholder="••••••••" required>
                </div>

                <button class="btn btn-gold" style="width:100%">
                    Créer mon compte
                </button>

            </form>

            <p class="auth-link">
                Déjà un compte ?
                <a href="connexion.php">Se connecter</a>
            </p>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="logo" style="font-size:17px">🎲 LudoShop</div>
        <p class="footer-copy">© 2026 LudoShop — Aucun joueur n'a été blessé lors de la création du site.</p>
        <nav class="footer-links">
            <a href="#">À propos</a>
            <a href="#">CGV</a>
            <a href="#">Contact</a>
            <a href="forum.php">Forum</a>
        </nav>
    </div>
</footer>

</body>
</html>