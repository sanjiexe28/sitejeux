<?php
require_once "db.php";
session_start();

if (isset($_SESSION['id'])) {
    header("Location: espace_client.php");
    exit;
}

$message = "";
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom       = trim($_POST['nom'] ?? '');
    $prenom    = trim($_POST['prenom'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $mdp       = $_POST['mot_de_passe'] ?? '';
    $mdp_conf  = $_POST['mot_de_passe_confirm'] ?? '';
    $parrainage = trim($_POST['code_parrainage'] ?? '');

    // Validation
    if (empty($nom))    $erreurs[] = "Le nom est obligatoire.";
    if (empty($prenom)) $erreurs[] = "Le prénom est obligatoire.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs[] = "L'adresse email n'est pas valide.";
    if (strlen($mdp) < 8) $erreurs[] = "Le mot de passe doit faire au moins 8 caractères.";
    if ($mdp !== $mdp_conf) $erreurs[] = "Les mots de passe ne correspondent pas.";

    // Email déjà utilisé
    if (empty($erreurs)) {
        $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $erreurs[] = "Cette adresse email est déjà utilisée.";
        }
    }

    // Vérif code parrainage
    $id_parrain = null;
    if (!empty($parrainage) && empty($erreurs)) {
        $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE code_parrainage = :code");
        $stmt->execute(['code' => $parrainage]);
        $parrain = $stmt->fetch();
        if (!$parrain) {
            $erreurs[] = "Code de parrainage invalide.";
        } else {
            $id_parrain = $parrain['id'];
        }
    }

    if (empty($erreurs)) {

        // Génération code parrainage unique
        $code = strtoupper(substr($prenom, 0, 3) . substr($nom, 0, 3) . rand(100, 999));

        // Hash du mot de passe
        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        // Insertion
        $stmt = $pdo->prepare("
            INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, points_fidelite, code_parrainage, id_parrain, date_inscription)
            VALUES (:nom, :prenom, :email, :mdp, :points, :code, :parrain, CURRENT_DATE)
        ");

        $points_depart = ($id_parrain !== null) ? 200 : 0;

        $stmt->execute([
            'nom'     => $nom,
            'prenom'  => $prenom,
            'email'   => $email,
            'mdp'     => $hash,
            'points'  => $points_depart,
            'code'    => $code,
            'parrain' => $id_parrain,
        ]);

        $nouvel_id = $pdo->lastInsertId();

        // Bonus parrain
        if ($id_parrain !== null) {
            $pdo->prepare("UPDATE utilisateur SET points_fidelite = points_fidelite + 200 WHERE id = :id")
                ->execute(['id' => $id_parrain]);
        }

        // Connexion automatique
        $_SESSION['id']  = $nouvel_id;
        $_SESSION['nom'] = $nom;

        header("Location: espace_client.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription — LudoShop</title>
    <link rel="stylesheet" href="style/main.css">
    <style>
        .auth-box {
            max-width: 480px;
            margin: 0 auto;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 36px 40px;
        }

        .auth-title {
            font-family: var(--font-display);
            font-size: 26px;
            margin-bottom: 6px;
            color: var(--text-dark);
        }

        .auth-subtitle {
            font-size: 13px;
            color: var(--text-light);
            margin-bottom: 28px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-mid);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .form-group input {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 11px 14px;
            color: var(--text-dark);
            font-size: 14px;
            font-family: var(--font-body);
            outline: none;
            transition: border-color var(--transition);
        }

        .form-group input:focus {
            border-color: var(--accent-purple);
        }

        .form-group input::placeholder {
            color: var(--text-light);
        }

        .form-group .hint {
            font-size: 11px;
            color: var(--text-light);
        }

        .erreurs {
            background: rgba(255,68,0,.1);
            border: 1px solid rgba(255,68,0,.3);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .erreurs p {
            font-size: 13px;
            color: var(--accent-red);
            margin-bottom: 4px;
        }

        .erreurs p:last-child { margin-bottom: 0; }

        .separator {
            height: 1px;
            background: var(--border);
            margin: 20px 0;
        }

        .parrainage-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            color: var(--accent-gold);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px;
        }

        .auth-link {
            text-align: center;
            font-size: 13px;
            color: var(--text-light);
            margin-top: 20px;
        }

        .auth-link a {
            color: var(--accent-purple);
            font-weight: 500;
        }

        .auth-link a:hover { text-decoration: underline; }

        .password-strength {
            height: 3px;
            border-radius: 2px;
            background: var(--border);
            margin-top: 6px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: width .3s, background .3s;
        }

        .bonus-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255,165,0,.12);
            border: 1px solid rgba(255,165,0,.25);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 11px;
            color: var(--accent-gold);
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<header>
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">
                <div class="logo-die"><span>🎲</span></div>
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
                <a href="connexion.php"><button class="btn-nav">Connexion</button></a>
            </div>
        </div>
    </nav>
</header>

<!-- SECTION INSCRIPTION -->
<section class="section">
    <div class="container">

        <div class="auth-box">

            <h2 class="auth-title">Créer un compte</h2>
            <p class="auth-subtitle">Rejoignez 12 400 joueurs passionnés. Votre placard ne sera plus jamais vide.</p>

            <?php if (!empty($erreurs)): ?>
                <div class="erreurs">
                    <?php foreach ($erreurs as $e): ?>
                        <p>⚠ <?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="inscription.php">

                <div class="form-row">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" placeholder="Jean" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" placeholder="Dupont" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Adresse email</label>
                    <input type="email" name="email" placeholder="exemple@mail.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="mdp" placeholder="••••••••" required oninput="checkStrength(this.value)">
                    <div class="password-strength"><div class="password-strength-bar" id="strength-bar"></div></div>
                    <span class="hint" id="strength-label">Minimum 8 caractères</span>
                </div>

                <div class="form-group">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="mot_de_passe_confirm" placeholder="••••••••" required>
                </div>

                <div class="separator"></div>

                <div class="form-group">
                    <div class="parrainage-label">
                        ⭐ Code de parrainage
                        <span class="bonus-badge">+200 pts offerts</span>
                    </div>
                    <input type="text" name="code_parrainage" placeholder="Ex : ALICE2024 (facultatif)" value="<?= htmlspecialchars($_POST['code_parrainage'] ?? '') ?>">
                    <span class="hint">Vous et votre parrain recevez chacun 200 points fidélité.</span>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%;margin-top:8px">
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
function checkStrength(val) {
    const bar   = document.getElementById('strength-bar');
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { w: '0%',   bg: 'transparent', txt: 'Minimum 8 caractères' },
        { w: '25%',  bg: '#FF4400',     txt: 'Trop faible' },
        { w: '50%',  bg: '#FFA500',     txt: 'Moyen' },
        { w: '75%',  bg: '#22A05B',     txt: 'Bon' },
        { w: '100%', bg: '#22A05B',     txt: 'Excellent !' },
    ];

    const l = levels[val.length === 0 ? 0 : score];
    bar.style.width      = l.w;
    bar.style.background = l.bg;
    label.textContent    = l.txt;
    label.style.color    = l.bg || 'var(--text-light)';
}
</script>

</body>
</html>