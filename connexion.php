<?php
session_start();

// --- Si déjà connecté, on redirige ---
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// --- Config BDD ---
$host   = 'localhost';
$db     = 'ludoshop';
$user   = 'root';
$pass   = '';
$erreur = '';
$succes = '';

// --- Traitement du formulaire ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $mdp   = $_POST['mdp'] ?? '';

    // Validation basique
    if (empty($email) || empty($mdp)) {
        $erreur = "Remplissez les deux champs. On ne lit pas dans les pensées (encore).";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Cet email n'a pas l'air valide. Vous avez peut-être mangé le @.";
    } else {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$utilisateur) {
                $erreur = "Aucun compte avec cet email. Vous êtes sûr d'être déjà inscrit ? 🤔";
            } elseif (!password_verify($mdp, $utilisateur['mot_de_passe'])) {
                $erreur = "Mauvais mot de passe. Non, 'azerty123' ne marche pas ici non plus.";
            } else {
                // ✅ Connexion réussie
                $_SESSION['user_id']  = $utilisateur['id'];
                $_SESSION['username'] = $utilisateur['pseudo'];
                $_SESSION['email']    = $utilisateur['email'];
                header('Location: index.php');
                exit;
            }

        } catch (PDOException $e) {
            $erreur = "Problème avec la base de données. Nos hamsters sont en train de redémarrer.";
            // En dev, décommenter la ligne suivante :
            // $erreur .= " (" . $e->getMessage() . ")";
        }
    }
}

