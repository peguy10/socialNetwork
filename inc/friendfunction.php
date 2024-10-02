<?php

    include('db_connect.php');
    function envoyerDemandeAmitie($pdo, $id_demandeur, $id_destinataire) {
        $sql = "INSERT INTO demandes_amitie (id_demandeur, id_destinataire) VALUES (:id_demandeur, :id_destinataire)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_demandeur', $id_demandeur, PDO::PARAM_INT);
        $stmt->bindParam(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function repondreDemandeAmitie($pdo, $id_demand, $statut) {
        $sql = "UPDATE demandes_amitie SET statut = :statut WHERE id = :id_demand";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':id_demand', $id_demand, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function recupererDemandesAmitie($pdo, $id_utilisateur) {
        $sql = "SELECT d.*, u.nom AS nom_demandeur 
                FROM demandes_amitie d 
                JOIN createurs u ON d.id_demandeur = u.id_user 
                WHERE d.id_destinataire = :id_utilisateur AND d.statut = 'en_attente'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

?>