<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue — LudoShop</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

<!-- HEADER -->
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
                <a href="panier.php"><button class="icon-btn" title="Mon panier (plein comme d'hab)">
                    🛒
                    <span class="cart-badge">3</span></a>
                </button>
            </div>
        </div>
    </nav>
</header>

<!-- SECTION -->
<section class="section">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">
                🎲 Catalogue des jeux
            </h2>
        </div>

        <!-- FILTRES -->
        <div class="filters">

            <input type="text" id="search" placeholder="Rechercher un jeu...">

            <select id="category">
                <option value="all">Toutes catégories</option>
                <option value="jdr">Jeux de rôle</option>
                <option value="plateau">Jeux de plateau</option>
                <option value="figurines">Figurines</option>
            </select>

        </div>

        <!-- PRODUITS -->
        <div class="product-grid" id="products">

            <div class="product-card" data-name="cryptes de vaelthar" data-cat="plateau">
                <div class="product-thumb">🏚️</div>
                <div class="product-body">
                    <div class="product-name">Cryptes de Vaelthar</div>
                    <div class="product-price">42,90 €</div>
                </div>
            </div>

            <div class="product-card" data-name="marchands de sorvane" data-cat="plateau">
                <div class="product-thumb">⚖️</div>
                <div class="product-body">
                    <div class="product-name">Marchands de Sorvane</div>
                    <div class="product-price">34,90 €</div>
                </div>
            </div>

            <div class="product-card" data-name="phaedros" data-cat="jdr">
                <div class="product-thumb">📜</div>
                <div class="product-body">
                    <div class="product-name">Légendes de Phaëdros</div>
                    <div class="product-price">29,90 €</div>
                </div>
            </div>

            <div class="product-card" data-name="kaelthorn" data-cat="figurines">
                <div class="product-thumb">🔨</div>
                <div class="product-body">
                    <div class="product-name">Forges de Kaelthorn</div>
                    <div class="product-price">54,90 €</div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="logo" style="font-size:17px">🎲 LudoShop</div>
        <p class="footer-copy">© 2026 LudoShop — Aucun joueur n'a été blessé lors de la rédaction de ce site.</p>
        <nav class="footer-links">
            <a href="#">À propos</a>
            <a href="#">CGV</a>
            <a href="#">Contact</a>
            <a href="forum.php">Forum</a>
        </nav>
    </div>
</footer>

<script>

<!-- SCRIPT -->
<script>
const searchInput = document.getElementById("search");
const categorySelect = document.getElementById("category");
const products = document.querySelectorAll(".product-card");

function filterProducts() {
    const search = searchInput.value.toLowerCase();
    const category = categorySelect.value;

    products.forEach(product => {
        const name = product.dataset.name;
        const cat = product.dataset.cat;

        const matchSearch = name.includes(search);
        const matchCat = category === "all" || cat === category;

        if (matchSearch && matchCat) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });
}

searchInput.addEventListener("input", filterProducts);
categorySelect.addEventListener("change", filterProducts);
</script>

</body>
</html>