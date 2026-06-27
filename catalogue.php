<?php
// catalogue.php — LudoShop

$tous_les_jeux = [
    [
        'id' => 1, 'nom' => 'Cryptes de Vaelthar',
        'cat' => 'plateau', 'cat_label' => 'Dungeon Crawler',
        'prix' => 42.90, 'note' => 4.8, 'nb_avis' => 34,
        'emoji' => '🏚️', 'badge' => 'Nouveau', 'stock' => 3,
        'desc' => 'Explorez des cryptes procédurales. Le boss final triche. Votre thérapeute approuve.',
        'fun' => 'Disputes garanties',
    ],
    [
        'id' => 2, 'nom' => 'Marchands de Sorvane',
        'cat' => 'plateau', 'cat_label' => 'Négo & Trahison',
        'prix' => 34.90, 'note' => 4.5, 'nb_avis' => 21,
        'emoji' => '⚖️', 'badge' => 'Nouveau', 'stock' => 12,
        'desc' => 'Négociez, trahissez, réconciliez-vous à moitié, re-trahissez. Idéal en famille.',
        'fun' => 'Amis perdus : 2 en moy.',
    ],
    [
        'id' => 3, 'nom' => 'Légendes de Phaëdros',
        'cat' => 'jdr', 'cat_label' => 'Jeu de rôle',
        'prix' => 29.90, 'note' => 5.0, 'nb_avis' => 12,
        'emoji' => '📜', 'badge' => 'Nouveau', 'stock' => 7,
        'desc' => 'Un JDR narratif où le MJ pleure à chaque session. Par bonheur ou par chagrin, on sait pas.',
        'fun' => 'Séance psy incluse',
    ],
    [
        'id' => 4, 'nom' => 'Les Forges de Kaelthorn',
        'cat' => 'figurines', 'cat_label' => 'Figurines',
        'prix' => 54.90, 'note' => 4.3, 'nb_avis' => 8,
        'emoji' => '🔨', 'badge' => 'Nouveau', 'stock' => 1,
        'desc' => '12 nains à assembler. Votre genou en retrouvera une sur le sol à 3h du mat. Promis.',
        'fun' => 'Pinceau non fourni',
    ],
    [
        'id' => 5, 'nom' => 'Éclipse de Mirholdt',
        'cat' => 'plateau', 'cat_label' => 'Conquête Galactique',
        'prix' => 49.90, 'note' => 4.9, 'nb_avis' => 287,
        'emoji' => '🌑', 'badge' => 'Top ventes', 'stock' => 9,
        'desc' => 'Contrôlez l\'univers entier. Durée de partie : votre week-end. Durée des règles : votre vie.',
        'fun' => 'Table 2m² requise',
    ],
    [
        'id' => 6, 'nom' => 'Ruines de Drakmoor',
        'cat' => 'plateau', 'cat_label' => 'Coopératif',
        'prix' => 37.90, 'note' => 4.7, 'nb_avis' => 194,
        'emoji' => '🗿', 'badge' => 'Top ventes', 'stock' => 15,
        'desc' => 'Tout le monde joue ensemble… sauf un qui "donne des conseils" depuis son canapé.',
        'fun' => 'Coopération testée',
    ],
    [
        'id' => 7, 'nom' => 'Guildes de Nyvara',
        'cat' => 'plateau', 'cat_label' => 'Gestion & Intrigue',
        'prix' => 44.90, 'note' => 4.6, 'nb_avis' => 156,
        'emoji' => '🏛️', 'badge' => 'Top ventes', 'stock' => 6,
        'desc' => 'Bâtissez la guilde la plus puissante. Ou jouez l\'assassin dans l\'ombre. Les deux fonctionnent.',
        'fun' => 'Pouvoir corrompt',
    ],
    [
        'id' => 8, 'nom' => 'L\'Éveil des Titan-Rois',
        'cat' => 'jdr', 'cat_label' => 'Jeu de rôle',
        'prix' => 32.90, 'note' => 4.8, 'nb_avis' => 203,
        'emoji' => '⚡', 'badge' => 'Top ventes', 'stock' => 22,
        'desc' => 'Des héros légendaires, des titans millénaires, et UN joueur qui regarde son téléphone.',
        'fun' => 'MJ en PLS : 3 fois',
    ],
    [
        'id' => 9, 'nom' => 'Le Syndicat des Dés Truqués',
        'cat' => 'cartes', 'cat_label' => 'Jeu de cartes',
        'prix' => 18.90, 'note' => 4.4, 'nb_avis' => 89,
        'emoji' => '🎰', 'badge' => '', 'stock' => 40,
        'desc' => 'Un jeu de bluff et de trahison. Personne ne sait qui ment. Tout le monde ment. Magnifique.',
        'fun' => 'Poker mais pire',
    ],
    [
        'id' => 10, 'nom' => 'Gobelins & Compagnie',
        'cat' => 'plateau', 'cat_label' => 'Familial',
        'prix' => 27.50, 'note' => 4.2, 'nb_avis' => 311,
        'emoji' => '👺', 'badge' => '', 'stock' => 50,
        'desc' => 'Le jeu familial qu\'on sort pour les enfants et que les adultes finissent par prendre trop au sérieux.',
        'fun' => '7 ans+ (mentalement)',
    ],
    [
        'id' => 11, 'nom' => 'Ombres sur Velrathos',
        'cat' => 'jdr', 'cat_label' => 'Jeu de rôle',
        'prix' => 38.00, 'note' => 4.6, 'nb_avis' => 57,
        'emoji' => '🌫️', 'badge' => '', 'stock' => 11,
        'desc' => 'Un univers sombre où vos personnages souffrent beaucoup. Parfait pour une soirée détendue.',
        'fun' => 'Déprime garantie',
    ],
    [
        'id' => 12, 'nom' => 'Armée de Krom-Zhar — Starter',
        'cat' => 'figurines', 'cat_label' => 'Figurines',
        'prix' => 69.90, 'note' => 4.7, 'nb_avis' => 23,
        'emoji' => '💀', 'badge' => '', 'stock' => 4,
        'desc' => '20 guerriers orcs à peindre. Votre chat va en manger au moins un. Commandez-en deux.',
        'fun' => 'Chat = ennemi n°1',
    ],
];

