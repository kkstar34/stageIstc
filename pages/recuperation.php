
<?php
  	include('functions.php');

	if (isset($_POST['recup_submit'],$_POST['recup_mail'])) {

	  	if (!empty($_POST['recup_mail'])) {
	  		$recup_mail=htmlspecialchars($_POST['recup_mail']);
	  		if (filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
	  			$mailexits=$db->prepare('SELECT id_user,prenom FROM employe WHERE email=? ');
	  			$mailexits->execute(array($recup_mail));
	  			$mailexits_count=$mailexits->rowCount();

	  			if ($mailexits_count == 1) {
	  				$prenom = $mailexits->fetch();
	  				$prenom = $prenom['prenom'];
	  				$_SESSION['recup_mail'] = $recup_mail;

	  				$recup_code = "";
	  				for ($i=0; $i < 5; $i++) { 
	  					$recup_code .= mt_rand(0,5);
	  				}

	  				$mail_recup_exist = $db->prepare('SELECT id FROM recuperation WHERE mail_recup = ?');
	  				$mail_recup_exist->execute(array($recup_mail));
	  				$mail_recup_exist=$mail_recup_exist->rowCount();

	  				if ($mail_recup_exist == 1) {
	  					$recup_insert = $db->prepare('UPDATE recuperation SET code_recup=? WHERE mail_recup = ?');
	  					$recup_insert->execute(array($recup_code,$recup_mail));
	  					
	  				}else{
	  					$recup_insert = $db->prepare('INSERT INTO recuperation(mail_recup,code_recup) VALUES(?,?)');
	  					$recup_insert->execute(array($recup_mail,$recup_code));
	  				}

	  				$header="MIME-Version: 1.0\r\n";
		         	$header.='From:"IstcParc.com"<support@istcParc.com>'."\n";
		         	$header.='Content-Type:text/html; charset="utf-8"'."\n";
		         	$header.='Content-Transfer-Encoding: 8bit';
		         	$message = '
		         	<html>
			         	<head>
			           		<title>Récupération de mot de passe - IstcParc.com</title>
			           		<meta charset="utf-8" />
			         	</head>
			         	<body>
			           		<font color="#303030";>
			             		<div align="center">
				               		<table width="600px">
				                 		<tr>
				                   			<td>
				                     
				                     			<div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
				                     			Voici votre code de récupération: <b>'.$recup_code.'</b>
				                     			A bientôt sur <a href="http://IstcParc.com/">IstcParc.com</a> !
				                     
				                  			</td>
				                 		</tr>
				                 		<tr>
				                   			<td align="center">
				                     			<font size="2">
				                       				Ceci est un email automatique, merci de ne pas y répondre
				                     			</font>
				                   			</td>
				                 		</tr>
				               		</table>
			             		</div>
			           		</font>
			         	</body>
			        </html>
		         	';
		         	mail($recup_mail, "Récupération de mot de passe - IstcParc.com", $message, $header);
		            header("Location:http://localhost/Stage_ISTC/pages/recuperation.php?section=code");


	  			}else{
	  				echo "Cette adresse mail n'est pas enregistrée";
	  			}
	  		}else{
	  			echo "Adresse mail invalide";
	  		}
	  	}else{
	  		$error="Veuillez entrer votre adresse mail";
	  	}  	
	}

?>

<!DOCTYPE html>
<html>
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/tableexport.min.css">
    <title>ISTC_ParcInfo</title>
</head>
  
<body>
	<div class="container">
		<nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4 ">  <!-- Marge en bas mb-4  -->
			<div class="container">
			    <a class="navbar-brand" href="../index.php"><img src="../images/istc2.png" class="rounded-circle" style="width: 25%"></a>
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			       <span class="navbar-toggler-icon"></span>
			    </button>
		    </div>
		</nav>
	</div>
	
	<div class="container">
		<form method="POST">
			<div class="form-group">
				<label for="exampleInputEmail1">Récupération de mot de passe</label>
				<input type="email" class="form-control" name="recup_mail" id="exampleInputEmail1" ariadescribedby="emailHelp" placeholder="Enter email">
			</div>

			<div class="form-group">
	            <input type="submit" name="recup_submit" class="btn btn-primary"  value="Valider">
	        </div>
		</form>

		<?php 
				if (isset($error)) {
					echo '<span style="color:red">'.$error.'</span>';
				}else{
					echo "<br>";
				}
			?>
	</div>

</body>
</html>