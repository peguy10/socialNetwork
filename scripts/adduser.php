<?php
    // Démarrer la session
    session_start();

    include('../inc/db_connect.php');
    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer et valider les données
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $motdepasse = $_POST['motdepasse'];
        $confirmation_motdepasse = $_POST['confirmation_motdepasse'];
        $bio = trim($_POST['bio']);

        // Vérification des champs requis
        if (empty($nom) || empty($email) || empty($motdepasse) || empty($confirmation_motdepasse)) {
            $_SESSION['error'] = "Tous les champs sont requis.";
            header("Location: ../register.php");
            exit;
        }

        // Vérification de la correspondance des mots de passe
        if ($motdepasse !== $confirmation_motdepasse) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
            header("Location: ../register.php");
            exit;
        }

        // Hachage du mot de passe
        $hashed_password = password_hash($motdepasse, PASSWORD_DEFAULT);
         // Gestion du fichier photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $file_tmp = $_FILES['photo']['tmp_name'];
            $file_name = basename($_FILES['photo']['name']);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            // Vérification de l'extension
            if (in_array($file_ext, $allowed_extensions)) {
                $upload_dir = '../uploads/'; // Dossier de destination
                $file_path = $upload_dir . uniqid() . '.' . $file_ext;

                // Déplacer le fichier téléchargé
                if (move_uploaded_file($file_tmp, $file_path)) {
                    // Préparation de la requête SQL
                    $sql = "INSERT INTO createurs (nom, email, motdepasse, bio, photo) VALUES (:nom, :email, :motdepasse, :bio, :photo)";
                            
                    if ($stmt = $pdo->prepare($sql)) {
                        // Lier les variables
                        $stmt->bindParam(':nom', $nom);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':motdepasse', $hashed_password);
                        $stmt->bindParam(':bio', $bio);
                        $stmt->bindParam(':photo', $file_path);


                        // Exécuter la requête
                        if ($stmt->execute()) {
                            $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                            header("Location: ../signin.php");
                            exit;
                        } else {
                            $_SESSION['error'] = "Une erreur s'est produite. Veuillez réessayer.";
                            header("Location: ../register.php");
                            exit;
                        }
                    }
                }
            }
        }
    }
?>
