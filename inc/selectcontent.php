<?php 
    // Démarrer la session
    session_start();

    include('../inc/db_connect.php');

// Récupérer le contenu
$sql = "SELECT c.id, c.type, c.description, c.image, c.video, c.date_creation, u.nom AS utilisateur_nom
        FROM contenus c
        JOIN createurs u ON c.utilisateur_id = u.id
        ORDER BY c.date_creation DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$contenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenue sur notre plateforme de contenu</h1>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($contenus as $contenu): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($contenu['description']) ?: 'Sans titre'; ?></h5>
                            <p class="card-text"><strong>Type:</strong> <?php echo htmlspecialchars($contenu['type']); ?></p>
                            <p class="card-text"><strong>Publié par:</strong> <?php echo htmlspecialchars($contenu['utilisateur_nom']); ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo date('d-m-Y H:i', strtotime($contenu['date_creation'])); ?></small></p>

                            <?php if ($contenu['type'] === 'image' && $contenu['image']): ?>
                                <img src="<?php echo htmlspecialchars($contenu['image']); ?>" class="img-fluid" alt="Image" />
                            <?php elseif ($contenu['type'] === 'video' && $contenu['video']): ?>
                                <iframe width="100%" height="200" src="<?php echo htmlspecialchars($contenu['video']); ?>" frameborder="0" allowfullscreen></iframe>
                            <?php else: ?>
                                <p><?php echo nl2br(htmlspecialchars($contenu['description'])); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

?>