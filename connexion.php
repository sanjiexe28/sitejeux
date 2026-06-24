<?php
require_once "db.php";
session_start();

$message = "";

if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {

    $mail = $_POST['email'];
    $mdp = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM utilisateur WHERE email = :mail";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'mail' => $mail
    ]);

    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($client) {

        if (password_verify($mdp, $client['mot_de_passe'])) {

            $_SESSION['id'] = $client['id'];
            $_SESSION['nom'] = $client['nom'];

            header("Location: espace_client.php");
            exit;

        } else {
            $message = "Mot de passe incorrect";
        }

    } else {
        $message = "Aucun compte trouvé avec cet email";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion — LudoShop</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

<!-- NAVBAR -->
<header>
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">
                <div class="logo-die">
                    <span class="shake-die" id="shake-die" title="Lancez le dé !">🎲</span>
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
                <input class="search-input" type="text" placeholder='Ex : "jeu où je peux gagner"…'>
                <button class="icon-btn" title="Mes envies">♡</button>
                <a href="panier.html"><button class="icon-btn" title="Mon panier (plein comme d'hab)">
                    🛒
                    <span class="cart-badge">3</span>
                </button></a>
            </div>
        </div>
    </nav>
</header>

<!-- SECTION CONNEXION -->
<section class="section">
    <div class="container">

        <div class="auth-box">

            <h2 class="auth-title">Connexion</h2>

            <?php if ($message): ?>
                <p style="color:red; margin-bottom:12px;"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form method="POST" action="connexion.php">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="exemple@mail.com" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%">
                    Se connecter
                </button>

            </form>

            <p class="auth-link">
                Pas encore de compte ?
                <a href="inscription.html">S'inscrire</a>
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

</body>
</html>