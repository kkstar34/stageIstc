<?php 
include('functions.php');

	if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}

    if (isset($_GET['attribuer'])) {
		$id=$_GET['attribuer'];
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
	  			<h2 align="center"> Attributions </h2>
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
	  			<input type="hidden" name="id_user" value="<?php echo $user['id_user']?>">

	  			<div class="form-group row">
					<label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="identifiant" placeholder="identifiant" name="identifiant"  value="<?php echo $user['identifiant'] ;?>" readonly>
					</div>
				</div>

	  			<div class="form-group row">
					<label for="nom" class="col-sm-2 col-form-label">Nom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nom" placeholder="Name" name="nom"  value="<?php echo$user['nom_employe']  ;?>" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="<?php echo $user['prenom'] ;?>" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label for="materiel" class="col-sm-2 col-form-label">Matériel</label>
					<div class="col-sm-10">
						<select class="form-control" name="materiel">
							<option value="">Choisir un matériel...</option>
							<?php while($mat=$materiels->fetch()):?>
								<option value="<?php echo $mat['id']?>"><?php echo $mat['type_mat'];?></option>
							<?php endwhile?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="bureau" class="col-sm-2 col-form-label">Bureau</label>
					<div class="col-sm-10">
						<select class="form-control" name="bureau">
							<option value="">Choisir un bureau...</option>
							<?php while($bur=$bureaux->fetch()):?>
								<option value="<?php echo $bur['id_bureau']?>"><?php echo $bur['nom_bureau'];?></option>
							<?php endwhile?>
					
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="service" class="col-sm-2 col-form-label">Service</label>
					<div class="col-sm-10">
						<select class="form-control" name="service">
							<option value="">Choisir un service...</option>
						 
							<?php while($serv=$services->fetch()):?>
								<option value="<?php echo $serv['id_service']?>"><?php echo $serv['nom_service'];?></option>
							<?php endwhile?>
						
						</select>
					</div>
				</div>
				
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success" name="attribuer">Attribuer</button>
				</div>
			</form>

				
		</div>
	</div>
	
	</div>

	<?php require("../footer/footer.php"); ?>
   </body>
</html>