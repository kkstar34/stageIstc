<?php
	include('functions.php');

	$id_mat = intval($_GET['id_mat']);//recupération de l'id du matériel dans l'URL
    $reqmat = $db -> prepare ('SELECT * FROM materiel WHERE id = ?');
    $reqmat -> execute (array($id_mat));
    $matinfo = $reqmat->fetch();
    //on recupère le matériel sur lequel on veut faire la reparation à partir de sa série
    $serie = $matinfo['n_serie'];
    $id_user = $_SESSION['id_user'];

    //Recupération des infos entrer dans le formulaire de description
    if (isset($_POST['formdemande'])) {
    	$descr=htmlspecialchars($_POST['description']);

    	if (!empty($descr)) {
    		$send_notification = $db->prepare("INSERT INTO notifications(sujet, id_user) VALUES (?,?)");
    		$send_notification->execute(array($descr,$id_user));
    		$send = $db->prepare("INSERT INTO incident(description_incident, date_enregistrement) VALUES (?,NOW()) ");
    		$send->execute(array($descr));
    		$id_incident = $db->lastInsertId();//fonction recupérant l'id de la table dont on vient de faire une insertion à l'intérieur


    		//mise à jour de la table matériel avec l'insertion des id des tables incident et intervention 
    		$mat = $db->query("UPDATE materiel SET id_incident = $id_incident WHERE n_serie='".$serie."' ");
    		$mat = $db->query("UPDATE materiel SET id_inter = '' WHERE n_serie='".$serie."' ");
    		
    		$materiel = $db->prepare("INSERT INTO incident(description_incident, date_enregistrement) VALUES (?,NOW()) ");
    		$send->execute(array($descr));

    		//liaison d'un employé à l'incident qu'il a emis
    		$signal = $db->prepare("INSERT INTO signale(id_incident,id_user) VALUES (?,?)");
    		$signal->execute(array($id_incident,$id_user));
    		$success = "Demande enregistré avec succès";
    	}
    }

?>


<!doctype html>
<html>
	<?php require("../header/header.php"); ?>

<body>
<?php require("../nav/nav_User.php"); ?>
	
	<div class="container">
		<div class="row">
			<div class="col">
				<h4>Demande de réparation pour : <?php echo '<b>'.$matinfo['type_mat'].'</b>' . ' de serie '. $matinfo['n_serie'] ; ?></h4>
			</div>
			<div class="w-100"></div>
			<div class="col">
				<h4>Description : </h4>
				<form method="POST" action="">
					<div class="form-group">
						<textarea class="form-control" rows="3" id="description" name="description" ></textarea>
						
						<div class="content mt-3">
				            <div class="col-sm-12">
				            	<?php if(isset($success)):?>
				                <div class="alert  alert-success alert-dismissible fade show" role="alert">
				                    <span class="badge badge-pill badge-success">Success</span> <?php echo $success ;?>;
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                        <span aria-hidden="true">&times;</span>
				                    </button>
				                </div>
				            <?php endif ?>
				            </div>
       					</div>

       					<div class="form-group">
                			<input type="submit" name="formdemande" class="btn btn-info mt-2"  value="Envoyer">
             			</div>       			
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php require("../footer/footer.php"); ?>
</body>
</html>