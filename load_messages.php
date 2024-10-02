<?php
session_start();
require 'inc/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$id_destinataire = $_GET['id'] ?? null;

if ($id_destinataire === null) {
    echo "Utilisateur non spécifié.";
    exit();
}

function recupererMessages($pdo, $id_utilisateur1, $id_utilisateur2) {
    $sql = "SELECT * FROM messages 
            WHERE (id_expediteur = :id_utilisateur1 AND id_destinataire = :id_utilisateur2) 
            OR (id_expediteur = :id_utilisateur2 AND id_destinataire = :id_utilisateur1) 
            ORDER BY date_envoi ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_utilisateur1', $id_utilisateur1, PDO::PARAM_INT);
    $stmt->bindParam(':id_utilisateur2', $id_utilisateur2, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Récupérer les messages
$messages = recupererMessages($pdo, $_SESSION['user_id'], $id_destinataire);

foreach ($messages as $msg): ?>
    <div class="<?php echo $msg['id_expediteur'] == $_SESSION['user_id'] ? 'message-expediteur' : 'message-destinataire'; ?>">
        <strong><?php echo htmlspecialchars($msg['id_expediteur'] == $_SESSION['user_id'] ? 'Vous' : $destinataire['nom']); ?>:</strong>
        <p><?php echo htmlspecialchars($msg['message']); ?></p>
        <small><?php echo htmlspecialchars($msg['date_envoi']); ?></small>
    </div>
<?php endforeach; ?>
