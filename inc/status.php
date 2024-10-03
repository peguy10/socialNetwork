<?php
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
?>
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
                                 <h5>Ajouter une storie</h5>
                                 <!-- <p class="mb-0">time to story</p> -->
                              </div>
                           </li>
                           <?php foreach ($utilisateurs as $utilisateur) {?>
                          
                          
                           <li class="d-flex mb-3 align-items-center active">
                              <img src="<?php echo $utilisateur['photo'];?>" alt="story-img" class="rounded-circle img-fluid">
                              <div class="stories-data ms-3">
                                 <h5><?php echo $utilisateur['nom'];?></h5>
                                 <p class="mb-0">1h</p>
                              </div>
                           </li>
                           
                           <?php  }?>
                        </ul>
                        <a href="#" class="btn btn-primary d-block mt-3">See All</a>
                     </div>
                  </div>