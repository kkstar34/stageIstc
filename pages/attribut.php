<?php
include('functions.php');//connexion à la base de données istc_bd


if (!isAdmin()) {
    $_SESSION['erreur'] = "vous devriez etre connecté et admin";
    header('location: ../index.php');
}
    //pour le premier tableau
	$employe = $db->query("SELECT * FROM employe ");

  if(isset($_POST['search'])){
  $search = $_POST['search'];
  $employe = $db->query("SELECT * FROM employe WHERE nom_employe LIKE '".$search."%' ");
 }

    //pour le deuxieme tableau
	$employe1 = $db->query("SELECT * FROM employe ");
  $materiels = $db->prepare("SELECT * FROM materiel WHERE id = ?");
  $affecter = $db->prepare("SELECT * FROM affecter WHERE id_user = ?");

  $occuper = $db->prepare("SELECT * FROM occupe WHERE id_user = ?");
  $travailler = $db->prepare("SELECT * FROM travail WHERE id_user = ?");
  $services = $db->prepare("SELECT * FROM service WHERE id_service = ?");
  $bureaux = $db->prepare("SELECT * FROM bureau WHERE id_bureau = ?");
  //apres le modal
  $materiels2 = $db->prepare("SELECT * FROM materiel WHERE id = ?");
  $affecter1 = $db->prepare("SELECT * FROM affecter WHERE id_user = ?");

	if (isset($_GET['id_materiel']) AND isset($_GET['id_user'])) {
		$id=$_GET['id_materiel'];
		$id_user = $_GET['id_user'];

		if (!empty($id) AND is_numeric($id)) {
            $db->query("DELETE FROM affecter WHERE id_mat=$id AND id_user=$id_user");
            $_SESSION['success'] = "suppression effectué avec success";
			       header("Location: attribut.php");
		}
  }


  if (isset($_GET['id_bureau']) AND isset($_GET['id_user'])) {
    $id=$_GET['id_bureau'];
    $id_user = $_GET['id_user'];

    if (!empty($id) AND is_numeric($id)) {
            $db->query("DELETE FROM travail WHERE id_bureau=$id AND id_user=$id_user");
            $_SESSION['success'] = "suppression effectué avec success";
            header("Location: attribut.php");
    }
  }

  if (isset($_GET['id_service']) AND isset($_GET['id_user'])) {
		$id=$_GET['id_service'];
		$id_user = $_GET['id_user'];

		if (!empty($id) AND is_numeric($id)) {
            $db->query("DELETE FROM occupe WHERE id_service=$id AND id_user=$id_user");
            $_SESSION['success'] = "suppression effectué avec success";
			      header("Location: attribut.php");
		}
  }

?>


<!doctype html>
<html lang="en">
	<?php require("../header/header.php"); ?>

