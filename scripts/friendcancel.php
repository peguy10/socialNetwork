<?php 

    include('../inc/friendfunction.php');
    $id_demand = $_GET['id'];
    repondreDemandeAmitie($pdo, $id_demand, 'refuse');
    header('location : ../index.php');
    
?>