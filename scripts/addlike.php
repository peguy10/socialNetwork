<?php
session_start();
include('../inc/db_connect.php');
// Récupérer les données
$contenu_id = $_POST['contenu_id'];
$utilisateur_id = $_SESSION['user_id'];

// Vérifier si l'utilisateur a déjà aimé ce contenu
$stmt = $pdo->prepare("SELECT * FROM likes WHERE contenu_id = ? AND utilisateur_id = ?");
$stmt->execute([$contenu_id, $utilisateur_id]);
$like = $stmt->fetch();

if ($like) {
    // Si le like existe, le supprimer
    $stmt = $pdo->prepare("DELETE FROM likes WHERE contenu_id = ? AND utilisateur_id = ?");
    $stmt->execute([$contenu_id, $utilisateur_id]);
} else {
    // Sinon, ajouter un nouveau like
    $stmt = $pdo->prepare("INSERT INTO likes (contenu_id, utilisateur_id) VALUES (?, ?)");
    $stmt->execute([$contenu_id, $utilisateur_id]);
}

header('Location: ../index.php');
exit();
