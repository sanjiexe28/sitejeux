<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion — LudoSexShop</title>
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
                LudoSexShop
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
                <a href="panier.php"><button class="icon-btn" title="Mon panier (plein comme d'hab)">
                    🛒
                    <span class="cart-badge">3</span></a>
                </button>
            </div>
        </div>
    </nav>
</header>

<!-- SECTION CONNEXION -->
<section class="section">
    <div class="container">

        <div class="auth-box">

            <h2 class="auth-title">Connexion</h2>

            <form>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="exemple@mail.com" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" placeholder="••••••••" required>
                </div>

                <button class="btn btn-gold" style="width:100%">
                    Se connecter
                </button>

            </form>

            <p class="auth-link">
                Pas encore de compte ?
                <a href="inscription.php">S’inscrire</a>
            </p>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="logo" style="font-size:17px">🎲 LudoSexShop</div>
        <p class="footer-copy">© 2026 LudoSexShop — Aucun joueur n'a été blessé lors de la rédaction de ce site.</p>
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