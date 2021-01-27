<?php 

	include('functions.php');
	if (!isAdmin()) {
	    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
	    header('location: ../index.php');
	}
	$bureaux = $db->query("SELECT * FROM bureau ORDER BY id_bureau DESC");

	if(isset($_POST['search'])){
	 	$search = $_POST['search'];
	 	$bureaux = $db->query("SELECT * FROM bureau WHERE nom_bureau LIKE '".$search."%' ");
	 }

	$services = $db->prepare("SELECT * FROM service where id_bureau=?");

	 if (isset($_GET['id_service'])) {
			$id=$_GET['id_service'];
			if (!empty($id) AND is_numeric($id)) {
	            $db->query("UPDATE service SET id_bureau=null WHERE id_service='".$id."' ");
	            $_SESSION['success'] = "suppression effectué avec success";
				header("Location: bureaux.php");
			}
	    }


?>

<!doctype html>
<html lang="en">
	<?php require("../header/header.php"); ?>

<body>
	 <?php  require("../nav/nav_Bureau.php"); ?>
	<div class="container-fluid">
	 	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	 		<form class="form-inline" action="" method="POST">
	 			<input type="search" name="search" class="form-control mr-sm-2" placeholder="rechercher">
	 			<button class="btn btn-success mr-1" type="submit"><i class="fas fa-search"></i></button>
	 		</form>
	 	</nav>

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

	 	<a href="ajout_bs.php" class="btn btn-success mt-3 float-right">Ajouter</a>
	 	<div class="clearfix"></div>

	 	<table class="table table-sm mt-3 table-bordered table-striped" >
			<thead class="table-dark" >
				<tr>
					<td scope="col" align="center">Nom du bureau</td>
					<td scope="col" align="center">Services</td>
					<td scope="col" align="center">Localisation</td>
				</tr>
			</thead>
			<tbody class="">
				<?php while ($b = $bureaux->fetch()):?>
					<?php
						$services->execute(array($b['id_bureau']));
					?>
					<tr>
						<td><?php echo $b['nom_bureau']?></td>

						<td>
							<?php while($serv=$services->fetch()):?>
								<div><?php echo $serv['nom_service']." "; ?><span class="float-right mt-2"><a type="button" role="button" href="bureaux.php?id_service=<?php echo $serv['id_service'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a><span></div><div class="clearfix"></div>

							<?php endwhile?>

	  						<br>
			  						 
			  				<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal<?php echo $b['id_bureau'];?>" data-whatever="@getbootstrap" ><i class="fas fa-plus-circle"></i></button>


	  						<div class="modal fade" id="exampleModal<?php echo $b['id_bureau'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  						  <div class="modal-dialog" role="document">
	  						    <div class="modal-content">
	  						      <div class="modal-header">
	  						        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Ajout services</h5>
	  						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  						          <span aria-hidden="true">&times;</span>
	  						        </button>
	  						      </div>
	  						      <form method="POST">
	  						      	<input type="hidden" name="id_bureau" value="<?php echo $b['id_bureau']?>">
	  						      <div class="modal-body">


	  						          <div class="form-group">
	  						            <label for="recipient-name" class="col-form-label">Service</label>
	  						            <div class="col-sm-10">
	  										<select class="form-control" name="id_service">
	  											<?php $services1 = $db->query("SELECT * FROM service") ?>
	  											<?php while($serv= $services1->fetch()) :?>
	  											<option value="<?php echo $serv['id_service'] ?>"><?php echo $serv['nom_service'];?></option>
	  										<?php endwhile ?>
	  										</select>
	  										<button class="btn btn-success float-right mt-2" type="button"><i class="fas fa-plus-circle"></i></button>
	  										<div class="clearfix"></div>
	  									</div>
	  						          </div>

	  						      </div>
	  						      <div class="modal-footer">
	  						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
	  						        <button type="submit" class="btn btn-primary" name="send_service_bureau">Envoyer</button>

	  						      </div>
	  						       </form>
	  						    </div>
	  						  </div>
	  						</div>

	  						</div><div class="clearfix"></div>
	  					</td>

						<td><?php echo $b['Localisation']; ?></td>		
					</tr>
				<?php endwhile?>
			</tbody>
		</table>
	 	
	</div>

	<!-- footer -->
	 <?php require("../footer/footer.php"); ?>
</body>
</html>