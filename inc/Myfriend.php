       <?php
    // Fonction pour récupérer les demandes d'amitié émises par l'utilisateur
      function recupererDemandesEmises($pdo, $id_utilisateur) {
         $sql = "SELECT d.*,photo, id_user, u.nom AS nom_destinataire 
               FROM demandes_amitie d 
               JOIN createurs u ON d.id_destinataire = u.id_user 
               WHERE d.id_demandeur = :id_utilisateur";
         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      // Récupérer les demandes d'amitié émises par l'utilisateur connecté
      $demandes_emises = recupererDemandesEmises($pdo, $_SESSION['user_id']);
       ?>
      <div class="right-sidebar-mini right-sidebar">
           <div class="right-sidebar-panel p-0">
              <div class="card shadow-none">
                 <div class="card-body p-0">
                    <div class="media-height p-3" data-scrollbar="init">
                     <?php if (count($demandes_emises) > 0): ?>
                        <?php foreach ($demandes_emises as $demande): ?>
                           <div class="d-flex align-items-center mb-4">
                              <div class="iq-profile-avatar status-online">
                                 <img class="rounded-circle avatar-50" src="<?php echo $demande['photo'];?>" alt="">
                              </div>
                              <div class="ms-3">
                                 <h6 class="mb-0"><?php echo htmlspecialchars($demande['nom_destinataire']); ?></h6>
                                 <p class="mb-0"><?php echo htmlspecialchars($demande['statut']); ?></p>
                                 <a href="sms.php?id=<?php echo $demande['id_user'];?>" class="btn btn-primary border-0 "><i class="ri-chat-3-line"></i></a>
                              </div>
                           </div>
                        <?php endforeach; ?>
                     <?php else: ?>
                        <p>Aucune demande d'amitié émise.</p>
                     <?php endif; ?>
                    </div>
                    <div class="right-sidebar-toggle bg-primary text-white mt-3">
                       <i class="ri-arrow-left-line side-left-icon"></i>
                       <i class="ri-arrow-right-line side-right-icon"><span class="ms-3 d-inline-block">Close Menu</span></i>
                    </div>
                 </div>
              </div>
           </div>
      </div>