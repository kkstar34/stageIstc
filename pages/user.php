<?php include('functions.php');//connexion à la base de données istc_bd


	if (!isAdmin()) {
	    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
	    header('location: ../index.php');
	}
	//$info = $db->query("SELECT * FROM employe,bureau,service,travail,occupe WHERE employe.id_user=travail.id_user AND travail.id_bureau=bureau.id_bureau AND employe.id_user=occupe.id_user AND occupe.id_service=service.id_service ");
	$info = $db->query("SELECT * FROM employe,grade,fonction WHERE employe.id_fonc=fonction.id AND employe.id_grade=grade.id");

	if (isset($_GET['supprime'])) {
		$id=$_GET['supprime'];

		if (!empty($id) AND is_numeric($id)) {
			$db->query("DELETE FROM employe WHERE id_user=$id");

		}
	}

	if(isset($_POST['search'])){
	 	$search = $_POST['search'];
	 	$info = $db->query("SELECT * FROM employe,grade,fonction WHERE employe.id_fonc=fonction.id AND employe.id_grade=grade.id AND employe.nom_employe LIKE '".$search."%' ");
	}

	if(isset($_POST['submit_sup'])){
	 	if(isset($_POST['user'])){
	 		foreach ($_POST['user'] as $user ) {
	 		$db->query("DELETE FROM employe WHERE id_user=$user");
	 	}
	}

}?>



<!doctype html>
<html lang="en">

	<?php require("../header/header.php"); ?>
	<link rel="stylesheet" href="/Stage_ISTC/pages/assets/css/tableexport.min.css">


<body>
	 <?php  require("../nav/nav_Bureau.php"); ?>
	 <div class="container-fluid">

	 	<div class="bg-dark py-2 pl-2">
	 				<a href="inscri_admin.php"  class="btn btn-success "><i class="fas fa-plus-circle"></i> Ajouter</a>
	 		<form class="form-inline float-right" action="" method="post">
	 			<input type="text" name="search" class="form-control mr-sm-2" placeholder="rechercher">
	 			<button class="btn btn-success mr-1" type="submit"><i class="fas fa-search"></i></button>
	 		</form>
	 		<div class="clearfix"></div>
	 		
	 	</div>

	 	<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];

					?>
				</h3>
			</div>
		<?php endif ?>
	 
	 	</div>

	 	<table class="table table-sm mt-3 table-bordered table-striped" id="export">
			<thead class="table-dark">
				<tr>
                    <td><-T-></td>
					<td scope="col">Nom</td>
					<td scope="col">Prénom</td>
					<td scope="col">Identifiant</td>
					<td scope="col">Email</td>
					<td scope="col">Fonction</td>
					<td scope="col">Grade</td>

					<td scope="col" align="center">Action</td>
				</tr>
			</thead>
			<tbody class="">

				<?php while($i = $info->fetch()):?>
					<tr>
                        <td>
                        <?php if($i['role']==='admin'):?>

                        <?php else:?>
                        <form method="POST">
                            <input type="checkbox" name="user[]" class="form-control" value="<?php echo $i['id_user']?>">
                       
                        <?php endif?>
                    </td>
						<td><?php echo $i['nom_employe'];?></td>
						<td><?php echo $i['prenom'];?></td>
						<td><?php echo $i['identifiant']?></td>
						<td><?php echo $i['email']?></td>
						<td><?php echo $i['nom_fonction'];?></td>
						<td><?php echo $i['nom_grade'];?></td>
						<td align="center">
							<span>
							<?php if($i['role']==='admin'):?>
							<button class="btn btn-success"><i class="fas fa-user-shield"></i></button>
							<?php else:?>
								<a href="modifier_utilisateurs.php?modifier=<?php echo $i['id_user']?>" class="btn btn-warning"><i class="fas fa-edit"></i>Modifier</a>
								<a href="user.php?supprime=<?php echo $i['id_user']?>" class="btn btn-danger " onclick="return confirm('Etes-vous sûr de vouloir supprimer?')"><i class="fas fa-trash-alt"></i> Supprimer</a>
							<?php endif?>
							</span>
						</td>
					</tr>
				<?php endwhile ?>
			</tbody>
		</table>
		

     </div>
     <button type="submit" class="btn btn-danger ml-2" name="submit_sup"><i class="fas fa-trash"></i>Supp</button>
      </form>

	 <?php require("../footer/footer.php"); ?>
</body>
<script src="/Stage_ISTC/pages/assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.3/cpexcel.js"></script>

<script src="/Stage_ISTC/pages/assets/js/tableexport.min.js"></script>
    <script src="/Stage_ISTC/pages/assets/js/FileSaver.min.js"></script>



<script type="text/javascript">
	$('table').tableExport();
</script>
</html>
