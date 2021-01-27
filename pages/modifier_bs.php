<?php 
include('functions.php');

	if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}

    if (isset($_GET['modifier'])) {
		$id=$_GET['modifier'];
		if (!empty($id) AND is_numeric($id)) {
			$user = $db->prepare("SELECT * FROM employe WHERE id_user=?");
			$user->execute(array($id));
			$user = $user->fetch();
			
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
	  			<h2 align="center">Modifer bureau et service : </h2>
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
	  			<input type="hidden" name="id_user" value="<?php echo ""?>">
	  			<div class="form-group row">
					<label for="nom" class="col-sm-2 col-form-label">Nom du bureau</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="bureau" placeholder="bureau" name="bureau"  value="<?php echo "" ;?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="prenom" class="col-sm-2 col-form-label">Nom service</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="service" placeholder="service" name="service" value="<?php echo "";?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="prenom" class="col-sm-2 col-form-label">Localisation</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="localisation" placeholder="localisation" name="localisation" value="">
					</div>
				</div>

				
				<div class="form-group">
					<button type="submit" class="btn btn-success" name="update">Update</button>
				</div>
			</form>

				
		</div>
	</div>
	
	</div>

	<?php require("../footer/footer.php"); ?>
   </body>
</html>