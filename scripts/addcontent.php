<?php
    session_start();

    // Connexion à la base de données

    include('../inc/db_connect.php');
    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $type_contenu = $_POST['type_contenu'];
        $description = $_POST['description'];
        $image = null;
        $video = null;
        $tags = isset($_POST['tags']) ? $_POST['tags'] : '';

        // Gestion de l'image
        if ($type_contenu === 'image' && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = '../uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }

        // Gestion de la vidéo
        if ($type_contenu === 'video') {
            $video = $_POST['video'];
        }

        // Insertion dans la base de données
        $sql = "INSERT INTO contenus (type, description, image, video, utilisateur_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type_contenu, $description, $image, $video, $_SESSION['user_id']]);
        $contenu_id = $pdo->lastInsertId();

        // Gestion des tags
        if (!empty($tags)) {
            $tags_array = explode(',', $tags);
            foreach ($tags_array as $tag) {
                $tag = trim($tag);
                // Vérifier si le tag existe déjà
                $stmt = $pdo->prepare("SELECT id FROM tags WHERE nom = ?");
                $stmt->execute([$tag]);
                $tag_id = $stmt->fetchColumn();

                // Si le tag n'existe pas, l'insérer
                if (!$tag_id) {
                    $stmt = $pdo->prepare("INSERT INTO tags (nom) VALUES (?)");
                    $stmt->execute([$tag]);
                    $tag_id = $pdo->lastInsertId();
                }

                // Lier le tag au contenu
                $stmt = $pdo->prepare("INSERT INTO contenu_tags (contenu_id, tag_id) VALUES (?, ?)");
                $stmt->execute([$contenu_id, $tag_id]);
            }
        }

        $_SESSION['success'] = "Contenu publié avec succès !";
        header('Location: ../index.php');
        exit();

    }
?>
