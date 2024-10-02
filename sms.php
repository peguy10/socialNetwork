<?php 
   session_start();
   include('inc/db_connect.php');
   if (!isset($_SESSION['user_name'])) {
      header('location: signin.php');
   }
   
// Récupération de l'ID de l'autre utilisateur depuis l'URL
$id_destinataire = $_GET['id'] ?? null;

if ($id_destinataire === null) {
    echo "Utilisateur non spécifié.";
    exit();
}

// Fonction pour récupérer les messages entre deux utilisateurs
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

// Fonction pour envoyer un message
function envoyerMessage($pdo, $id_expediteur, $id_destinataire, $message) {
    $sql = "INSERT INTO messages (id_expediteur, id_destinataire, message) VALUES (:id_expediteur, :id_destinataire, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_expediteur', $id_expediteur, PDO::PARAM_INT);
    $stmt->bindParam(':id_destinataire', $id_destinataire, PDO::PARAM_INT);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    return $stmt->execute();
}

// Récupérer les messages
$messages = recupererMessages($pdo, $_SESSION['user_id'], $id_destinataire);

// Vérifier si un message a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = $_POST['message'];
    envoyerMessage($pdo, $_SESSION['user_id'], $id_destinataire, $message);
    header("Location: sms.php?id=$id_destinataire");
}

// Récupérer le nom du destinataire
$stmt = $pdo->prepare("SELECT nom FROM createurs WHERE id_user = :id");
$stmt->bindParam(':id', $id_destinataire, PDO::PARAM_INT);
$stmt->execute();
$destinataire = $stmt->fetch(PDO::FETCH_ASSOC);

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
      
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .chat-container {
            width: cover;
            height: 600px;
            border: 0px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background-color: white;
            margin: 50px auto;
        }
        .messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .message {
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            margin: 5px 0;
            position: relative;
        }
        .message.sent {
            align-self: flex-end;
            background-color: #267af0;
            color:white;
        }
        .message.received {
            align-self: flex-start;
            background-color: #002457;
            color:#fff;
        }
        .input-container {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
        }
        .input-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .input-container button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 5px;
        }
    </style>
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
      <div id="content-page" class="content-page">
         <div class="container">
            <div class="row">
            <div class="col-sm-12">
                <div class="card position-relative inner-page-bg bg-primary" style="height: 150px;">
                    <div class="inner-page-title">
                        <h3 class="text-white">Chat avec</h3>
                        <p class="text-white"><?php echo htmlspecialchars($destinataire['nom']); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="chat-container">
                            <div class="messages">
                                <?php foreach ($messages as $msg): ?>
                                    <div class="<?php echo $msg['id_expediteur'] == $_SESSION['user_id'] ? 'message received' : 'message sent'; ?>"><?php echo htmlspecialchars($msg['message']); ?></div>
                                <?php endforeach; ?>
                            </div>
                            <div class="input-container">
                                <form id="message-form" method="POST">
                                    <input type="text" name="message" placeholder="Votre message..." required>
                                    <button type="submit">Envoyer</button>
                                </form>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

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
        $(document).ready(function() {
            // Soumettre le formulaire avec AJAX
            $('#message-form').on('submit', function(e) {
                e.preventDefault(); // Empêche le rechargement de la page
                $.ajax({
                    type: 'POST',
                    url: 'sms.php?id=<?php echo $id_destinataire; ?>',
                    data: $(this).serialize(),
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            $('#message-form')[0].reset(); // Réinitialiser le formulaire
                            loadMessages(); // Charger les messages
                        }
                    }
                });
            });

            // Fonction pour charger les messages
            function loadMessages() {
                $.ajax({
                    url: 'load_messages.php?id=<?php echo $id_destinataire; ?>',
                    method: 'GET',
                    success: function(data) {
                        $('#chat-box').html(data);
                    }
                });
            }

            // Vérifier les nouveaux messages toutes les 2 secondes
            setInterval(loadMessages, 2000);
        });
    </script>
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
    

    <!-- offcanvas start -->
 
    <div class="offcanvas offcanvas-bottom share-offcanvas" tabindex="-1" id="share-btn" aria-labelledby="shareBottomLabel">
       <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>
       <div class="offcanvas-body small">
          <div class="d-flex flex-wrap align-items-center">
             <div class="text-center me-3 mb-3">
                <img src="assets/images/icon/08.png" class="img-fluid rounded mb-2" alt="">
                <h6>Facebook</h6>
             </div>
             <div class="text-center me-3 mb-3">
                <img src="assets/images/icon/09.png" class="img-fluid rounded mb-2" alt="">
                <h6>Twitter</h6>
             </div>
             <div class="text-center me-3 mb-3">
                <img src="assets/images/icon/10.png" class="img-fluid rounded mb-2" alt="">
                <h6>Instagram</h6>
             </div>
             <div class="text-center me-3 mb-3">
                <img src="assets/images/icon/11.png" class="img-fluid rounded mb-2" alt="">
                <h6>Google Plus</h6>
             </div>
             <div class="text-center me-3 mb-3">
                <img src="assets/images/icon/13.png" class="img-fluid rounded mb-2" alt="">
                <h6>In</h6>
             </div>
             <div class="text-center me-3 mb-3">
                <img src="assets/images/icon/12.png" class="img-fluid rounded mb-2" alt="">
                <h6>YouTube</h6>
             </div>
          </div>
       </div>
    </div>
  </body>
</html>