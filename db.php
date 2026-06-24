<?php
try {
    $pdo = new PDO(
        'mysql:host=sql13.artsemm.dev;port=6033;dbname=ludoshop;charset=utf8mb4',
        'btssiocred',
        'plRUUM2w@Znb27bLBK',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "Connexion OK !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>