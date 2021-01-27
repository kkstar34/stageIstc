<nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4 ">  <!-- Marge en bas mb-4  -->
	<div class="container">
	    <a class="navbar-brand" href="#"><img src="../images/istc2.png" class="rounded-circle" style="width: 25%"></a>
	    <a class="navbar-brand" href="utilisateurs.php"><?php echo "<font color='yellow'>".$_SESSION['nom']." ".$_SESSION['prenom']."</font>"; ?></a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	       <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"></li>
			</ul>
			
			<span class="navbar-text">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="deconnexion.php">
							<h4>Deconnexion</h4>
							<span class="sr-only">(current)</span>
						</a>
					</li>
				</ul>
			</span>
		</div>
    </div>
</nav>