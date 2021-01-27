<!doctype html>
<html lang="en">
	<?php include('functions.php');

	if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}?>
  <?php require("../header/header.php"); ?>

  <body>
  	<?php require("../nav/nav_Inscrit.php"); ?>

  	<div class="container px-lg-5 mt-5">
  		<div class="card-header">
	  		<form method="post" action="">
	  			<h2 align="center">Ajout d'utilisateur : </h2>
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
					<label for="nom" class="col-sm-2 col-form-label">Nom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nom" placeholder="Name" name="nom"  value="<?php echo $nom ;?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="prenom" placeholder="Firstname" name="prenom" value="<?php echo $prenom;?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
					<div class="col-sm-10">
						<select class="form-control" name="fonction">
							<option value="">Choisir une fonction...</option>
							<?php while($fonction= $fonctions->fetch()) :?> 
							<option value="<?php echo $fonction['id'] ?>"><?php echo $fonction['nom_fonction'];?></option>
						<?php endwhile ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="grade" class="col-sm-2 col-form-label">Grade</label>
					<div class="col-sm-10">
						<select class="form-control" name="grade">
							<option value="">Choisir un grade...</option>
							<?php while($grade= $grades->fetch()) :?> 
							<option value="<?php echo $grade['id'] ?>"><?php echo $grade['nom_grade'];?></option>
						<?php endwhile ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="id" placeholder="email" name="email" value="<?php echo $email ;?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">Identifiant</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="id" placeholder="Identifiant" name="identifiant" value="<?php echo $identifiant ;?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="fonction" class="col-sm-2 col-form-label">Role</label>
					<div class="col-sm-10">
						<select class="form-control" name="role">
							<option value="">Choisir un role...</option>
						 
							<option value="admin">Admin</option>
							<option value="user">Utilisateur</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password_1">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Confirmer</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword2" placeholder="Confirmer" name="password_2">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="send">Envoyez</button>
					<button type="reset" class="btn btn-danger">Effacer</button>
				</div>
			</form>

				
		</div>
	</div>
	
	</div>

	<?php require("../footer/footer.php"); ?>
   </body>
</html>