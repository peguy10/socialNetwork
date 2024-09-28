<?php
    // Démarrer la session
    session_start();

    include('../inc/db_connect.php');
   // Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $motdepasse = $_POST['motdepasse'];

    // Préparer la requête SQL pour récupérer l'utilisateur
    $sql = "SELECT * FROM createurs WHERE email = :email";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifier si l'utilisateur existe
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier le mot de passe
            if (password_verify($motdepasse, $user['motdepasse'])) {
                // Authentification réussie
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['photo'] = $user['photo'];
                header("Location: ../index.php"); // Rediriger vers le tableau de bord
                exit;
            } else {
                $_SESSION['error'] = "Mot de passe incorrect.";
                header("Location: ../signin.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Aucun utilisateur trouvé avec cet email.";
            header("Location: ../signin.php");
            exit;
        }
    }
}
?>
