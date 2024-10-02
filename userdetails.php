<?php 
   session_start();
   include('inc/db_connect.php');
   if (!isset($_SESSION['user_name'])) {
      header('location: signin.php');
   }

function userLiked($contenu_id) {
    global $pdo;
    $utilisateur_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM likes WHERE contenu_id = ? AND utilisateur_id = ?");
    $stmt->execute([$contenu_id, $utilisateur_id]);
    return $stmt->fetch() !== false;
}

$iduser=$_GET['user_id'];
$sql = "SELECT c.id, c.type, c.description, c.image, c.video, c.date_creation, u.photo, u.nom AS utilisateur_nom, 
           GROUP_CONCAT(t.nom SEPARATOR ', ') AS tags,
           COUNT(co.id) AS nombre_commentaires,
           COUNT(l.id) AS nombre_likes
    FROM contenus c
    JOIN createurs u ON c.utilisateur_id = u.id_user
    LEFT JOIN contenu_tags ct ON c.id = ct.contenu_id
    LEFT JOIN tags t ON ct.tag_id = t.id
    LEFT JOIN commentaires co ON c.id = co.contenu_id
    LEFT JOIN likes l ON c.id = l.contenu_id
    where u.id_user=:id_user
    GROUP BY c.id, u.nom
    ORDER BY c.date_creation DESC";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_user', $iduser, PDO::PARAM_INT);
$stmt->execute();
$contenus = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fonction pour récupérer tous les utilisateurs sauf celui connecté
function recupererUtilisateurs($pdo, $id_utilisateur) {
    $sql = "SELECT * FROM createurs WHERE id_user = :id_utilisateur";
    $stmt1 = $pdo->prepare($sql);
    $stmt1->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt1->execute();
    return $stmt1->fetch(PDO::FETCH_ASSOC);
}

