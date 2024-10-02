<?php
     include('friendfunction.php');
?>
<li class="nav-item dropdown">
    <a href="#" class="dropdown-toggle" id="group-drop" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="ri-group-line"></i></a>
    <div class="sub-drop sub-drop-large dropdown-menu" aria-labelledby="group-drop">
            <div class="card shadow-none m-0">
                    <div class="card-header d-flex justify-content-between bg-primary">
                <div class="header-title">
                <h5 class="mb-0 text-white">Demande d'amitié</h5>
                </div>
                <small class="badge  bg-light text-dark ">4</small>
            </div>
            <div class="card-body p-0">
                <?php
                    $demandes = recupererDemandesAmitie($pdo, $_SESSION['user_id']);
                    foreach ($demandes as $demande) {?>
                        <div class="iq-friend-request">
                            <div
                                class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                        <img class="avatar-40 rounded" src="<?php echo $demande['photo'];?>"
                                            alt="">
                                    <div class="ms-3">
                                        <h6 class="mb-0 "><?php echo $demande['nom_demandeur'];?></h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="../scripts/friendaccept.php?id=<?php echo $demande['id']?>" class="me-3 btn btn-primary rounded">Confirmer</a>
                                    <a href="../scripts/friendcancel.php?id=<?php echo $demande['id']?>" class="me-3 btn btn-secondary rounded">Supprimer</a>
                                </div>
                            </div>
                        </div>
                        
                <?php }?>
                <div class="text-center">
                    <a href="#" class=" btn text-primary">Voir plus</a>
                </div>
            </div>
        </div>
    </div>
    </li>