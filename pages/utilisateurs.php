<?php 	
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['erreur'] = "veuillez vous connecter d'abord";
	header('location: ../index.php');
}

    //jointure entre plusieurs tables pour faire sortir des infos relatifs a la session de l'utilisateur connecté
    $employe = $db->query("SELECT * FROM employe,fonction,travail,bureau,occupe,service WHERE employe.id_fonc=fonction.id AND employe.id_user=travail.id_user AND travail.id_bureau=bureau.id_bureau AND employe.id_user=occupe.id_user AND occupe.id_service=service.id_service AND bureau.id_bureau=service.id_bureau AND employe.id_user= '".$_SESSION['id_user']."' ");

    $materiels = $db->query("SELECT * FROM employe,affecter,materiel WHERE employe.id_user = affecter.id_user AND affecter.id_mat = materiel.id  AND employe.id_user= '".$_SESSION['id_user']."' ");

     if (isset($_GET['supprime'])) {
		$id=$_GET['supprime'];
		if (!empty($id) AND is_numeric($id)) {
			$db->query("DELETE FROM incident WHERE id_incident=$id");
			header("Location: utilisateurs.php?id=".$_SESSION['id']);
		}
    }
    
?>


<!-- corps de la page de l'utilisateurs  -->
<!doctype html>
<html lang="en">
	<?php require("../header/header.php"); ?>

<body>
	<!-- recupération dans la base de données des materiels assigner à l'utilisateur qui se connecte -->
	<?php require("../nav/nav_User.php"); ?>
	<div class="row">
		<div class="col-sm-8">
			<div class="container">
				<h3 align="center">La liste de mon matériel</h3>
		<table class="table table-sm mt-3">
			<thead class="table-dark">
				<tr>
					<td scope="col">N° de série</td>
					<td scope="col">Type</td>
					<td scope="col">Mise en service</td>
					<td scope="col">Date d'affectation</td>
					<td scope="col"></td>
				</tr>
			</thead>
			<tbody class="table-secondary">
				<?php while($mat = $materiels->fetch()):?>
					<tr>
						<td><?php echo $mat['n_serie']?></td>
						<td><?php echo $mat['type_mat']?></td>
						<td><?php echo $mat['date_mise_service']?></td>
						<td scope="col"><?php echo $mat['date_affectation']?></td>

						<!-- envoi d'une demande de reparation à partir de demande.php à l'admin -->
						<td><a href="demande.php?id_mat=<?php echo $mat['id_mat']?>" role="button" class="btn btn-primary" name="demande">Demande de reparation</a></td>
					</tr>
				<?php endwhile ?>
			</tbody>
		</table>

			</div>
			
		</div>

		<div class="col-sm-4">
			<div class="container">
				<h3 align="center">Informations personnelles</h3>
		<table class="table table-sm mt-3">
			<thead class="table-dark">
				<tr>
					<td scope="col">Bureau</td>
					<td scope="col">Service</td>
					<td scope="col">Fonction</td>
				</tr>
			</thead>
			<tbody class="table-secondary">
				<?php while($emp = $employe->fetch()):?>
					<tr>
						<td><?php echo $emp['nom_bureau']?></td>
						<td><?php echo $emp['nom_service']?></td>
						<td scope="col"><?php echo $emp['nom_fonction']?></td>
					</tr>
				<?php endwhile ?>
			</tbody>
		</table>
			</div>
			
		</div>
		
	</div>



<!-- jointure entre différentes tables pour la recupération des demandes faites par l'utilisateurs -->
<?php
	$demande_en_cours = $db->query("SELECT * FROM employe,incident,materiel,signale WHERE employe.id_user=signale.id_user AND signale.id_incident=incident.id_incident AND incident.id_incident=materiel.id_incident AND employe.id_user='".$_SESSION['id_user']."' ");
?>

	<div class="row">
		<div class="col-sm-8">
			<div class="container">
				<h3 style="color: red">Demandes de reparation</h3>
				<table class="table table-sm mt-3">
					<thead class="table-danger">
						<tr>
							<td scope="col">N° de série</td>
							<td scope="col">Type de matériel</td>
							<td scope="col">Date d'enregistrement</td>
							<td scope="col">Etat</td>
							<td scope="col"></td>
						</tr>
					</thead>
					<tbody class="table-secondary">
						<?php while($dem = $demande_en_cours->fetch()):?>
							<?php 
								$intervention = $db->query("SELECT * FROM intervention where id ='".$dem['id_inter']."'");
								$i = $intervention->fetch();

								//recupération des états à partir de la jointure
								$etat=$db->query("SELECT * FROM etat WHERE id='".$i['id_etat']."'");
								$e=$etat->fetch();

								$incident = $db->query("SELECT * FROM incident");
								$inc=$incident->fetch();
							?>
							<tr>
								<td><?php echo $dem['n_serie']?></td>
								<td><?php echo $dem['type_mat']?></td>
								<td><?php echo $dem['date_enregistrement']?></td>

								<!-- condition pour le changement d'état du matériel dont on faire une demande de réparation -->
								<?php if(!empty($e)):?>
									<td><?php echo $e['libelle'];?></td>
									<td><a href="#" ><i class="menu-icon fa fa-search"></i></a></td>
								<?php else:?>
									<td>Pas encore traité</td>
									<td><a href="utilisateurs.php?supprime=<?php echo $inc['id_incident']?>" class="btn btn-danger" onclick="return confirm('Etes-vous sûr de vouloir supprimer?');">Annulation</a></td>
								<?php endif ?>
							</tr>
						<?php endwhile?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<?php require("../footer/footer.php"); ?>
</body>
</html>