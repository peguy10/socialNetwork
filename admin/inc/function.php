<?php 
   session_start();
   include('../inc/db_connect.php');
   if (!isset($_SESSION['user_name'])) {
      header('location: ../signin.php');
   }

   // Fonction pour récupérer les statistiques
function recupererStatistiques($pdo) {
    $statistiques = [];

    // Nombre de contenus
    $stmt = $pdo->query("SELECT COUNT(*) AS nombre_contenus FROM contenus");
    $statistiques['nombre_contenus'] = $stmt->fetchColumn();

    // Nombre de créateurs
    $stmt = $pdo->query("SELECT COUNT(DISTINCT id_user) AS nombre_createurs FROM createurs");
    $statistiques['nombre_createurs'] = $stmt->fetchColumn();

    // Nombre de commentaires
    $stmt = $pdo->query("SELECT COUNT(*) AS nombre_commentaires FROM commentaires");
    $statistiques['nombre_commentaires'] = $stmt->fetchColumn();

    return $statistiques;
}

// Récupérer les statistiques
$statistiques = recupererStatistiques($pdo);

function recupererDerniersContenus($pdo) {
    $sql = "
        SELECT c.*, 
               u.nom AS nom_utilisateur,
               (SELECT COUNT(*) FROM commentaires WHERE contenu_id = c.id) AS nombre_commentaires,
               (SELECT COUNT(*) FROM likes WHERE contenu_id = c.id) AS nombre_likes
        FROM contenus c
        JOIN createurs u ON c.utilisateur_id = u.id_user
        ORDER BY c.date_creation DESC 
      
    ";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les derniers contenus
$derniers_contenus = recupererDerniersContenus($pdo);

$iduser = $_SESSION['user_id'];

function recupererMesContenus($pdo, $iduser) {
    $sql = "
        SELECT c.*, 
               (SELECT COUNT(*) FROM commentaires WHERE contenu_id = c.id) AS nombre_commentaires,
               (SELECT COUNT(*) FROM likes WHERE contenu_id = c.id) AS nombre_likes
        FROM contenus c
        WHERE c.utilisateur_id = :iduser
        ORDER BY c.date_creation DESC 
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':iduser', $iduser, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer mes contenus
$contents = recupererMesContenus($pdo, $iduser);


function recupererRapportUtilisateurs($pdo) {
    $sql = "
        SELECT u.id_user,u.photo,u.nom, COUNT(c.id) AS nombre_contenus
        FROM createurs u
        LEFT JOIN contenus c ON u.id_user = c.utilisateur_id
        GROUP BY u.id_user, u.nom
        ORDER BY nombre_contenus DESC
    ";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Récupérer le rapport des utilisateurs
$rapport_utilisateurs = recupererRapportUtilisateurs($pdo);

?>