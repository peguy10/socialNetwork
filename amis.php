<?php
session_start();
require 'inc/db_connect.php';  // Assurez-vous de remplacer par votre fichier de connexion à la base de données


// Fonction pour récupérer tous les utilisateurs sauf celui connecté
function recupererUtilisateurs($pdo, $id_utilisateur) {
    $sql = "SELECT id_user,photo, nom,bio FROM createurs WHERE id_user != :id_utilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer tous les utilisateurs
$utilisateurs = recupererUtilisateurs($pdo, $_SESSION['user_id']);


function envoyerDemandeAmitie($pdo, $id_demandeur, $id_destinataire) {
   $sql = "INSERT INTO demandes_amitie (id_demandeur, id_destinataire) VALUES (:id_demandeur, :id_destinataire)";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id_demandeur', $id_demandeur, PDO::PARAM_INT);
   $stmt->bindParam(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
   return $stmt->execute();
}
// Vérifier si une demande a été envoyée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destinataire'])) {
    $id_destinataire = $_POST['destinataire'];
    envoyerDemandeAmitie($pdo, $_SESSION['user_id'], $id_destinataire);
    $message = "Demande d'amitié envoyée avec succès !";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Content Center</title>      
      <link rel="shortcut icon" href="assets/images/favicon.ico" />
      <link rel="stylesheet" href="assets/css/libs.min.css">
      <link rel="stylesheet" href="assets/css/socialv.css?v=4.0.0">
      <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
      <link rel="stylesheet" href="assets/vendor/font-awesome-line-awesome/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      
  </head>
  <body class="  ">
    <!-- loader Start -->
    
    <!-- loader END -->
    <!-- Wrapper Start -->
   <div class="wrapper">
      <div class="iq-sidebar  sidebar-default ">
            <div id="sidebar-scrollbar">
               <?php include('inc/nav.php');?>
               <div class="p-5"></div>
            </div>
      </div>

      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex justify-content-between">
                     <a href="dashboard/index.html">
                        <img src="assets/images/logo.png" class="img-fluid" alt="">
                        <span>Creator network</span>
                     </a>
                     <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                              <div class="main-circle"><i class="ri-menu-line"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="iq-search-bar device-search">
                     <form action="#" class="searchbox">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        <input type="text" class="text search-input" placeholder="Search here...">
                     </form>
                  </div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                     data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                     aria-label="Toggle navigation">
                     <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav  ms-auto navbar-list">
                        <li>
                              <a href="dashboard/index.html" class="  d-flex align-items-center">
                                 <i class="ri-home-line"></i>
                              </a>
                        </li>
                        <!-- friend icon -->
                           <?php include('inc/friend.php');?>
                        
                           <!-- notif icon -->
                           <?php include('inc/notif.php');?>

                        <!-- message icon  -->
                           <?php include('inc/messages.php');?>

                           <!-- user icon -->
                           <?php include('inc/user.php');?>
                     </ul>               
                  </div>
            </nav>
         </div>
      </div>

   <!-- My friend -->
      <?php include('inc/Myfriend.php');?>
        <!-- Page Content  -->
        <div class="header-for-bg">
            <div class="background-header position-relative">
                <img src="../assets/images/page-img/profile-bg7.jpg" class="img-fluid w-100" alt="header-bg">
                <div class="title-on-header">
                    <div class="data-block">
                        <h2>AMIS</h2>
                    </div>
                </div>
            </div>
        </div>
      <div id="content-page" class="content-page">
        <div class="container">
            <div class="d-grid gap-3 d-grid-template-1fr-19">
             <?php foreach ($utilisateurs as $utilisateur): ?>
            <form method="POST" action="" style="display:inline-block;"> 
                <input type="hidden" name="destinataire" value="<?php echo $utilisateur['id_user']; ?>">
                <div class="card mt-3">
                    <div class="top-bg-image">
                        <img src="" alt="">
                        <?php if (isset($message)): ?>
                            <p><?php echo htmlspecialchars($message); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-body text-center">
                        <div class="group-icon">
                            <img src="<?php echo $utilisateur['photo']; ?>" alt="profile-img" class="rounded-circle img-fluid avatar-120">
                        </div>
                        <div class="group-info pt-3 pb-3">
                            <h4><a href="userdetails.php?user_id=<?php echo htmlspecialchars($utilisateur['id_user']); ?>"><?php echo htmlspecialchars($utilisateur['nom']); ?></a></h4>
                            <p><?php echo htmlspecialchars($utilisateur['bio']); ?></p>
                        </div>
                        <button type="submit" class="btn btn-primary d-block w-100">Join</button>
                    </div>
                </div>
            </form>
            <?php endforeach; ?>
            </div>
        </div>
      </div>
   </div>
    <!-- Wrapper End-->
    <footer class="iq-footer bg-white">
       <div class="container-fluid">
          <div class="row">
             <div class="col-lg-6">
                <ul class="list-inline mb-0">
                   <li class="list-inline-item"><a href="dashboard/privacy-policy.html">Privacy Policy</a></li>
                   <li class="list-inline-item"><a href="dashboard/terms-of-service.html">Terms of Use</a></li>
                </ul>
             </div>
             <div class="col-lg-6 d-flex justify-content-end">
                Copyright 2020 <a href="#">SocialV</a> All Rights Reserved.
             </div>
          </div>
       </div>
    </footer> 
    <script>
      function toggleLike(contenuId) {
         const formData = new FormData();
         formData.append('contenu_id', contenuId);

         fetch('scripts/addlike.php', {
            method: 'POST',
            body: formData
         })
         .then(response => {
            if (response.ok) {
                  location.reload(); // Recharger la page pour mettre à jour les likes
            }
         })
         .catch(error => console.error('Erreur:', error));
      }
      </script>
   <!-- Backend Bundle JavaScript -->
    <script src="assets/js/libs.min.js"></script>
    <!-- slider JavaScript -->
    <script src="assets/js/slider.js"></script>
    <!-- masonry JavaScript --> 
    <script src="assets/js/masonry.pkgd.min.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="assets/js/enchanter.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="assets/js/sweetalert.js"></script>
    <!-- app JavaScript -->
    <script src="assets/js/charts/weather-chart.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>
    <script src="assets/js/lottie.js"></script>
    

  </body>
</html>