// Messages d'erreur aléatoires sur le placeholder du mdp
$placeholders_mdp = [
    "••••••••",
    "Pas 'azerty123' pitié",
    "Votre secret le mieux gardé",
    "Même pas votre date de naissance ?",
];
$placeholder_mdp = $placeholders_mdp[array_rand($placeholders_mdp)];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — LudoShop</title>
    <link rel="stylesheet" href="style/main.css">
    <style>
        /* Styles spécifiques page connexion */
        .auth-wrapper {
            min-height: calc(100vh - 58px - 97px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            background: var(--bg-main);
        }

        .auth-box {
            width: 100%;
            max-width: 440px;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .auth-logo-die {
            width: 56px; height: 56px;
            background: var(--orange);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            margin: 0 auto 12px;
            animation: float-die 3s ease-in-out infinite;
        }
        @keyframes float-die {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }
        .auth-logo-name {
            font-family: var(--font-display);
            font-size: 20px;
            color: var(--orange);
        }

        .alert {
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }
        .alert-error {
            background: rgba(255, 68, 0, .12);
            border: 1px solid rgba(255, 68, 0, .3);
            color: #FF8060;
        }
        .alert-success {
            background: rgba(34, 160, 91, .12);
            border: 1px solid rgba(34, 160, 91, .3);
            color: #4ADE80;
        }
        .alert-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }

        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 500;
            color: var(--txt-mid);
        }
        .form-group input {
            width: 100%;
            background: #111;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            color: var(--txt);
            font-size: 14px;
            font-family: var(--font-body);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-group input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(255,102,0,.12);
        }
        .form-group input.input-error {
            border-color: var(--red);
        }

        .password-wrapper { position: relative; }
        .toggle-pwd {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: var(--txt-muted); font-size: 16px;
            cursor: pointer; padding: 4px;
            transition: color var(--transition);
        }
        .toggle-pwd:hover { color: var(--orange); }

        .forgot-link {
            display: block;
            text-align: right;
            font-size: 12px;
            color: var(--txt-muted);
            margin-top: 6px;
            transition: color var(--transition);
        }
        .forgot-link:hover { color: var(--orange); }

        .btn-connect {
            width: 100%;
            background: var(--orange);
            color: #000;
            font-weight: 700;
            border: none;
            border-radius: var(--radius-sm);
            padding: 13px;
            font-size: 15px;
            font-family: var(--font-body);
            cursor: pointer;
            margin-top: 8px;
            transition: background var(--transition), transform .1s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-connect:hover   { background: var(--orange-lt); }
        .btn-connect:active  { transform: scale(.98); }

        .auth-divider {
            text-align: center;
            color: var(--txt-muted);
            font-size: 12px;
            margin: 22px 0;
            position: relative;
        }
        .auth-divider::before, .auth-divider::after {
            content: '';
            position: absolute; top: 50%;
            width: 38%; height: 1px;
            background: var(--border);
        }
        .auth-divider::before { left: 0; }
        .auth-divider::after  { right: 0; }

        .auth-link {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: var(--txt-muted);
        }
        .auth-link a { color: var(--orange); font-weight: 500; }
        .auth-link a:hover { opacity: .8; }

        .fun-tip {
            margin-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #333;
            font-style: italic;
        }
    </style>
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
                        🛒 <span class="cart-badge">0</span>
                    </button>
                </a>
            </div>
        </div>
    </nav>
</header>

<!-- ZONE CONNEXION -->
<div class="auth-wrapper">
    <div class="auth-box">

        <!-- Logo flottant -->
        <div class="auth-logo">
            <div class="auth-logo-die">🎲</div>
            <div class="auth-logo-name">LudoShop</div>
        </div>

        <div class="auth-title">Content de vous revoir !</div>
        <p style="text-align:center;color:var(--txt-muted);font-size:13px;margin-bottom:24px">
            Connectez-vous pour accéder à vos commandes, vos points et vos discussions.<br>
            <em style="font-size:12px">(et pour acheter encore plus de jeux, soyons honnêtes)</em>
        </p>

        <!-- Message d'erreur -->
        <?php if ($erreur): ?>
        <div class="alert alert-error">
            <span class="alert-icon">⚠️</span>
            <span><?= htmlspecialchars($erreur) ?></span>
        </div>
        <?php endif; ?>

        <!-- Message de succès (ex: après inscription) -->
        <?php if (isset($_GET['inscrit'])): ?>
        <div class="alert alert-success">
            <span class="alert-icon">🎉</span>
            <span>Compte créé avec succès ! Plus qu'à vous connecter. On vous attendait.</span>
        </div>
        <?php endif; ?>

        <!-- FORMULAIRE -->
        <form method="POST" action="connexion.php" id="form-connexion" novalidate>

            <div class="form-group">
                <label for="email">📧 Adresse email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="votre@email.com"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="mdp">🔐 Mot de passe</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="mdp"
                        name="mdp"
                        placeholder="<?= htmlspecialchars($placeholder_mdp) ?>"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="toggle-pwd" id="toggle-pwd" title="Afficher/Masquer">
                        👁️
                    </button>
                </div>
                <a href="#" class="forgot-link">Mot de passe oublié ? (ça arrive à tout le monde)</a>
            </div>

            <button type="submit" class="btn-connect" id="btn-submit">
                <span id="btn-text">🚪 Se connecter</span>
            </button>

        </form>

        <div class="auth-divider">ou</div>

        <p class="auth-link">
            Pas encore de compte ?
            <a href="inscription.php">Créer un compte gratuitement →</a>
        </p>

        <p class="fun-tip">
            💡 Astuce : votre mot de passe n'est pas "password". Enfin on espère.
        </p>

    </div>
</div>

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

<script>
// --- Afficher/masquer le mot de passe ---
const toggleBtn = document.getElementById('toggle-pwd');
const mdpInput  = document.getElementById('mdp');
toggleBtn.addEventListener('click', () => {
    const isHidden = mdpInput.type === 'password';
    mdpInput.type  = isHidden ? 'text' : 'password';
    toggleBtn.textContent = isHidden ? '🙈' : '👁️';
});

// --- Validation côté client avant envoi ---
document.getElementById('form-connexion').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const mdp   = document.getElementById('mdp').value;
    const btn   = document.getElementById('btn-text');

    if (!email || !mdp) {
        e.preventDefault();
        alert('Remplissez les deux champs. On ne lit pas dans les pensées (encore).');
        return;
    }

    // Feedback visuel pendant la soumission
    btn.textContent = '⏳ Connexion en cours…';
    document.getElementById('btn-submit').disabled = true;
});

// --- Easter egg dé ---
const resultats = [
    { emoji: '⚀', titre: 'Résultat : 1', texte: 'Dernier. Directement. Sans passer par la case départ.' },
    { emoji: '⚅', titre: 'CRITIQUE — 6 !', texte: '🎉 Maximum ! Mais ça ne vous connecte pas pour autant.' },
    { emoji: '⚃', titre: 'Résultat : 4', texte: 'Solide. Votre adversaire a fait 5. Comme toujours.' },
];
document.getElementById('shake-die').addEventListener('click', () => {
    const r = resultats[Math.floor(Math.random() * resultats.length)];
    alert(r.emoji + ' ' + r.titre + '\n' + r.texte);
});
</script>

</body>
</html>