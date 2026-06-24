<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum — LudoSexShop</title>
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
                Forum
            </a>
            <ul class="nav-links">
                <li><a href="forum.php">Forum</a></li>
                <li><a href="catalogue.php">Catalogue</a></li>
                <li><a href="catalogue.php?cat=nouveautes">Nouveautés</a></li>
                <li><a href="catalogue.php?cat=jdr">Jeux de rôle</a></li>
                <li><a href="catalogue.php?cat=figurines">Figurines</a></li>
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

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <p class="hero-eyebrow">✦ Communauté</p>

            <h1 class="hero-title">
                Le forum des<br>
                <em>joueurs passionnés</em>
            </h1>

            <p class="hero-subtitle">
                Conseils, parties, peinture, jeux de rôle et débats
                sur le meilleur jeu de société du monde.
            </p>

            <div class="hero-ctas">
                <button class="btn btn-purple">Créer un sujet</button>
                <button class="btn btn-ghost">Derniers messages</button>
            </div>
        </div>
    </div>
</section>

<!-- SUJETS -->
<section class="section">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">
                <div class="title-icon">💬</div>
                Discussions récentes
            </h2>
        </div>

        <div class="forum-grid">

            <div class="forum-card">
                <div class="forum-card-head" style="background:#E8D8CC">
                    🗣️
                </div>

                <div class="forum-card-body">
                    <span class="forum-tag">Conseils</span>

                    <div class="forum-title">
                        Quel jeu pour une soirée avec des débutants ?
                    </div>

                    <div class="forum-meta">
                        👤 LudoMaster42 · 24 réponses
                    </div>
                </div>
            </div>

            <div class="forum-card">
                <div class="forum-card-head" style="background:#CCE0E8">
                    🎨
                </div>

                <div class="forum-card-body">
                    <span class="forum-tag">Peinture</span>

                    <div class="forum-title">
                        Comment peindre ses figurines sans catastrophe ?
                    </div>

                    <div class="forum-meta">
                        👤 PinceauMagique · 15 réponses
                    </div>
                </div>
            </div>

            <div class="forum-card">
                <div class="forum-card-head" style="background:#D8CCE8">
                    🎲
                </div>

                <div class="forum-card-body">
                    <span class="forum-tag">JDR</span>

                    <div class="forum-title">
                        Votre plus belle campagne de jeu de rôle ?
                    </div>

                    <div class="forum-meta">
                        👤 DungeonKing · 37 réponses
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- CATÉGORIES -->
<section class="section section-alt">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">
                <div class="title-icon">📚</div>
                Catégories
            </h2>
        </div>

        <div class="cat-grid">

            <div class="cat-card">
                <div class="cat-icon">🎲</div>
                <div class="cat-name">Jeux de plateau</div>
                <div class="cat-nb">142 sujets</div>
            </div>

            <div class="cat-card">
                <div class="cat-icon">🐲</div>
                <div class="cat-name">Jeux de rôle</div>
                <div class="cat-nb">89 sujets</div>
            </div>

            <div class="cat-card">
                <div class="cat-icon">🎨</div>
                <div class="cat-name">Peinture</div>
                <div class="cat-nb">57 sujets</div>
            </div>

            <div class="cat-card">
                <div class="cat-icon">🃏</div>
                <div class="cat-name">Jeux de cartes</div>
                <div class="cat-nb">74 sujets</div>
            </div>

            <div class="cat-card">
                <div class="cat-icon">😂</div>
                <div class="cat-name">Hors sujet</div>
                <div class="cat-nb">203 sujets</div>
            </div>

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