<?php

include('../inc/db_connect.php');

function repondreDemandeAmitie($pdo, $id_demand, $statut) {
    $sql = "UPDATE demandes_amitie SET statut = :statut WHERE id = :id_demand";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
    $stmt->bindParam(':id_demand', $id_demand, PDO::PARAM_INT);
    return $stmt->execute();
}
    $id_demand = $_GET['id'];
    repondreDemandeAmitie($pdo, $id_demand, 'accepte');
    header('Location: ../index.php');
    // Ajoutez ici la logique pour ajouter les utilisateurs comme amis
?>