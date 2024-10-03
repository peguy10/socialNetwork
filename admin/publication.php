<?php 
	require 'inc/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>Creator network</title>
	<style>
		.like{
			font-size:25px;
			color:red;
		}
		.comment{
			font-size:25px;
			color:#03bafc;
		}
		a{
			color:#000;
		}
		.button{
			border:none;
			padding:10px;
			background:transparent;
			color:red;
			font-size:20px;
		}
	</style>
</head>
<body>


	<!-- SIDEBAR -->
		<?php include('inc/nav.php');?>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<!-- <label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a> -->
			<a href="#" class="profile">
				<img src="<?php echo $_SESSION['photo'];?>">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Publications</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Publications</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="../creer_contenu.php" class="btn-download">
                <i class='bx bx-plus' ></i>
					<span class="text">Ajouter un contenu </span>
				</a>
			</div>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Mes publications</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Publications</th>
								<th>Date</th>
								<th><i class='bx bxs-message-rounded-dots comment'></i></th>
								<th><i class='bx bxs-like like' ></i></th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($contents as $content) {?>
									<tr>
											<td>
													<img src="<?php echo $content['image'];?>">
												<a href="../">
													<p><?php echo substr($content['description'], 0, 100);?>... </p>
												</a>
											</td>
											<td><?php echo $content['date_creation'];?></td>
											<td><?php echo $content['nombre_commentaires'];?></td>
											<td><?php echo $content['nombre_likes'];?></td>
											<td>
                                                
                                                <form method="post" action="">
                                                    <input type="hidden" name="contenu_id" value="<?php echo htmlspecialchars($contenu['id']); ?>">
                                                    <button type="submit" name="supprimer" class="button"><i class='bx bx-trash' ></i></button>
                                                </form>
                                            </td>
									</tr>
							<?php }?>
							
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>