function etoiles(float $note): string {
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($note >= $i) $html .= '★';
        elseif ($note >= $i - 0.5) $html .= '½';
        else $html .= '☆';
    }
    return $html;
}

$nb_jeux = count($tous_les_jeux);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue — LudoShop</title>
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
                <li><a href="catalogue.php" style="color:var(--orange)">Catalogue</a></li>
                <li><a href="catalogue.php?cat=nouveautes">Nouveautés</a></li>
                <li><a href="catalogue.php?cat=jdr">Jeux de rôle</a></li>
                <li><a href="catalogue.php?cat=figurines">Figurines</a></li>
                <li><a href="forum.php">Forum</a></li>
            </ul>
            <div class="nav-right">
                <input class="search-input" type="text" placeholder='Ex : "jeu où je peux gagner"…'>
                <button class="icon-btn" title="Mes envies">♡</button>
                <a href="panier.php">
                    <button class="icon-btn" title="Mon panier (plein comme d'hab)">
                        🛒 <span class="cart-badge">3</span>
                    </button>
                </a>
                <a href="connexion.php"><button class="btn-nav">Connexion</button></a>
                <a href="inscription.php"><button class="btn-nav">Inscription</button></a>
            </div>
        </div>
    </nav>
</header>

<!-- HERO CATALOGUE -->
<div class="catalogue-hero">
    <div class="container">
        <h1>🎲 Le <em>catalogue</em> des jeux</h1>
        <p>
            <?= $nb_jeux ?> jeux disponibles — dont certains que vous n'avez aucune raison d'acheter, mais vous allez quand même le faire.
        </p>
    </div>
</div>

