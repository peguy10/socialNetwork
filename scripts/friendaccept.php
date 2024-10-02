<?php

    include('../inc/friendfunction.php');
    $id_demand = $_GET['id'];
    repondreDemandeAmitie($pdo, $id_demand, 'accepte');
    // Ajoutez ici la logique pour ajouter les utilisateurs comme amis
?>