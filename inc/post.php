<?php
    // Récupérer le contenu avec les tags
    // $sql = "SELECT c.id, c.type, c.description, c.image, c.video, c.date_creation, u.nom, u.photo AS utilisateur_nom, 
    // GROUP_CONCAT(t.nom SEPARATOR ', ') AS tags
    // FROM contenus c
    // JOIN createurs u ON c.utilisateur_id = u.id_user
    // LEFT JOIN contenu_tags ct ON c.id = ct.contenu_id
    // LEFT JOIN tags t ON ct.tag_id = t.id
    // GROUP BY c.id
    // ORDER BY c.date_creation DESC";

    // $sql =" SELECT C.id, c.type, c.description, c.image, c.video, c.date_creation, u.nom, u.photo FROM createurs U, contenus C, contenu_tags CT, tags T 
    //         WHERE C.utilisateur_id = U.id_user
    //         AND C.id = CT.contenu_id
    //         AND CT.tag_id = T.id
    //         GROUP BY C.id
    //         ORDER BY C.date_creation DESC";
            
    function userLiked($contenu_id) {
        global $pdo;
        $utilisateur_id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM likes WHERE contenu_id = ? AND utilisateur_id = ?");
        $stmt->execute([$contenu_id, $utilisateur_id]);
        return $stmt->fetch() !== false;
    }
    
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
        GROUP BY c.id, u.nom
        ORDER BY c.date_creation DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $contenus = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
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
                            <div class="card-post-toolbar">
                                <div class="dropdown">
                                <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                <i class="ri-more-fill"></i>
                                </span>
                                <div class="dropdown-menu m-0 p-0">
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <div class="h4">
                                            <i class="ri-save-line"></i>
                                            </div>
                                            <div class="data ms-2">
                                            <h6>Save Post</h6>
                                            <p class="mb-0">Add this to your saved items</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <i class="ri-close-circle-line h4"></i>
                                            <div class="data ms-2">
                                            <h6>Hide Post</h6>
                                            <p class="mb-0">See fewer posts like this.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <i class="ri-user-unfollow-line h4"></i>
                                            <div class="data ms-2">
                                            <h6>Unfollow User</h6>
                                            <p class="mb-0">Stop seeing posts but stay friends.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <i class="ri-notification-line h4"></i>
                                            <div class="data ms-2">
                                            <h6>Notifications</h6>
                                            <p class="mb-0">Turn on notifications for this post</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                </div>
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