<!-- SECTION PRINCIPALE -->
<section class="section">
    <div class="container">
        <div class="catalogue-layout">

            <!-- SIDEBAR FILTRES -->
            <aside class="filter-sidebar">
                <h3>🎯 Filtres</h3>

                <div class="filter-group">
                    <label>Recherche</label>
                    <input type="text" id="js-search" placeholder="Un jeu, un mot…">
                </div>

                <div class="filter-group">
                    <label>Catégorie</label>
                    <div class="filter-cats">
                        <button class="filter-cat-btn active" data-cat="all">
                            Tout voir <span class="cat-count-badge"><?= $nb_jeux ?></span>
                        </button>
                        <button class="filter-cat-btn" data-cat="plateau">
                            ♟️ Plateau <span class="cat-count-badge">6</span>
                        </button>
                        <button class="filter-cat-btn" data-cat="jdr">
                            🐲 Jeu de rôle <span class="cat-count-badge">3</span>
                        </button>
                        <button class="filter-cat-btn" data-cat="figurines">
                            ⚔️ Figurines <span class="cat-count-badge">2</span>
                        </button>
                        <button class="filter-cat-btn" data-cat="cartes">
                            🃏 Cartes <span class="cat-count-badge">1</span>
                        </button>
                    </div>
                </div>

                <div class="filter-group">
                    <label>Prix max (€)</label>
                    <div class="price-range">
                        <input type="number" id="js-prix-min" placeholder="0" min="0" value="0">
                        <span class="price-sep">→</span>
                        <input type="number" id="js-prix-max" placeholder="200" min="0" value="200">
                    </div>
                </div>

                <div class="filter-group">
                    <label>Note minimum</label>
                    <select id="js-note">
                        <option value="0">Toutes les notes</option>
                        <option value="4">★★★★ 4 et +</option>
                        <option value="4.5">★★★★½ 4,5 et +</option>
                        <option value="5">★★★★★ 5 seulement</option>
                    </select>
                </div>

                <button class="btn-reset-filters" id="js-reset">↺ Réinitialiser</button>
            </aside>

            <!-- CONTENU CATALOGUE -->
            <div>
                <div class="catalogue-topbar">
                    <p class="catalogue-count">
                        <strong id="js-count"><?= $nb_jeux ?></strong> jeux trouvés
                    </p>
                    <select class="sort-select" id="js-sort">
                        <option value="defaut">Tri par défaut</option>
                        <option value="prix-asc">Prix croissant</option>
                        <option value="prix-desc">Prix décroissant</option>
                        <option value="note">Mieux notés</option>
                        <option value="avis">Plus d'avis</option>
                    </select>
                </div>

                <div class="product-grid" id="js-grid">

                    <?php foreach ($tous_les_jeux as $jeu): ?>
                    <div class="product-card"
                         data-nom="<?= strtolower(htmlspecialchars($jeu['nom'])) ?>"
                         data-cat="<?= htmlspecialchars($jeu['cat']) ?>"
                         data-prix="<?= $jeu['prix'] ?>"
                         data-note="<?= $jeu['note'] ?>"
                         data-avis="<?= $jeu['nb_avis'] ?>">
                        <div class="product-thumb"
                             data-fun="<?= htmlspecialchars($jeu['fun']) ?>">
                            <span><?= $jeu['emoji'] ?></span>
                            <?php if ($jeu['badge']): ?>
                                <span class="<?= $jeu['badge'] === 'Nouveau' ? 'badge-new' : 'badge-hot' ?>">
                                    <?= htmlspecialchars($jeu['badge']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <div class="product-cat"><?= htmlspecialchars($jeu['cat_label']) ?></div>
                            <div class="product-name"><?= htmlspecialchars($jeu['nom']) ?></div>
                            <div class="product-desc"><?= htmlspecialchars($jeu['desc']) ?></div>
                            <?php if ($jeu['stock'] <= 3): ?>
                            <p class="stock-warning">🔥 Plus que <?= $jeu['stock'] ?> en stock !</p>
                            <?php endif; ?>
                            <div class="product-stars">
                                <span class="stars"><?= etoiles($jeu['note']) ?></span>
                                <span class="avis-nb">(<?= $jeu['nb_avis'] ?> avis)</span>
                            </div>
                            <div class="product-footer">
                                <span class="product-price"><?= number_format($jeu['prix'], 2, ',', ' ') ?> €</span>
                                <button class="btn-sm btn-panier">+ Panier</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- Message aucun résultat (caché par défaut) -->
                    <div class="no-results" id="js-no-results" style="display:none">
                        <div class="no-results-emoji">🤷</div>
                        <p>Aucun jeu ne correspond à vos critères.</p>
                        <small>Soit vous cherchez quelque chose qui n'existe pas, soit c'est de votre faute. Probablement les deux.</small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="logo" style="font-size:17px">🎲 LudoShop</div>
        <p class="footer-copy">© <?= date('Y') ?> LudoShop — Aucun joueur n'a été blessé lors de la rédaction de ce site.</p>
        <nav class="footer-links">
            <a href="#">À propos</a>
            <a href="#">CGV</a>
            <a href="#">Contact</a>
            <a href="forum.php">Forum</a>
        </nav>
    </div>
</footer>

<!-- EASTER EGG dé -->
<div class="egg-overlay" id="egg-overlay">
    <div class="egg-box">
        <button class="egg-close" onclick="closeEgg()">✕</button>
        <div class="egg-emoji" id="egg-emoji">🎲</div>
        <h3 id="egg-title">Vous avez lancé le dé !</h3>
        <p id="egg-text">…</p>
        <button class="btn btn-orange" onclick="closeEgg()">Compris, j'achète quand même</button>
    </div>
</div>

<script>
// ===== DONNÉES pour le JS (miroir du PHP) =====
const jeux = <?= json_encode(array_map(fn($j) => [
    'nom'   => strtolower($j['nom']),
    'cat'   => $j['cat'],
    'prix'  => $j['prix'],
    'note'  => $j['note'],
    'avis'  => $j['nb_avis'],
], $tous_les_jeux)) ?>;

// ===== FILTRAGE & TRI =====
const grid      = document.getElementById('js-grid');
const cards     = [...document.querySelectorAll('.product-card')];
const noResults = document.getElementById('js-no-results');
const countEl   = document.getElementById('js-count');

function getFilters() {
    return {
        search:  document.getElementById('js-search').value.toLowerCase().trim(),
        cat:     document.querySelector('.filter-cat-btn.active')?.dataset.cat || 'all',
        prixMin: parseFloat(document.getElementById('js-prix-min').value) || 0,
        prixMax: parseFloat(document.getElementById('js-prix-max').value) || 9999,
        note:    parseFloat(document.getElementById('js-note').value) || 0,
        sort:    document.getElementById('js-sort').value,
    };
}

function applyFilters() {
    const f = getFilters();
    let visible = [];

    cards.forEach((card, i) => {
        const d = jeux[i];
        const ok =
            (f.cat === 'all' || d.cat === f.cat) &&
            (!f.search || d.nom.includes(f.search)) &&
            d.prix >= f.prixMin && d.prix <= f.prixMax &&
            d.note >= f.note;

        card.style.display = ok ? '' : 'none';
        if (ok) visible.push({ card, d });
    });

    // Tri
    visible.sort((a, b) => {
        if (f.sort === 'prix-asc')  return a.d.prix - b.d.prix;
        if (f.sort === 'prix-desc') return b.d.prix - a.d.prix;
        if (f.sort === 'note')      return b.d.note - a.d.note;
        if (f.sort === 'avis')      return b.d.avis - a.d.avis;
        return 0;
    });
    // Réordonne le DOM
    visible.forEach(({ card }) => grid.appendChild(card));

    countEl.textContent = visible.length;
    noResults.style.display = visible.length === 0 ? 'block' : 'none';
}

// Listeners filtres
document.getElementById('js-search').addEventListener('input', applyFilters);
document.getElementById('js-prix-min').addEventListener('input', applyFilters);
document.getElementById('js-prix-max').addEventListener('input', applyFilters);
document.getElementById('js-note').addEventListener('change', applyFilters);
document.getElementById('js-sort').addEventListener('change', applyFilters);

document.querySelectorAll('.filter-cat-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-cat-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        applyFilters();
    });
});

