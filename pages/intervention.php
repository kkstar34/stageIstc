<?php
	include('functions.php');//connexion à la base de données istc_bd


if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}

	//jointure entre différentes tables pour la recupératon de l'incident faites par l'utilisateur qui l'a émis dans le champs intervention
	$demande = $db->query("SELECT * FROM employe,incident,materiel,signale,bureau,travail WHERE employe.id_user=signale.id_user AND signale.id_incident=incident.id_incident AND incident.id_incident=materiel.id_incident AND employe.id_user=travail.id_user AND travail.id_bureau=bureau.id_bureau");

	if(isset($_POST['search'])){
 	$search = $_POST['search'];
 	$demande = $db->query("SELECT * FROM employe,incident,materiel,signale,bureau,travail WHERE employe.id_user=signale.id_user AND signale.id_incident=incident.id_incident AND incident.id_incident=materiel.id_incident AND employe.id_user=travail.id_user AND travail.id_bureau=bureau.id_bureau LIKE '".$search."%' ");;
 }
	

	if (isset($_GET['formintervention'])) {
		$et=htmlspecialchars($_GET['ETAT']);

		if(isset($_GET['id_incident'])){
			$id_demande = intval($_GET['id_incident']);
			$demande_en_cours = $db->query("SELECT * FROM employe,incident,materiel,signale WHERE employe.id_user=signale.id_user AND signale.id_incident=incident.id_incident AND incident.id_incident=materiel.id_incident  AND incident.id_incident='".$id_demande."'");

			$demandeinfo = $demande_en_cours->fetch();
			$id_user = $demandeinfo['id_user'];
			$date_enregistrement = $demandeinfo['date_enregistrement'];
			$serie = $demandeinfo['n_serie'];
			header("Location:intervention.php");
		}else{
			$id_demande = "";
		}

			if (!empty($et)) {
				$demande = $db->prepare("INSERT INTO intervention(id_user,id_etat,date_reception,date_retour) VALUES(?,?,?,NOW()) ");
				$demande->execute(array($id_user, $et, $date_enregistrement));
				$id_inter = $db->lastInsertId();
				$db->query("UPDATE materiel SET id_inter=$id_inter WHERE  n_serie='".$serie."' ");
				$_SESSION['etat']=true;
		
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
	 			<input type="text" name="search" class="form-control mr-sm-2" placeholder="rechercher">
	 			<button class="btn btn-success mr-1" type="submit"><i class="fas fa-search"></i></button>
	 		</form>
	 	</nav>
	 	<table class="table table-sm mt-3 table-bordered table-striped">
			<thead class="table-dark">
				<tr>
					<td scope="col">Utilisateurs</td>
					<td scope="col">Bureau</td>
					<td scope="col">Type de matériel</td>
					<td scope="col">Description</td>
					<td scope="col">Etat</td>
					<td scope="col">Date de demande</td>
					<td scope="col"></td>
				</tr>
			</thead>
			
			<tbody class="">
				<?php while($dem=$demande->fetch()):?>
					<?php $etat = $db->query("SELECT * FROM etat ");?>
					<tr>
						<td><?php echo $dem['prenom'];?></td>
						<td><?php echo $dem['nom_bureau'];?></td>
						<td><?php echo $dem['type_mat'];?></td>
						<td><?php echo $dem['description_incident'];?></td>
						<!-- formulaire de validation de l'intervention reglé, en cours ou pas encore traité -->
						<form method="GET">
							<td>
								<!-- recupération des états insérer dans la bd -->
								<?php while ($e=$etat->fetch()):?>
								<input type="radio" name="ETAT" value="<?php echo $e['id'] ?>" required/> 
									<label for="etat"><?php echo $e['libelle'] ?></label>
								<?php endwhile?>
								<!-- fin de récupération des états -->
								<input type="hidden" name="id_incident" value="<?php echo $dem['id_incident'] ?>">
							</td>
							<td><?php echo $dem['date_enregistrement']?></td>
							<td align="center">
								<span>
									<div class="form-group">
	                					<input type="submit" name="formintervention" class="btn btn-success"  value="Valider">
	             			 		</div>	
								</span>
							</td>
						</form>
						<!-- fin de la validation -->
					</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	 </div>

	 <!-- footer -->
	 <?php require("../footer/footer.php"); ?>
</body>
</html>