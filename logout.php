<?php
session_start();

session_unset();
// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header("Location: signin.php");
exit;
?>
