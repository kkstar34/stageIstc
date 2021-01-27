<?php include('functions.php');//connexion à la base de données istc_bd


if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}
$materiels = $db->query("SELECT * FROM materiel");

 if(isset($_POST['search'])){
 	$search = $_POST['search'];
 	$materiels = $db->query("SELECT * FROM materiel WHERE type_mat LIKE '".$search."%' ");
 }

if (isset($_GET['supprime'])) {
		$id=$_GET['supprime'];
		if (!empty($id) AND is_numeric($id)) {
			$db->query("DELETE FROM materiel WHERE id=$id");

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
	 	<a href="ajout_materiel.php" class="btn btn-success mt-3 float-right">Ajouter</a>
	 	<div class="clearfix">
	 	</div>
	 	<table class="table table-sm mt-3 table-bordered table-striped">
			<thead class="table-dark">
				<tr>
					<td scope="col">N° de série</td>
					<td scope="col">Type de matériel</td>
					<td scope="col">Date de mise en service</td>
					<td scope="col"></td>
				</tr>
			</thead>
			<tbody class="">
				<?php while ($mat=$materiels->fetch()):?>
				<tr>
					<td><?php echo $mat['n_serie']; ?></td>
					<td><?php echo $mat['type_mat']; ?></td>
					<td><?php echo $mat['date_mise_service']; ?></td>
					<td align="center">
						<span>
							<a href="modifier_materiel.php" " class="btn btn-warning">Modifier</a>	
							<a href="page_info.php?supprime=<?php echo ""?>" class="btn btn-danger " onclick="return confirm('Etes-vous sûr de vouloir supprimer?')"><i class="fas fa-trash-alt"></i> Supprimer</a>
						</span>
					</td>
				</tr>
				<?php endwhile?>
			</tbody>
		</table>
	 	
	 </div>

	 <?php require("../footer/footer.php"); ?>
</body>
</html>