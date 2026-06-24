<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit;
}

$id = $_SESSION['id'];

// Infos utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

// Commandes
$stmt = $pdo->prepare("
    SELECT c.*, 
           COUNT(lc.id) as nb_articles
    FROM commande c
    LEFT JOIN ligne_commande lc ON lc.id_commande = c.id
    WHERE c.id_utilisateur = :id
    GROUP BY c.id
    ORDER BY c.date_commande DESC
");
$stmt->execute(['id' => $id]);
$commandes = $stmt->fetchAll();

// Bons de réduction disponibles
$stmt = $pdo->prepare("SELECT * FROM bon_reduction WHERE id_utilisateur = :id AND utilise = 0");
$stmt->execute(['id' => $id]);
$bons = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon espace — LudoShop</title>
    <link rel="stylesheet" href="style/main.css">
    <style>
        .client-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 28px;
            padding: 40px 0;
        }

        /* SIDEBAR */
        .client-sidebar {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .client-avatar {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            text-align: center;
        }

        .avatar-circle {
            width: 64px;
            height: 64px;
            background: var(--accent-purple);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            margin: 0 auto 14px;
            font-family: var(--font-display);
        }

        .avatar-name {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .avatar-email {
            font-size: 12px;
            color: var(--text-light);
        }

        .sidebar-nav {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            font-size: 13px;
            color: var(--text-mid);
            border-bottom: 1px solid var(--border);
            transition: background var(--transition), color var(--transition);
        }

        .sidebar-nav a:last-child { border-bottom: none; }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255,102,0,.08);
            color: var(--accent-purple);
        }

        .sidebar-nav a span { font-size: 16px; }

        /* POINTS */
        .points-card {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            text-align: center;
        }

        .points-label {
            font-size: 11px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .points-value {
            font-family: var(--font-display);
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 4px;
        }

        .points-sub {
            font-size: 11px;
            color: var(--text-light);
            margin-bottom: 14px;
        }

        /* MAIN */
        .client-main {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .client-section {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
        }

        .client-section-title {
            font-family: var(--font-display);
            font-size: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* COMMANDES */
        .commande-item {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            transition: border-color var(--transition);
        }

        .commande-item:last-child { margin-bottom: 0; }
        .commande-item:hover { border-color: var(--accent-purple); }

        .commande-id {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .commande-date {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 3px;
        }

        .commande-articles {
            font-size: 12px;
            color: var(--text-light);
        }

        .commande-total {
            font-family: var(--font-display);
            font-size: 16px;
            color: var(--accent-purple);
            white-space: nowrap;
        }

        .statut {
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .statut-en-cours   { background: rgba(255,165,0,.15); color: #FFA500; }
        .statut-expediee   { background: rgba(99,102,241,.15); color: #818CF8; }
        .statut-livree     { background: rgba(34,160,91,.15);  color: var(--accent-green); }
        .statut-annulee    { background: rgba(255,68,0,.15);   color: var(--accent-red); }

        .empty-state {
            text-align: center;
            padding: 32px;
            color: var(--text-light);
            font-size: 14px;
        }

        .empty-state .empty-icon { font-size: 40px; margin-bottom: 12px; }

        /* BONS */
        .bons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 14px;
        }

        .bon-card {
            border: 1px dashed var(--accent-gold);
            border-radius: var(--radius-sm);
            padding: 18px;
            text-align: center;
            background: rgba(255,102,0,.04);
        }

        .bon-valeur {
            font-family: var(--font-display);
            font-size: 28px;
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 4px;
        }

        .bon-label {
            font-size: 11px;
            color: var(--text-light);
        }

        /* PARRAINAGE */
        .parrainage-box {
            background: var(--bg-dark);
            border-radius: var(--radius-sm);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .parrainage-info { flex: 1; }

        .parrainage-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .parrainage-desc {
            font-size: 12px;
            color: var(--text-light);
        }

        .code-box {
            background: var(--bg-card);
            border: 1px solid var(--accent-purple);
            border-radius: var(--radius-sm);
            padding: 10px 20px;
            font-family: monospace;
            font-size: 18px;
            color: var(--accent-purple);
            letter-spacing: 2px;
            cursor: pointer;
            transition: background var(--transition);
            white-space: nowrap;
        }

        .code-box:hover { background: rgba(255,102,0,.1); }

        @media (max-width: 900px) {
            .client-layout { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<header>
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">
                <div class="logo-die">
                    <span>🎲</span>
                </div>
                LudoShop
            </a>
            <ul class="nav-links">
                <li><a href="catalogue.html">Catalogue</a></li>
                <li><a href="catalogue.html?cat=nouveautes">Nouveautés</a></li>
                <li><a href="catalogue.html?cat=jdr">Jeux de rôle</a></li>
                <li><a href="catalogue.html?cat=figurines">Figurines</a></li>
                <li><a href="forum.html">Forum</a></li>
            </ul>
            <div class="nav-right">
                <a href="panier.html"><button class="icon-btn">🛒 <span class="cart-badge">0</span></button></a>
                <a href="deconnexion.php"><button class="btn-nav">Déconnexion</button></a>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="client-layout">

        <!-- SIDEBAR -->
        <aside class="client-sidebar">

            <div class="client-avatar">
                <div class="avatar-circle">
                    <?= strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)) ?>
                </div>
                <div class="avatar-name"><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></div>
                <div class="avatar-email"><?= htmlspecialchars($user['email']) ?></div>
            </div>

            <nav class="sidebar-nav">
                <a href="#commandes" class="active"><span>📦</span> Mes commandes</a>
                <a href="#bons"><span>🎟️</span> Bons de réduction</a>
                <a href="#parrainage"><span>👥</span> Parrainage</a>
                <a href="forum.html"><span>💬</span> Forum</a>
                <a href="deconnexion.php"><span>🚪</span> Déconnexion</a>
            </nav>

            <div class="points-card">
                <div class="points-label">Points fidélité</div>
                <div class="points-value"><?= number_format($user['points_fidelite']) ?></div>
                <div class="points-sub">1 € = 10 points</div>
                <?php if ($user['points_fidelite'] >= 200): ?>
                    <a href="convertir_points.php"><button class="btn btn-gold" style="width:100%;font-size:12px">Convertir en bon</button></a>
                <?php else: ?>
                    <p style="font-size:11px;color:var(--text-light)">Il vous faut <?= 200 - $user['points_fidelite'] ?> pts pour obtenir un bon</p>
                <?php endif; ?>
            </div>

        </aside>

        <!-- MAIN -->
        <main class="client-main">

            <!-- COMMANDES -->
            <section class="client-section" id="commandes">
                <h2 class="client-section-title">📦 Mes commandes</h2>

                <?php if (empty($commandes)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">🛒</div>
                        Vous n'avez pas encore passé de commande.<br>
                        <a href="catalogue.html" style="color:var(--accent-purple);margin-top:10px;display:inline-block">Explorer le catalogue →</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($commandes as $c): ?>
                        <?php
                            $statutClass = match($c['statut']) {
                                'en cours'  => 'statut-en-cours',
                                'expédiée'  => 'statut-expediee',
                                'livrée'    => 'statut-livree',
                                'annulée'   => 'statut-annulee',
                                default     => ''
                            };
                        ?>
                        <div class="commande-item">
                            <div>
                                <div class="commande-id">Commande #<?= $c['id'] ?></div>
                                <div class="commande-date"><?= date('d/m/Y', strtotime($c['date_commande'])) ?></div>
                            </div>
                            <div class="commande-articles"><?= $c['nb_articles'] ?> article(s)</div>
                            <span class="statut <?= $statutClass ?>"><?= ucfirst($c['statut']) ?></span>
                            <div class="commande-total"><?= number_format($c['total'], 2, ',', ' ') ?> €</div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>

            <!-- BONS DE RÉDUCTION -->
            <section class="client-section" id="bons">
                <h2 class="client-section-title">🎟️ Bons de réduction</h2>

                <?php if (empty($bons)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">🎟️</div>
                        Aucun bon disponible pour l'instant.<br>
                        Accumulez des points fidélité pour en obtenir !
                    </div>
                <?php else: ?>
                    <div class="bons-grid">
                        <?php foreach ($bons as $bon): ?>
                            <div class="bon-card">
                                <div class="bon-valeur">-<?= number_format($bon['valeur'], 0) ?> €</div>
                                <div class="bon-label">Utilisable à la prochaine commande</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

            <!-- PARRAINAGE -->
            <section class="client-section" id="parrainage">
                <h2 class="client-section-title">👥 Parrainage</h2>
                <div class="parrainage-box">
                    <div class="parrainage-info">
                        <div class="parrainage-title">Votre code de parrainage</div>
                        <div class="parrainage-desc">
                            Partagez ce code à l'inscription. Vous gagnez tous les deux 200 points fidélité !
                        </div>
                    </div>
                    <div class="code-box" onclick="copyCode(this)" title="Cliquer pour copier">
                        <?= htmlspecialchars($user['code_parrainage']) ?>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="logo" style="font-size:17px">🎲 LudoShop</div>
        <p class="footer-copy">© 2026 LudoShop — Aucun joueur n'a été blessé lors de la rédaction de ce site.</p>
        <nav class="footer-links">
            <a href="#">À propos</a>
            <a href="#">CGV</a>
            <a href="#">Contact</a>
            <a href="forum.html">Forum</a>
        </nav>
    </div>
</footer>

<script>
function copyCode(el) {
    navigator.clipboard.writeText(el.textContent.trim());
    const original = el.textContent;
    el.textContent = '✓ Copié !';
    setTimeout(() => el.textContent = original, 1500);
}
</script>

</body>
</html>