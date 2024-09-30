<?php
session_start();
include('../inc/db_connect.php');

// Récupérer les données du formulaire
$contenu_id = $_POST['contenu_id'];
$commentaire = $_POST['commentaire'];

// Insertion dans la base de données
$sql = "INSERT INTO commentaires (contenu_id, utilisateur_id, commentaire) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$contenu_id, $_SESSION['user_id'], $commentaire]);

$_SESSION['success'] = "Commentaire ajouté avec succès !";
header('Location: ../index.php');
exit();