document.getElementById('js-reset').addEventListener('click', () => {
    document.getElementById('js-search').value    = '';
    document.getElementById('js-prix-min').value  = '0';
    document.getElementById('js-prix-max').value  = '200';
    document.getElementById('js-note').value      = '0';
    document.getElementById('js-sort').value      = 'defaut';
    document.querySelectorAll('.filter-cat-btn').forEach(b => b.classList.remove('active'));
    document.querySelector('[data-cat="all"]').classList.add('active');
    applyFilters();
});

// ===== BOUTONS PANIER =====
document.querySelectorAll('.btn-panier').forEach(btn => {
    btn.addEventListener('click', function () {
        const original = this.textContent;
        this.textContent = '✓ Ajouté !';
        this.style.background = '#22A05B';
        this.style.color = '#fff';
        setTimeout(() => {
            this.textContent = original;
            this.style.background = '';
            this.style.color = '';
        }, 1500);
    });
});

// ===== EASTER EGG — dé =====
const resultats = [
    { emoji: '⚀', titre: 'Résultat : 1', texte: 'Dernier. Directement. Sans passer par la case départ.' },
    { emoji: '⚁', titre: 'Résultat : 2', texte: 'Votre co-joueur vient de faire 12. Courage.' },
    { emoji: '⚂', titre: 'Résultat : 3', texte: 'Moyen. Comme le café de bureau. Recommencez.' },
    { emoji: '⚃', titre: 'Résultat : 4', texte: 'Solide ! Hélas votre adversaire a fait 5.' },
    { emoji: '⚄', titre: 'Résultat : 5', texte: 'Excellent ! Mais votre voisin vient de faire un 6. Cruel.' },
    { emoji: '⚅', titre: 'CRITIQUE — 6 !', texte: '🎉 Maximum ! Profitez des 4 prochaines minutes avant que quelqu\'un fasse pareil.' },
];
const overlay = document.getElementById('egg-overlay');
document.getElementById('shake-die').addEventListener('click', () => {
    document.getElementById('shake-die').classList.add('shaking');
    setTimeout(() => document.getElementById('shake-die').classList.remove('shaking'), 500);
    const r = resultats[Math.floor(Math.random() * resultats.length)];
    document.getElementById('egg-emoji').textContent = r.emoji;
    document.getElementById('egg-title').textContent = r.titre;
    document.getElementById('egg-text').textContent  = r.texte;
    overlay.classList.add('open');
});
function closeEgg() { overlay.classList.remove('open'); }
overlay.addEventListener('click', e => { if (e.target === overlay) closeEgg(); });
</script>

</body>
</html>