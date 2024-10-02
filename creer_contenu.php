<?php 
   session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Creator Network</title>
      
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
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
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
       
    <div id="content-page" class="content-page">
      <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card position-relative inner-page-bg bg-primary" style="height: 150px;">
                     <div class="inner-page-title">
                        <h3 class="text-white">Ajouter un contenu</h3>
                        <p class="text-white"><?php echo $_SESSION['user_name'];?></p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-lg-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h2 class="card-title">Remplissez les informations</h2>
                        </div>
                     </div>
                     <div class="card-body">
                           <form action="scripts/addcontent.php" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                 <label for="type_contenu">Type de Contenu</label>
                                 <select class="form-control" id="type_contenu" name="type_contenu" required>
                                    <option value="">Sélectionnez un type</option>
                                    <option value="image">Image</option>
                                    <option value="video">Vidéo</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="description">Description</label>
                                 <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                              </div>
                              <div class="form-group" id="contenu_image" style="display: none;">
                                 <label for="image">Télécharger une Image</label>
                                 <input type="file" class="form-control" id="image" name="image" accept="image/*">
                              </div>
                              <div class="form-group" id="contenu_video" style="display: none;">
                                 <label for="video">URL de la Vidéo</label>
                                 <input type="url" class="form-control" id="video" name="video" placeholder="https://example.com/ma_video">
                              </div>
                              <div class="form-group">
                                 <label for="tags">Tags (séparés par des virgules)</label>
                                 <input type="text" class="form-control" id="tags" name="tags" placeholder="ex: technologie, santé, éducation">
                              </div>

                              <button type="submit" class="btn btn-primary">Publier</button>
                           </form>

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
    </footer>    <!-- Backend Bundle JavaScript -->
    

    <script>
        document.getElementById('type_contenu').addEventListener('change', function() {
            var type = this.value;
            document.getElementById('contenu_image').style.display = (type === 'image') ? 'block' : 'none';
            document.getElementById('contenu_video').style.display = (type === 'video') ? 'block' : 'none';
        });
    </script>
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