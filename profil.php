<?php 
   session_start();
   include('inc/db_connect.php');
   if (!isset($_SESSION['user_name'])) {
      header('location: signin.php');
   }

   $user=$_SESSION['user_id'];
   $sql = "SELECT * FROM contenus
       where utilisateur_id=:id_user
       GROUP BY id
       ORDER BY date_creation DESC";

   $stmt1 = $pdo->prepare($sql);
   $stmt1->bindParam(':id_user', $user, PDO::PARAM_INT);
   $stmt1->execute();
   $contents = $stmt1->fetchAll(PDO::FETCH_ASSOC);
   // Fonction pour récupérer les demandes d'amitié acceptées par l'utilisateur
   function recupererDemandesAcceptees($pdo, $id_utilisateur) {
       $sql = "SELECT d.*,photo, u.nom AS nom_autre_utilisateur 
               FROM demandes_amitie d 
               JOIN createurs u ON (d.id_demandeur = u.id_user OR d.id_destinataire = u.id_user) 
               WHERE (d.id_demandeur = :id_utilisateur OR d.id_destinataire = :id_utilisateur) 
               AND u.id_user != :id_utilisateur
               AND d.statut = 'accepte'";
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   
   // Récupérer les demandes d'amitié acceptées par l'utilisateur connecté
   $demandes_acceptees = recupererDemandesAcceptees($pdo, $_SESSION['user_id']);
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
                     <a href="../">
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
                              <a href="../" class="  d-flex align-items-center">
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
                    <div class="card">
                        <div class="card-body profile-page p-0">
                        <div class="profile-header">
                            <div class="position-relative">
                                <img src="../assets/images/page-img/profile-bg1.jpg" alt="profile-bg" class="rounded img-fluid">
                                <ul class="header-nav list-inline d-flex flex-wrap justify-end p-0 m-0">
                                    <li><a href="#"><i class="ri-pencil-line"></i></a></li>
                                    <li><a href="#"><i class="ri-settings-4-line"></i></a></li>
                                </ul>
                            </div>
                            <div class="user-detail text-center mb-3">
                                <div class="profile-img">
                                    <img src="<?php echo $_SESSION['photo'];?>" alt="profile-img" class="avatar-130 img-fluid" />
                                </div>
                                <div class="profile-detail">
                                    <h3 class=""><?php echo $_SESSION['user_name'];?></h3>
                                </div>
                            </div>
                            <div class="profile-info p-3 d-flex align-items-center justify-content-between position-relative">
                                <div class="social-links">
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                    <li class="text-center pe-3">
                                        <a href="#"><img src="../assets/images/icon/08.png" class="img-fluid rounded" alt="facebook"></a>
                                    </li>
                                    <li class="text-center pe-3">
                                        <a href="#"><img src="../assets/images/icon/09.png" class="img-fluid rounded" alt="Twitter"></a>
                                    </li>
                                    <li class="text-center pe-3">
                                        <a href="#"><img src="../assets/images/icon/10.png" class="img-fluid rounded" alt="Instagram"></a>
                                    </li>
                                    <li class="text-center pe-3">
                                        <a href="#"><img src="../assets/images/icon/11.png" class="img-fluid rounded" alt="Google plus"></a>
                                    </li>
                                    <li class="text-center pe-3">
                                        <a href="#"><img src="../assets/images/icon/12.png" class="img-fluid rounded" alt="You tube"></a>
                                    </li>
                                    <li class="text-center md-pe-3 pe-0">
                                        <a href="#"><img src="../assets/images/icon/13.png" class="img-fluid rounded" alt="linkedin"></a>
                                    </li>
                                    </ul>
                                </div>
                                <div class="social-info">
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                    <li class="text-center ps-3">
                                        <h6>Posts</h6>
                                        <p class="mb-0"><?php echo count($contents);?></p>
                                    </li>
                                    <li class="text-center ps-3">
                                        <h6>Amis</h6>
                                        <p class="mb-0"><?php echo count($demandes_acceptees);?></p>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                        <div class="user-tabing">
                            <ul class="nav nav-pills d-flex align-items-center justify-content-center profile-feed-items p-0 m-0">
                                <li class="nav-item col-12 col-sm-3 p-0">
                                    <a class="nav-link active" href="#pills-timeline-tab" data-bs-toggle="pill" data-bs-target="#timeline" role="button">Publications</a>
                                </li>
                                <li class="nav-item col-12 col-sm-3 p-0">
                                    <a class="nav-link" href="#pills-about-tab" data-bs-toggle="pill" data-bs-target="#about" role="button">A propos </a>
                                </li>
                                <li class="nav-item col-12 col-sm-3 p-0">
                                    <a class="nav-link" href="#pills-friends-tab" data-bs-toggle="pill" data-bs-target="#friends" role="button">Abonnés</a>
                                </li>
                                <li class="nav-item col-12 col-sm-3 p-0">
                                    <a class="nav-link" href="#pills-photos-tab" data-bs-toggle="pill" data-bs-target="#photos" role="button">Photos</a>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                        <div class="card-body">
                                            <a href="#"><span class="badge badge-pill bg-primary font-weight-normal ms-auto me-1"><i class="ri-star-line"></i></span> 27 Items for yoou</a>
                                        </div>
                                        </div>
                                        <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h4 class="card-title">Photos</h4>
                                            </div>
                                            <div class="card-header-toolbar d-flex align-items-center">
                                                <p class="m-0"><a href="javacsript:void();">Add Photo </a></p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="profile-img-gallary p-0 m-0 list-unstyled">
                                                <?php foreach ($contents as $content) {?>
                                                    <li class=""><a href="#"><img src="<?php echo $content['image'];?>" alt="gallary-image" class="img-fluid" /></a></li>
                                               <?php }?>
                                            </ul>
                                        </div>
                                        </div>
                                        <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h4 class="card-title">AMIS</h4>
                                            </div>
                                            <div class="card-header-toolbar d-flex align-items-center">
                                                <p class="m-0"><a href="amis.php">Add New </a></p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="profile-img-gallary p-0 m-0 list-unstyled">
                                                
                                                <?php if (count($demandes_acceptees) > 0): ?>
                                                    <?php foreach ($demandes_acceptees as $demande): ?>
                                                    <li class="">
                                                        <a href="#">
                                                        <img src="<?php echo htmlspecialchars($demande['photo']); ?>" alt="gallary-image" class="img-fluid" /></a>
                                                        <h6 class="mt-2 text-center"><?php echo htmlspecialchars($demande['nom_autre_utilisateur']); ?></h6>
                                                    </li>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                    <p>Aucune demande d'amitié acceptée.</p>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="post-modal-data" class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <h2>Vos publications</h2>
                                        </div>
                                    </div>
                                        <div class="card">
                                        <div class="card-body">
                                            
                                            <!-- post -->
                                                <?php include('inc/postuser.php');?>
                                            <!-- end post -->
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- about -->
                        <div class="tab-pane fade" id="about" role="tabpanel" >
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                        <ul class="nav nav-pills basic-info-items list-inline d-block p-0 m-0">
                                            <li>
                                                <a class="nav-link active" href="#v-pills-basicinfo-tab" data-bs-toggle="pill" data-bs-target="#v-pills-basicinfo-tab" role="button">Vos infos</a>
                                            </li>
                                        </ul>
                                        </div>
                                        <div class="col-md-9 ps-4">
                                        <div class="tab-content" >
                                            <div class="tab-pane fade active show" id="v-pills-basicinfo-tab" role="tabpanel"  aria-labelledby="v-pills-basicinfo-tab">
                                                <h4>Contact Information</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-3">
                                                    <h6>Nom complet</h6>
                                                    </div>
                                                    <div class="col-9">
                                                    <p class="mb-0"><?php echo $_SESSION['user_name'];?></p>
                                                    </div>
                                                    <div class="col-3">
                                                    <h6>Email</h6>
                                                    </div>
                                                    <div class="col-9">
                                                    <p class="mb-0"><?php echo $_SESSION['email'];?></p>
                                                    </div>
                                                    <div class="col-3">
                                                    <h6>Mobile</h6>
                                                    </div>
                                                    <div class="col-9">
                                                    <p class="mb-0"><?php echo $_SESSION['tel'];?></p>
                                                    </div>
                                                <h4 class="mt-3 mb-3">Bio</h4>
                                                <p><?php echo $_SESSION['bio'];?></p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- friend -->
                        <div class="tab-pane fade" id="friends" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Friends</h2>
                                    <div class="friend-list-tab mt-2">
                                        <ul class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2">
                                            <li>
                                                <a class="nav-link active" data-bs-toggle="pill" href="#pill-all-friends" data-bs-target="#all-feinds">All Friends</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="all-friends" role="tabpanel">
                                                <div class="card-body p-0">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 mb-3">
                                                            <div class="iq-friendlist-block">
                                                                
                                                                <?php foreach ($demandes_acceptees as $demande): ?>
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="#">
                                                                            <img src="<?php echo htmlspecialchars($demande['photo']); ?>" alt="profile-img" class="img-fluid logo w-50">
                                                                            </a>
                                                                            <div class="friend-info ms-3">
                                                                            <h5><?php echo htmlspecialchars($demande['nom_autre_utilisateur']); ?></h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="following" role="tabpanel">
                                                <div class="card-body p-0">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 mb-3">
                                                            <div class="iq-friendlist-block">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <a href="#">
                                                                        <img src="../assets/images/user/05.jpg" alt="profile-img" class="img-fluid">
                                                                        </a>
                                                                        <div class="friend-info ms-3">
                                                                        <h5>Maya Didas</h5>
                                                                        <p class="mb-0">20  friends</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-header-toolbar d-flex align-items-center">
                                                                        <div class="dropdown">
                                                                        <span class="dropdown-toggle btn btn-secondary me-2" id="dropdownMenuButton54" data-bs-toggle="dropdown" aria-expanded="true" role="button">
                                                                        <i class="ri-check-line me-1 text-white"></i> Friend
                                                                        </span>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton54">
                                                                            <a class="dropdown-item" href="#">Get Notification</a>
                                                                            <a class="dropdown-item" href="#">Close Friend</a>
                                                                            <a class="dropdown-item" href="#">Unfollow</a>
                                                                            <a class="dropdown-item" href="#">Unfriend</a>
                                                                            <a class="dropdown-item" href="#">Block</a>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- photos -->
                        <div class="tab-pane fade" id="photos" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Photos</h2>
                                    <div class="friend-list-tab mt-2">
                                        
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="photosofyou" role="tabpanel">
                                                <div class="card-body p-0">
                                                    <div class="d-grid gap-2 d-grid-template-1fr-13">
                                                        
                                                        <?php foreach ($contenus as $contenu) {?>
                                                            <div class="">
                                                                <div class="user-images position-relative overflow-hidden">
                                                                    <a href="#">
                                                                    <img src="<?php echo $contenu['image'];?>" class="img-fluid rounded" alt="Responsive image">
                                                                    </a>
                                                                    <div class="image-hover-data">
                                                                        <div class="product-elements-icon">
                                                                            <ul class="d-flex align-items-center m-0 p-0 list-inline">
                                                                            <li><a href="#" class="pe-3 text-white"> 60 <i class="ri-thumb-up-line"></i> </a></li>
                                                                            <li><a href="#" class="pe-3 text-white"> 30 <i class="ri-chat-3-line"></i> </a></li>
                                                                            <li><a href="#" class="pe-3 text-white"> 10 <i class="ri-share-forward-line"></i> </a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <a href="#" class="image-edit-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit or Remove"><i class="ri-edit-2-fill"></i></a>
                                                                </div>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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