<body>
      <?php  require("../nav/nav_Bureau.php"); ?>
      <?php if(!empty($_SESSION['success'])):?>
               <div class="alert  alert-success alert-dismissible fade show" role="alert">
                   <span class="badge badge-pill badge-success">Bravo</span><?php echo $_SESSION['success']; ?>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                   </button>
               </div>
      <?php endif ?>

    <div class="row">
      <div class="col-sm-4">
        <div class="container">

          <h1><i class="fas fa-sitemap"></i> Gestion & Attribution</h1>
          <div class="table-responsive">
            <table class="table table-sm mt-3 table-bordered table-striped">
              <thead class="table-dark">
                <tr>
                  <td scope="col">Nom</td>
                  <td scope="col">Prénom</td>
                  <td scope="col">Identifiant</td>
                  <td scope="col">Action</td>
                </tr>
              </thead>

              <tbody class="">
                <?php while($em=$employe->fetch()):?>
                  <tr>
                    <td><?php echo $em['nom_employe'];?></td>
                    <td><?php echo $em['prenom'];?></td>
                    <td><?php echo $em['identifiant'];?></td>
                    <td>
                      <span>
                        <a href="modifier_attribut.php?attribuer=<?php echo $em['id_user'] ?>" class="btn btn-info"><i class="fas fa-plus-circle"></i> New attribution</a>
                      </span>
                    </td>
                  </tr>
                <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-sm-8">
        <div class="container">
	 	      <nav class="navbar navbar-expand-sm bg-dark navbar-dark float-right">
	 		      <form class="form-inline " action="" method="POST">
	 			      <input type="text" name="search" class="form-control mr-sm-2" placeholder="rechercher">
	 			      <button class="btn btn-success mr-1" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <div class="clearfix"></div>
	 	      </nav>

          <div class="clearfix"></div>

          <div class="table-responsive">
	 	        <table class="table table-sm mt-3 table-bordered table-striped">
			        <thead class="table-dark">
				        <tr>
        					<td scope="col">Nom</td>
        					<td scope="col">Prénom</td>
        					<td scope="col">Matériel</td>
        					<td scope="col">N° de série</td>
        					<td scope="col" align="center">Bureau</td>
        					<td scope="col" align="center">Service</td>
				        </tr>
			        </thead>

			        <tbody class="">
				        <?php while($em1=$employe1->fetch()):?>
					        <?php
                    $affecter->execute(array($em1['id_user']));
                    $affecter1->execute(array($em1['id_user']));
                    $occuper->execute(array($em1['id_user']));
                    $travailler->execute(array($em1['id_user']));
					        ?>
					      <tr>
						      <td><?php echo $em1['nom_employe'];?></td>
						      <td><?php echo $em1['prenom'];?></td>
                  <td>
                    <?php while($affec=$affecter->fetch()):?>
  							      <?php
                      
  							        var_dump($materiels->execute(array($affec['id_mat'])));
  							      ?>

  							      <?php while($mat=$materiels->fetch()):?>
  								      <div><?php echo $mat['type_mat']." "; ?><span class="float-right mt-2"><a type="button" role="button" href="attribut.php?id_materiel=<?php echo $mat['id'] ;?>&id_user=<?php echo $em1['id_user'] ;?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a><span></div><div class="clearfix"></div>
                      <?php endwhile?>
                    <?php endwhile?>
  						      <br>

  				          <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal<?php echo $em1['id_user'];?>" data-whatever="@getbootstrap" ><i class="fas fa-plus-circle"></i></button>

  						      <div class="modal fade" id="exampleModal<?php echo $em1['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						        <div class="modal-dialog" role="document">
  						          <div class="modal-content">

  						            <div class="modal-header">
  						              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Ajout matériel</h5>
  						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						                <span aria-hidden="true">&times;</span>
  						              </button>
  						            </div>

  						            <form method="POST">
  						      	      <input type="hidden" name="id_user" value="<?php echo $em1['id_user']?>">
  						              <div class="modal-body">
                              <div class="form-group">
  						                  <label for="recipient-name" class="col-form-label">Matériel</label>
  						                  <div class="col-sm-10">
                                  <?php $materiels1 = $db->query("SELECT * FROM materiel"); ?>

  										            <select class="form-control" name="materiel">
  											            <?php while($materiel= $materiels1->fetch()) :?>
  											              <option value="<?php echo $materiel['id'] ?>"><?php echo $materiel['type_mat'];?></option>
  										              <?php endwhile ?>
  										            </select>

  										            <button class="btn btn-success float-right mt-2" type="button"><i class="fas fa-plus-circle"></i></button>
  										            <div class="clearfix"></div>
  									            </div>
  						                </div>
                            </div>
  						              <div class="modal-footer">
  						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
  						                <button type="submit" class="btn btn-primary" name="sendmat">Envoyer</button>
                            </div>
  						            </form>
  						          </div>
  						        </div>
  						      </div>

  					       </div><div class="clearfix"></div>
					        </td>

  						    <td>
                    <?php while($affec1=$affecter1->fetch()):?>
    							    <?php
                        $ok = $materiels2->execute(array($affec1['id_mat']));
    							    ?>
    							    <?php while($mat=$materiels2->fetch()):?>
    								    <div class="mt-2"><?php echo $mat['n_serie']; ?></div>
                      <?php endwhile?>
                    <?php endwhile?>
                  </td>

  						    <td align="center">
                    <?php while($travail=$travailler->fetch()):?>
                      <?php
                        $bureaux->execute(array($travail['id_bureau']));   
                      ?>
                      <?php while($bur = $bureaux->fetch()):?>
                        <div><?php echo $bur['nom_bureau']." "; ?><span class="float-right mt-2"><a type="button" role="button" href="attribut.php?id_bureau=<?php echo $bur['id_bureau'] ;?>&id_user=<?php echo $em1['id_user'] ;?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a><span></div><div class="clearfix"></div>
                      <?php endwhile?>
                    <?php endwhile?>
                    <br>

                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal2<?php echo $em1['id_user'];?>" data-whatever="@getbootstrap" ><i class="fas fa-plus-circle"></i></button>
                    
                    <div class="modal fade" id="exampleModal2<?php echo $em1['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajout de bureau</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <form method="POST">
                            <input type="hidden" name="id_user" value="<?php echo $em1['id_user']?>">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Bureau</label>
                                <div class="col-sm-10">
                                  <?php $bureaux1 = $db->query("SELECT * FROM bureau"); ?>

                                  <select class="form-control" name="bureau">
                                    <?php while($bureau= $bureaux1->fetch()) :?>
                                      <option value="<?php echo $bureau['id_bureau'] ?>"><?php echo $bureau['nom_bureau'];?></option>
                                    <?php endwhile ?>
                                  </select>

                                  <button class="btn btn-success float-right mt-2" type="button"><i class="fas fa-plus-circle"></i></button>
                                  <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                              <button type="submit" class="btn btn-primary" name="sendbureau">Envoyer</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>

                  <div class="clearfix"></div>
    
  						    <td align="center">
                    <?php while($occupe=$occuper->fetch()):?>
  							      <?php
  							        $services->execute(array($occupe['id_service']));
  							      ?>
    							    <?php while($serv=$services->fetch()):?>
    								    <div><?php echo $serv['nom_service']." "; ?><span class="float-right mt-2"><a type="button" role="button" href="attribut.php?id_service=<?php echo $serv['id_service'] ;?>&id_user=<?php echo $em1['id_user'] ;?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a><span></div><div class="clearfix"></div>
    							    <?php endwhile?>
                    <?php endwhile?>
                    <br>

  				          <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal1<?php echo $em1['id_user'];?>" data-whatever="@getbootstrap" ><i class="fas fa-plus-circle"></i></button>

  						      <div class="modal fade" id="exampleModal1<?php echo $em1['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						        <div class="modal-dialog" role="document">
  						          <div class="modal-content">

  						            <div class="modal-header">
  						              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Ajout service</h5>
  						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						                <span aria-hidden="true">&times;</span>
  						              </button>
  						            </div>

  						            <form method="POST">
  						      	      <input type="hidden" name="id_user" value="<?php echo $em1['id_user']?>">
  						              <div class="modal-body">
  						                <div class="form-group">
  						                  <label for="recipient-name" class="col-form-label">Services</label>
  						                  <div class="col-sm-10">

                                  <?php 
                                    $id = $db->query("SELECT bureau.id_bureau  from employe,travail,bureau where employe.id_user = travail.id_user and travail.id_bureau = bureau.id_bureau and employe.id_user = '".$em1['id_user']."' order by bureau.id_bureau desc limit 1 ");
                                    $i = $id->fetch();
                                    $d = $i['id_bureau'];
                                    $services1 = $db->prepare("SELECT * FROM service where id_bureau = ?");
                                    $services1->execute(array($d));    
                                  ?>

  										            <select class="form-control" name="service">
  											            <?php while($service= $services1->fetch()) :?>
  											              <option value="<?php echo $service['id_service'] ?>"><?php echo $service['nom_service'];?></option>
  										              <?php endwhile ?>
  										            </select>

  										            <button class="btn btn-success float-right mt-2" type="button"><i class="fas fa-plus-circle"></i></button>
  										              <div class="clearfix"></div>
  									              </div>
  						                  </div>
  						                </div>

  						                <div class="modal-footer">
  						                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
  						                  <button type="submit" class="btn btn-primary" name="sendservice">Envoyer</button>
  						                </div>
                            </div>
  						            </form>
  						          </div>
  						        </div>
  						      </div>

                    </div><div class="clearfix"></div>
                  </td>
					      </tr>
				        <?php endwhile ?>
			        </tbody>
            </table>
          </div>
	     </div>
      </div>
    </div>


<script>
  <script>

  </script>
</script>

	 <!-- footer -->
<?php require("../footer/footer.php"); ?>
</body>
</html>