// Récupérer tous les utilisateurs
$utilisateurs = recupererUtilisateurs($pdo, $iduser);

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
      <div id="content-page" class="content-page">
                    
            <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap">
                        <div class="group-info d-flex align-items-center">
                            <div class="me-3">
                                <img class="rounded-circle img-fluid avatar-100" src="<?php echo $utilisateurs['photo'];?>" alt="">
                                <p class="mb-0"><i class="ri-lock-fill pe-2"></i><?php echo $utilisateurs['email'];?></p>
                            </div>
                        </div>
                        <div class="group-member d-flex align-items-center  mt-md-0 mt-2">
                            <div class="iq-media-group me-3">
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/05.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/06.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/07.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/08.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/09.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/10.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/11.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/12.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    
                    <div class="card">
                        
                        <!-- post -->
                        
                        <?php foreach ($contenus as $contenu) {?>
                            <div class="col-sm-12">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="user-post-data">
                                            <div class="d-flex justify-content-between">
                                            <div class="me-3">
                                                <img class="rounded-circle img-fluid" src="<?php echo $contenu['photo'];?>" style="width:70px;">
                                            </div>
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        <h5 class="mb-0 d-inline-block"><?php echo $contenu['utilisateur_nom'];?></h5>
                                                        <span class="mb-0 d-inline-block">Add New Post</span>
                                                        <p class="mb-0 text-primary"><?php echo $contenu['date_creation'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p><?php echo $contenu['description'];?></p>
                                            <p class="card-text"><strong>#<?php echo htmlspecialchars($contenu['tags']); ?></strong></p>
                                        </div>
                                        <div class="user-post">
                                            <div class=" d-grid grid-rows-2 grid-flow-col gap-3">
                                                <div class="row-span-2 row-span-md-1">
                                                    <img src="<?php echo $contenu['image'];?>" alt="post-image" class="img-fluid rounded w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-area mt-3">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="like-block position-relative d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="like-data">
                                                        <div class="dropdown">
                                                        <button class="h4 bg-transparent border-0" onclick="toggleLike(<?php echo $contenu['id']; ?>)">
                                                            <?php echo userLiked($contenu['id']) ? '<i class="fa fa-heart text-danger" aria-hidden="true"></i>' : 'J\'aime'; ?>
                                                        </button>
                                                        </div>
                                                    </div>
                                                    <div class="total-like-block ms-2 me-3">
                                                        <div class="dropdown">
                                                        <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                        <?php echo $contenu['nombre_likes']; ?> Likes
                                                        <i class="fa fa-heart-rate" aria-hidden="true"></i>
                                                        </span>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Max Emum</a>
                                                            <a class="dropdown-item" href="#">Bill Yerds</a>
                                                            <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                            <a class="dropdown-item" href="#">Tara Misu</a>
                                                            <a class="dropdown-item" href="#">Midge Itz</a>
                                                            <a class="dropdown-item" href="#">Sal Vidge</a>
                                                            <a class="dropdown-item" href="#">Other</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="total-comment-block">
                                                    <div class="dropdown">
                                                        <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                        <?php echo $contenu['nombre_commentaires']; ?> Commentaires
                                                        </span>
                                                        <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Max Emum</a>
                                                        <a class="dropdown-item" href="#">Bill Yerds</a>
                                                        <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                                        <a class="dropdown-item" href="#">Tara Misu</a>
                                                        <a class="dropdown-item" href="#">Midge Itz</a>
                                                        <a class="dropdown-item" href="#">Sal Vidge</a>
                                                        <a class="dropdown-item" href="#">Other</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="share-block d-flex align-items-center feather-icon mt-2 mt-md-0">
                                                <a href="javascript:void();" data-bs-toggle="offcanvas" data-bs-target="#share-btn" aria-controls="share-btn"><i class="ri-share-line"></i>
                                                <span class="ms-1">99 Share</span></a>                           
                                            </div>
                                            </div>
                                            <hr>
                                                    <ul class="post-comments list-inline p-0 m-0">
                                                        <?php
                                                        // Récupérer les commentaires pour ce contenu
                                                        $stmt_comments = $pdo->prepare("SELECT c.commentaire, u.nom AS utilisateur_nom , u.photo, c.date_creation 
                                                                                        FROM commentaires c 
                                                                                        JOIN createurs u ON c.utilisateur_id = u.id_user 
                                                                                        WHERE c.contenu_id = ? 
                                                                                        ORDER BY c.date_creation DESC");
                                                        $stmt_comments->execute([$contenu['id']]);
                                                        $commentaires = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($commentaires as $commentaire): ?>
                                                            <li class="mb-2">
                                                                <div class="d-flex">
                                                                    <div class="user-img">
                                                                        <img src="<?php echo htmlspecialchars($commentaire['photo']); ?>" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                                                    </div>
                                                                    <div class="comment-data-block ms-3">
                                                                        <h6><?php echo htmlspecialchars($commentaire['utilisateur_nom']); ?></h6>
                                                                        <p class="mb-0"><?php echo htmlspecialchars($commentaire['commentaire']); ?></p>
                                                                        <div class="d-flex flex-wrap align-items-center comment-activity">
                                                                        <!-- <a href="javascript:void();">like</a>
                                                                        <a href="javascript:void();">reply</a>
                                                                        <a href="javascript:void();">translate</a> -->
                                                                        <span class="text-primary"> <?php echo date('d-m-Y H:i', strtotime($commentaire['date_creation'])); ?> </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>

                                                    </ul>
                                                    <form class="comment-text d-flex align-items-center mt-3" action="scripts/addcomment.php" method="POST">
                                                        <input type="hidden" name="contenu_id" value="<?php echo $contenu['id']; ?>">
                                                        <input type="text" class="form-control rounded" placeholder="Enter Your Comment" id="commentaire" name="commentaire">
                                                        <div class="comment-attagement d-flex">
                                                            <button type="submit" class="bg-transparent border-0"><i class="ri-send-plane-fill me-3"></i></button>
                                                            
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        <?php }?>
                        <!-- end post -->
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                              <h4 class="card-title">A propos</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <ul class="list-inline p-0 m-0">
                              <li class="mb-3">
                                 <p class="mb-0"><?php echo $utilisateurs['nom'];?></p>
                              </li>
                              <li class="mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="ri-lock-fill h4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6>Private</h6>
                                        <p class="mb-0">Success in slowing economic activity.</p>
                                    </div>
                                </div>
                              </li>
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="ri-eye-fill h4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Visible</h6>
                                            <p class="mb-0">Various versions have evolved over the years</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                        <i class="ri-group-fill h4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                        <h6>General group</h6>
                                        <p class="mb-0">There are many variations of passages</p>
                                        </div>
                                    </div>
                                </li>
                           </ul>
                        </div>
                     </div>
                </div>
                <div class="col-sm-12 text-center">
                    <img src="../assets/images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
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