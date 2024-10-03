<?php 
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Content center</title>
      
      <link rel="shortcut icon" href="assets/images/favicon.ico" />
      <link rel="stylesheet" href="assets/css/libs.min.css">
      <link rel="stylesheet" href="assets/css/socialv.css?v=4.0.0">
      <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
      <link rel="stylesheet" href="assets/vendor/font-awesome-line-awesome/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      
  </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
    <section class="sign-in-page">
        <div id="container-inside">
            <div id="circle-small"></div>
            <div id="circle-medium"></div>
            <div id="circle-large"></div>
            <div id="circle-xlarge"></div>
            <div id="circle-xxlarge"></div>
        </div>
        <div class="container p-0">
            <div class="row no-gutters">
                <div class="col-md-6 text-center pt-5">
                    <div class="sign-in-detail text-white">
                        <div class="sign-slider overflow-hidden ">
                            <ul  class="swiper-wrapper list-inline m-0 p-0 ">
                                <li class="swiper-slide">
                                    <img src="assets/images/logo.png" class="img-fluid w-50 h-50" alt="logo">
                                    <h4 class="mb-1 text-white">Trouver des nouveaux amis</h4>
                                    <p>En vous inscrivant sur CN.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-white pt-5 pt-5 pb-lg-0 pb-5">
                    <div class="sign-in-from">
                        <form class="mt-0" action="scripts/adduser.php" method="POST" enctype="multipart/form-data">
                            <?php if (isset($_SESSION['error'])) {
                                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
                            }?>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Nom Complet</label>
                                <input type="text" class="form-control mb-0" id="exampleInputEmail1" placeholder="Nom Complet" name="nom">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail2">Adresse Email</label>
                                <input type="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputPassword1">Mot de passe</label>
                                <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Entrer le mot de passe" name="motdepasse">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputPassword1">Confirmer le Mot de Passe</label>
                                <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Confirmer le Mot de Passe" name="confirmation_motdepasse">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputPassword1">Bio (optionnel)</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Votre Biographie"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputPassword1">Photo de profil</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                            </div>
                            
                
                            <div class="d-inline-block w-100">
                                <div class="form-check d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">S'inscrire</button>
                            </div>
                            <!-- <div class="sign-info">
                                <span class="dark-color d-inline-block line-height-2">Avez vous un compte  ? <a href="signin.php">Log In</a></span>
                                <ul class="iq-social-media">
                                    <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                    <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                    <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                </ul>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
      </div>
    
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