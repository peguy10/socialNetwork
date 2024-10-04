<?php 
	require 'inc/function.php';
	if ($_SESSION['role'] != 'admin') {
		header('location: mespublications.php');
	}
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
			<a href="#" class="nav-link"></a>
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="../" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Accueil</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo htmlspecialchars($statistiques['nombre_contenus']); ?></h3>
						<p>Publications</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo htmlspecialchars($statistiques['nombre_createurs']); ?></h3>
						<p>Createurs</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-message-rounded-dots'></i>
					<span class="text">
						<h3><?php echo htmlspecialchars($statistiques['nombre_commentaires']); ?></h3>
						<p>commentaires</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>publication recentes</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Publications</th>
								<th>Date</th>
								<th>Auteurs</th>
								<th><i class='bx bxs-message-rounded-dots comment'></i></th>
								<th><i class='bx bxs-like like' ></i></th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($derniers_contenus as $content) {?>
									<tr>
											<td>
													<img src="<?php echo $content['image'];?>">
												<a href="../">
													<p><?php echo substr($content['description'], 0, 50);?>... </p>
												</a>
											</td>
											<td><?php echo $content['date_creation'];?></td>
											<td><?php echo $content['nom_utilisateur'];?></td>
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