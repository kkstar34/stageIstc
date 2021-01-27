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
	  			<h2 align="center">Modifer L'utilisateur : </h2>
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
					<label for="nom" class="col-sm-2 col-form-label">Nom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nom" placeholder="Name" name="nom"  value="<?php echo $user['nom_employe'] ;?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="prenom" placeholder="Firstname" name="prenom" value="<?php echo $user['prenom'];?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
					<div class="col-sm-10">
						<select class="form-control" name="fonction">
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
							<?php while($grade= $grades->fetch()) :?>
							<option value="<?php echo $grade['id'] ?>"><?php echo $grade['nom_grade'];?></option>
						<?php endwhile ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="id" placeholder="email" name="email" value="<?php echo $user['email'] ;?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">Identifiant</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="id" placeholder="Identifiant" name="identifiant" value="<?php echo $user['identifiant'] ;?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="fonction" class="col-sm-2 col-form-label">Role</label>
					<div class="col-sm-10">
						<select class="form-control" name="role">
                        <option value="user">Utilisateur</option>
							<option value="admin">Admin</option>

						</select>
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
