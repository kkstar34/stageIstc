<!-- code php de connexion à la page user -->

<?php
  include('functions.php') 
?>
<!-- fin de la connexion à la page user -->


<!-- corps de la page de connexion -->

<!doctype html>
<html lang="en">
  <?php  require("header/header.php"); ?>

  <body background="">
    <?php  require("nav/nav_Conec.php"); ?>

    <?php if(isset($_SESSION['erreur'])):?>
      <div class="alert  alert-danger alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-danger">erreur</span><?php echo $_SESSION['erreur'];?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>

    <h1 align="center" class="text-dark">Gestionnaire du parc informatique de l'ISTC</h1>
    <div class="container px-lg-5 mt-5">
      <div class="col mx-lg-n5">
        <div class="card-footer">

          <form class="login100-form validate-form" method="post" action="">
            <?php echo display_error(); ?>

            <h2 align="center">Authentifiez-vous :  </h2>

            <div class="form-group">
              <input type="text" class="form-control" placeholder="Identifiant" name="identifiant">
            </div>

            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="form-group row">
              <?php  if(isset($erreur)): ?>
                <div class="alert alert-danger"><?php echo $erreur ?></div>
              <?php endif ?>
            </div>
              
            <div class="form-group">
              <input type="submit" name="formconnect" class="btn btn-success"  value="Se connecter">
            </div>

            <!-- redirection sur une autre page pour s'inscrire dans la bd si pas encore enregistrer-->
            <div class="text-center p-t-136">
              Si vous n'êtes pas encore inscrit <a href="pages/inscription.php" class="txt2 mt-4">cliquer ici
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> <br>
                <!--<a href="pages/recuperation.php" class="txt2 mt-4">Mot de passe oublié ?
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>-->
              </a><br><br>    
            </div>
          </form>  
          
        </div>  
      </div>
    </div>

    <!-- footer -->
    <?php  require("footer/footer.php"); ?>
  </body>
</html>