<?php include('functions.php');

	if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}

if (isset($_POST['send1'])) {
	$serie = htmlspecialchars($_POST['n_serie']);
	$type_mat = htmlspecialchars($_POST['type_mat']);

	if (!empty($serie) AND !empty($type_mat)) {
		$insertMAT = $db->prepare("INSERT INTO materiel (n_serie, type_mat, date_mise_service) VALUES(?, ?, NOW())");
		$insertMAT->execute(array($serie,$type_mat));
		header("location : page_info.php");
	}
}



?>

<!doctype html>
<html lang="en">
  <?php require("../header/header.php"); ?>

<body>
	<?php require("../nav/nav_Inscrit.php"); ?>

	<div class="container px-lg-5 mt-5">
	  	<div class="card-header">
		  	<form method="post" action="">
		  		<h2 align="center">Ajout de matériels : </h2>
				<?php echo display_error(); ?>
				<div class="content">
					<!-- notification message -->
					<?php if (isset($_SESSION['success'])) : ?>
						<div class="error success" >
							<h3>
								<?php 
									echo $_SESSION['success']; 
									unset($_SESSION['success']);
								?>
							</h3>
						</div>
					<?php endif ?>
		  			<?php echo display_error(); ?>

		  			<div class="form-group row">
						<label for="serie" class="col-sm-2 col-form-label">N° série</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="serie" placeholder="serie" name="serie"  value="<?php echo "" ?>">
						</div>
					</div>

					<div class="form-group row">
						<label for="type_mat" class="col-sm-2 col-form-label">Type matériel</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="service" placeholder="type_mat" name="type_mat" value="<?php echo ""?>">
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="send1">Envoyez</button>
						<button type="reset" class="btn btn-danger">Effacer</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php require("../footer/footer.php"); ?>
</body>
</html>