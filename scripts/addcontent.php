<?php
session_start();

// Connexion à la base de données

include('../inc/db_connect.php');
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_contenu = trim($_POST['type_contenu']);
    $user_id = $_SESSION['user_id']; // Assurez-vous que l'ID utilisateur est stocké dans la session lors de la connexion

    // Vérification des champs requis
    if (empty($type_contenu)) {
        $_SESSION['error'] = "Le type de contenu est requis.";
        header("Location: ../creer_contenu.php");
        exit;
    }

    // Préparation de la requête SQL pour insérer le contenu
    $sql = "INSERT INTO contenus (type, utilisateur_id) VALUES (:type, :utilisateur_id)";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(':type', $type_contenu);
        $stmt->bindParam(':utilisateur_id', $user_id);

        // Exécuter la requête
        if ($stmt->execute()) {
            $contenu_id = $pdo->lastInsertId(); // Récupérer l'ID du contenu créé

            // Traitement selon le type de contenu
            if ($type_contenu === 'texte') {
                $description = trim($_POST['description']);
                $stmt = $pdo->prepare("UPDATE contenus SET description = :description WHERE id = :id");
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':id', $contenu_id);
                $stmt->execute();
            } elseif ($type_contenu === 'image') {
                // Gestion du fichier image
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_name = basename($_FILES['image']['name']);
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (in_array($file_ext, $allowed_extensions)) {
                        $upload_dir = '../uploads/';
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0755, true);
                        }
                        $file_path = $upload_dir . uniqid() . '.' . $file_ext;

                        if (move_uploaded_file($file_tmp, $file_path)) {
                            $stmt = $pdo->prepare("UPDATE contenus SET image = :image WHERE id = :id");
                            $stmt->bindParam(':image', $file_path);
                            $stmt->bindParam(':id', $contenu_id);
                            $stmt->execute();
                        } else {
                            $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
                            header("Location: ../creer_contenu.php");
                            exit;
                        }
                    } else {
                        $_SESSION['error'] = "Type de fichier non autorisé.";
                        header("Location: ../creer_contenu.php");
                        exit;
                    }
                }
            } elseif ($type_contenu === 'video') {
                $video_url = trim($_POST['video']);
                $stmt = $pdo->prepare("UPDATE contenus SET video = :video WHERE id = :id");
                $stmt->bindParam(':video', $video_url);
                $stmt->bindParam(':id', $contenu_id);
                $stmt->execute();
            }

            // Gestion des tags
            if (!empty($_POST['tags'])) {
                $tags = explode(',', $_POST['tags']);
                foreach ($tags as $tag) {
                    $tag = trim($tag);
                    if (!empty($tag)) {
                        // Vérifier si le tag existe déjà
                        $stmt = $pdo->prepare("SELECT id FROM tags WHERE nom = :nom");
                        $stmt->bindParam(':nom', $tag);
                        $stmt->execute();
                        $tag_id = $stmt->fetchColumn();

                        // Si le tag n'existe pas, l'insérer
                        if (!$tag_id) {
                            $stmt = $pdo->prepare("INSERT INTO tags (nom) VALUES (:nom)");
                            $stmt->bindParam(':nom', $tag);
                            $stmt->execute();
                            $tag_id = $pdo->lastInsertId();
                        }

                        // Lier le tag au contenu
                        $stmt = $pdo->prepare("INSERT INTO contenu_tags (contenu_id, tag_id) VALUES (:contenu_id, :tag_id)");
                        $stmt->bindParam(':contenu_id', $contenu_id);
                        $stmt->bindParam(':tag_id', $tag_id);
                        $stmt->execute();
                    }
                }
            }

            $_SESSION['success'] = "Contenu publié avec succès.";
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de la publication du contenu.";
            header("Location: ../creer_contenu.php");
            exit;
        }
    }
}
?>
