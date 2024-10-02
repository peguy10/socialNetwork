<?php 
   session_start();
   include('inc/db_connect.php');
   if (!isset($_SESSION['user_name'])) {
      header('location: signin.php');
   }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Content Center</title>      
      <link rel="shortcut icon" href="assets/images/logo1.png" />
      <link rel="stylesheet" href="assets/css/libs.min.css">
      <link rel="stylesheet" href="assets/css/socialv.css?v=4.0.0">
      <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
      <link rel="stylesheet" href="assets/vendor/font-awesome-line-awesome/css/all.min.css">
      <link rel="stylesheet" href="assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <style>
         
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
                     <a href="./">
                        <img src="assets/images/logo1.png" class="img-fluid h-20" alt="" width="100px">
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
               <div class="col-lg-8 row m-0 p-0">
                  <div class="col-sm-12">
                     <div id="post-modal-data" class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                              <h4 class="card-title">Create Post</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="user-img">
                                 <img src="<?php echo $_SESSION['photo'];?>" alt="userimg" class="avatar-60 rounded-circle">
                              </div>
                              <form class="post-text ms-3 w-100 "  data-bs-toggle="modal" data-bs-target="#post-modal" action="javascript:void();">
                                 <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                              </form>
                           </div>
                           <hr>
                           <ul class=" post-opt-block d-flex list-inline m-0 p-0 flex-wrap">
                              <li class="me-3 mb-md-0 mb-2">
                                 <a href="#" class="btn btn-soft-primary">
                                    <img src="assets/images/small/07.png" alt="icon" class="img-fluid me-2"> Photo/Video
                                 </a>
                              </li>
                              <li class="me-3 mb-md-0 mb-2">
                                 <a href="#" class="btn btn-soft-primary">
                                    <img src="assets/images/small/08.png" alt="icon" class="img-fluid me-2"> Tag Friend
                                 </a>
                              </li>
                              <li class="me-3">
                                 <a href="#" class="btn btn-soft-primary">
                                    <img src="assets/images/small/09.png" alt="icon" class="img-fluid me-2"> Feeling/Activity
                                 </a>
                              </li>
                              <li>
                                 <button class="btn btn-soft-primary">
                                    <div class="card-header-toolbar d-flex align-items-center">
                                       <div class="dropdown">
                                          <div class="dropdown-toggle" id="post-option"   data-bs-toggle="dropdown">
                                             <i class="ri-more-fill"></i>
                                          </div>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post-option" style="">
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Check in</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Live Video</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Gif</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Watch Party</a>
                                             <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Play with Friend</a>
                                          </div>
                                       </div>
                                    </div>
                                 </button>
                              </li>
                           </ul>
                        </div>
                        <div class="modal fade" id="post-modal" tabindex="-1"  aria-labelledby="post-modalLabel" aria-hidden="true" >
                           <div class="modal-dialog   modal-fullscreen-sm-down">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ri-close-fill"></i></button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="d-flex align-items-center">
                                       <div class="user-img">
                                          <img src="<?php echo $_SESSION['photo'];?>" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                                       </div>
                                       <form class="post-text ms-3 w-100" action="javascript:void();">
                                          <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                                       </form>
                                    </div>
                                    <hr>
                                    <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/07.png" alt="icon" class="img-fluid"> Photo/Video</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/08.png" alt="icon" class="img-fluid"> Tag Friend</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/10.png" alt="icon" class="img-fluid"> Check in</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/11.png" alt="icon" class="img-fluid"> Live Video</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/12.png" alt="icon" class="img-fluid"> Gif</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/13.png" alt="icon" class="img-fluid"> Watch Party</div>
                                       </li>
                                       <li class="col-md-6 mb-3">
                                          <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="assets/images/small/14.png" alt="icon" class="img-fluid"> Play with Friends</div>
                                       </li>
                                    </ul>
                                    <hr>
                                    <div class="other-option">
                                       <div class="d-flex align-items-center justify-content-between">
                                          <div class="d-flex align-items-center">
                                             <div class="user-img me-3">
                                                <img src="<?php echo $_SESSION['photo'];?>" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                                             </div>
                                             <h6>Your Story</h6>
                                          </div>
                                          <div class="card-post-toolbar">
                                             <div class="dropdown">
                                                <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                <span class="btn btn-primary">Friend</span>
                                                </span>
                                                <div class="dropdown-menu m-0 p-0">
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <i class="ri-save-line h4"></i>
                                                         <div class="data ms-2">
                                                            <h6>Public</h6>
                                                            <p class="mb-0">Anyone on or off Facebook</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                      <i class="ri-close-circle-line h4"></i>
                                                         <div class="data ms-2">
                                                            <h6>Friends</h6>
                                                            <p class="mb-0">Your Friend on facebook</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <i class="ri-user-unfollow-line h4"></i>
                                                         <div class="data ms-2">
                                                            <h6>Friends except</h6>
                                                            <p class="mb-0">Don't show to some friends</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                   <a class="dropdown-item p-3" href="#">
                                                      <div class="d-flex align-items-top">
                                                         <i class="ri-notification-line h4"></i>
                                                         <div class="data ms-2">
                                                            <h6>Only Me</h6>
                                                            <p class="mb-0">Only me</p>
                                                         </div>
                                                      </div>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary d-block w-100 mt-3">Post</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <!-- post -->
                     <?php include('inc/post.php');?>
                  <!-- end post -->
               </div>
               <div class="col-lg-4">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Stories</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <ul class="media-story list-inline m-0 p-0">
                           <li class="d-flex mb-3 align-items-center">
                              <i class="ri-add-line"></i>
                              <div class="stories-data ms-3">
                                 <h5>Creat Your Story</h5>
                                 <p class="mb-0">time to story</p>
                              </div>
                           </li>
                           <li class="d-flex mb-3 align-items-center active">
                              <img src="assets/images/page-img/s2.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Anna Mull</h5>
                                 <p class="mb-0">1 hour ago</p>
                              </div>
                           </li>
                           <li class="d-flex mb-3 align-items-center">
                              <img src="assets/images/page-img/s3.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Ira Membrit</h5>
                                 <p class="mb-0">4 hour ago</p>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <img src="assets/images/page-img/s1.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Bob Frapples</h5>
                                 <p class="mb-0">9 hour ago</p>
                              </div>
                           </li>
                        </ul>
                        <a href="#" class="btn btn-primary d-block mt-3">See All</a>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Events</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                           <div class="dropdown">
                              <div class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                 <i class="ri-more-fill h4"></i>
                              </div>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="">
                                 <a class="dropdown-item" href="#"><i class="ri-eye-fill me-2"></i>View</a>
                                 <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill me-2"></i>Delete</a>
                                 <a class="dropdown-item" href="#"><i class="ri-pencil-fill me-2"></i>Edit</a>
                                 <a class="dropdown-item" href="#"><i class="ri-printer-fill me-2"></i>Print</a>
                                 <a class="dropdown-item" href="#"><i class="ri-file-download-fill me-2"></i>Download</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <ul class="media-story list-inline m-0 p-0">
                           <li class="d-flex mb-4 align-items-center ">
                              <img src="assets/images/page-img/s4.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Web Workshop</h5>
                                 <p class="mb-0">1 hour ago</p>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <img src="assets/images/page-img/s5.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Fun Events and Festivals</h5>
                                 <p class="mb-0">1 hour ago</p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Upcoming Birthday</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <ul class="media-story list-inline m-0 p-0">
                           <li class="d-flex mb-4 align-items-center">
                              <img src="assets/images/user/01.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Anna Sthesia</h5>
                                 <p class="mb-0">Today</p>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <img src="assets/images/user/02.jpg" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5>Paul Molive</h5>
                                 <p class="mb-0">Tomorrow</p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Suggested Pages</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                           <div class="dropdown">
                              <div class="dropdown-toggle" id="dropdownMenuButton01" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                 <i class="ri-more-fill h4"></i>
                              </div>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton01">
                                 <a class="dropdown-item" href="#"><i class="ri-eye-fill me-2"></i>View</a>
                                 <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill me-2"></i>Delete</a>
                                 <a class="dropdown-item" href="#"><i class="ri-pencil-fill me-2"></i>Edit</a>
                                 <a class="dropdown-item" href="#"><i class="ri-printer-fill me-2"></i>Print</a>
                                 <a class="dropdown-item" href="#"><i class="ri-file-download-fill me-2"></i>Download</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <ul class="suggested-page-story m-0 p-0 list-inline">
                           <li class="mb-3">
                              <div class="d-flex align-items-center mb-3">
                                 <img src="assets/images/page-img/42.png" alt="story-img" class="rounded-circle img-fluid avatar-50">
                                 <div class="stories-data ms-3">
                                    <h5>Iqonic Studio</h5>
                                    <p class="mb-0">Lorem Ipsum</p>
                                 </div>
                              </div>
                              <img src="assets/images/small/img-1.jpg" class="img-fluid rounded" alt="Responsive image">
                              <div class="mt-3"><a href="#" class="btn d-block"><i class="ri-thumb-up-line me-2"></i> Like Page</a></div>
                           </li>
                           <li class="">
                              <div class="d-flex align-items-center mb-3">
                                 <img src="assets/images/page-img/42.png" alt="story-img" class="rounded-circle img-fluid avatar-50">
                                 <div class="stories-data ms-3">
                                    <h5>Cakes & Bakes </h5>
                                    <p class="mb-0">Lorem Ipsum</p>
                                 </div>
                              </div>
                              <img src="assets/images/small/img-2.jpg" class="img-fluid rounded" alt="Responsive image">
                              <div class="mt-3"><a href="#" class="btn d-block"><i class="ri-thumb-up-line me-2"></i> Like Page</a></div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 text-center">
                  <img src="assets/images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
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