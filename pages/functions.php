<?php
session_start();

// connect to database
$db = new PDO('mysql:host=localhost;dbname=istc_bd' , 'root','');
$db->exec('SET NAMES utf8');
$fonctions = $db->query("SELECT * FROM fonction");
$grades = $db->query("SELECT * FROM grade");
$bureaux = $db->query("SELECT * FROM bureau");
$materiels = $db->query("SELECT * FROM materiel");
$services = $db->query("SELECT * FROM service");


// variable declaration
$nom = "";
$prenom    = "";
$email = "";
$grade = "";
$fonction = "";
$identifiant = "";
$password_1 = "";
$password_2 = "";
$id_user ="";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['send'])) {
	register();
}

if (isset($_POST['update'])) {
	update();
}


if (isset($_POST['attribuer'])) {
	attribuer();
}

if (isset($_POST['sendmat'])) {
	ajouter_materiel();
}
if (isset($_POST['sendbureau'])) {
	ajouter_bureau();
}
if (isset($_POST['sendservice'])) {
	ajouter_service();
}

if (isset($_POST['send_service_bureau'])) {
	ajouter_service_bureau();
}


function attribuer(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_user,$id_mat, $id_bureau, $id_service;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values

	$id_user =    $_POST['id_user'];
	$id_mat =    $_POST['materiel'];
	$id_bureau =    $_POST['bureau'];
	$id_service =    $_POST['service'];



	// register user if there are no errors in the form
	if (count($errors) == 0) {	
			/*$bureau_select = $db->prepare("SELECT * from travail where id_user = ?");
			$bureau_select->execute(array($id_user));
			$bureaux_exist = $bureau_select->rowCount();


			if($bureaux_exist = 0){
				$insertbur = $db->prepare("INSERT INTO travail(id_bureau,id_user)  VALUES(?,?)");
	            $insertbur->execute(array($id_bureau, $id_user));
			}else{
				
			$updatebur = $db->query("UPDATE travail SET id_bureau='".$id_bureau."', id_user='".$id_user."' WHERE id_user='".$id_user."' ");
			}*/

				$insertbur = $db->prepare("INSERT INTO travail(id_bureau,id_user)  VALUES(?,?)");
	            $insertbur->execute(array($id_bureau, $id_user));

             $insertser = $db->prepare("INSERT INTO occupe(id_service,id_user)  VALUES(?,?)");
             $insertser->execute(array($id_service, $id_user));


             $insertmat = $db->prepare("INSERT INTO affecter(id_mat,id_user,date_affectation)  VALUES(?,?, NOW())");
             $insertmat->execute(array($id_mat, $id_user));


			$_SESSION['success']  = "Nouvelle attribution effectuée avec succès!!";
				header('location: attribut.php');
		}
}


function ajouter_service(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_user,$id_mat;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values

	$id_user =    $_POST['id_user'];
	$id_service =    $_POST['service'];

if (count($errors) == 0) {

        $insertmat = $db->prepare("INSERT INTO occupe(id_user,id_service)  VALUES(?,?)");
        $insertmat->execute(array( $id_user,$id_service));

	$_SESSION['success']  = "Attribution de service effectuée avec succès!!";
				header('location: attribut.php');
					}
				}



function ajouter_service_bureau(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_bureau,$id_mat;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values

	$id_bureau =    $_POST['id_bureau'];
	$id_service =    $_POST['id_service'];

if (count($errors) == 0) {

        $insertserv = $db->query(" UPDATE service SET id_bureau='".$id_bureau."' WHERE id_service='".$id_service."' ");

        


        
	$_SESSION['success']  = "Attribution de service effectuée avec succès!!";
				header('location: bureaux.php');
					}
}




function ajouter_bureau(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_user,$id_mat;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values

	$id_user =    $_POST['id_user'];
	$id_bureau =    $_POST['bureau'];

if (count($errors) == 0) {

        $insertmat = $db->prepare("INSERT INTO travail(id_bureau,id_user)  VALUES(?,?)");
        $insertmat->execute(array($id_bureau, $id_user));

	$_SESSION['success']  = "Attribution de bureau effectuée avec succès!!";
				header('location: attribut.php');
					}
				}


function ajouter_materiel(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $id_user,$id_mat;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values

	$id_user =    $_POST['id_user'];
	$id_mat =    $_POST['materiel'];

if (count($errors) == 0) {

        $insertmat = $db->prepare("INSERT INTO affecter(date_affectation,id_mat,id_user)  VALUES(NOW(),?,?)");
        $insertmat->execute(array($id_mat, $id_user));

	$_SESSION['success']  = "Attribution de materiel effectuée avec succès!!";
				header('location: attribut.php');
					}
				}


function update(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $nom, $prenom,$email, $identifiant,$fonction,$grade, $id_user;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$nom         =  $_POST['nom'];
	$prenom      =  $_POST['prenom'];
	$email       =  $_POST['email'];
	$role       =  $_POST['role'];
	$identifiant =  $_POST['identifiant'];
	$fonction    =  $_POST['fonction'];
	$grade       =  $_POST['grade'];
	$id_user =    $_POST['id_user'];


	// form validation: ensure that the form is correctly filled
	if (empty($nom)) {
		array_push($errors, "Nom obligatoire");
	}
	if (empty($prenom)) {
		array_push($errors, "Prenom obligatoire");
	}
	if (empty($email)) {
		array_push($errors, "Email obligatoire");
	}
	if (empty($identifiant)) {
		array_push($errors, "Identifiant obligatoire");
	}
	if (empty($fonction)) {
		array_push($errors, "Fonction obligatoire");
	}
	if (empty($grade)) {
		array_push($errors, "Grade obligatoire");
	}


	// register user if there are no errors in the form
	if (count($errors) == 0) {
            /*$updatembr = $db->prepare("UPDATE employe SET identifiant=?, nom_employe=?,prenom=?,role=?,id_grade=?,id_fonc=?,email=? WHERE id_user=?");*/
            /*$o = $updatembr->execute(array($identifiant,$nom, $prenom, $role, $grade, $fonction, $email, $id_user));
			var_dump($o);

			die();*/
			$updatembr = $db->query("UPDATE employe SET identifiant='".$identifiant."', nom_employe='".$nom."',prenom='".$prenom."',role='".$role."',id_grade='".$grade."',id_fonc='".$fonction."',email='".$email."' WHERE id_user='".$id_user."'");

			$_SESSION['success']  = "utilisateur modifié avec succès!!";
				header('location: user.php');
			/*if($o){
				$_SESSION['success']  = "utilisateur modifié avec succès!!";
				header('location: user.php');
			}else{
				array_push($errors, "erreur lors de la modification");
			}*/

		}
}




function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $nom, $prenom,$email, $identifiant,$fonction,$grade, $password_1, $password_2;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$nom         =  $_POST['nom'];
	$prenom      =  $_POST['prenom'];
	$email       =  $_POST['email'];
	$identifiant =  $_POST['identifiant'];
	$fonction    =  $_POST['fonction'];
	$grade       =  $_POST['grade'];
	$password_1  =  $_POST['password_1'];
	$password_2  =  $_POST['password_2'];

	// form validation: ensure that the form is correctly filled
	if (empty($nom)) {
		array_push($errors, "Nom obligatoire");
	}
	if (empty($prenom)) {
		array_push($errors, "Prenom obligatoire");
	}
	if (empty($email)) {
		array_push($errors, "Email obligatoire");
	}
	if (empty($identifiant)) {
		array_push($errors, "Identifiant obligatoire");
	}
	if (empty($fonction)) {
		array_push($errors, "Fonction obligatoire");
	}
	if (empty($grade)) {
		array_push($errors, "Grade obligatoire");
	}
	if (empty($password_1)) {
		array_push($errors, "Mot de passe obligatoire");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "Les deux mots de passe sont différents");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['role'])) {
			$role = $_POST['role'];
            $insertmbr = $db->prepare("INSERT INTO employe (identifiant,nom_employe,prenom,role,mot_de_passe,id_grade,id_fonc,email)  VALUES(?, ?, ?, ? ,? ,? ,? ,?)");
            $insertmbr->execute(array($identifiant,$nom, $prenom, $role, $password, $grade, $fonction, $email));
			$_SESSION['success']  = "Nouveau utilisateur crée avec succès!!";
			header('location: user.php');
		}else{
            $insertmbr = $db->prepare("INSERT INTO employe (identifiant,nom_employe,prenom,role,mot_de_passe,id_grade,id_fonc,email)  VALUES(?, ?, ?, ?, ?, ?, ?,?)");
             $insertmbr->execute(array($identifiant, $nom, $prenom, 'user', $password, $grade, $fonction, $email));
			header('location: ../index.php');
		}
	}
}
// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
// return user array from their id
function getUserById($id){
	global $db;

    $user = $db->query("SELECT * FROM users WHERE id='".$id."' ");

	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['connecté'])) {
		return true;
	}else{
		return false;
	}
}
// call the login() function if register_btn is clicked
if (isset($_POST['formconnect'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $identifiant,$password, $errors;

	// grap form values
	$identifiant = $_POST['identifiant'];
	$password = $_POST['password'];

	// make sure form is filled properly
	if (empty($identifiant)) {
		array_push($errors, "Identifiant obligatoire");
	}
	if (empty($password)) {
		array_push($errors, "Mot de passe obligatoire");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query =$db->query("SELECT * FROM employe WHERE identifiant='$identifiant' AND mot_de_passe='$password' LIMIT 1") ;
        $results = $query->rowCount();
        $a = $query->fetch();

		if ($results == 1) { // user found
			// check if user is admin or user

			if ($a['role'] == 'admin') {

                $_SESSION['id_user'] = $a['id_user'];
           		$_SESSION['nom'] = $a['nom_employe']; // put logged in user in session
	           	$_SESSION['prenom'] = $a['prenom'];
	           	$_SESSION['role'] = $a['role'];
	           	$_SESSION['grade'] = $a['grade'];
	            $_SESSION['fonction'] = $a['fonction'];
	            $_SESSION['email'] = $a['email'];
	            $_SESSION['connecté'] = true;
				$_SESSION['success']  = "Vous etes connecté";
				header('location: pages/admin.php');
			}else{
                $_SESSION['id_user'] = $a['id_user'];
	            $_SESSION['nom'] = $a['nom_employe']; // put logged in user in session
	           	$_SESSION['prenom'] = $a['prenom'];
	           	$_SESSION['role'] = $a['role'];
	           	$_SESSION['grade'] = $a['grade'];
	            $_SESSION['fonction'] = $a['fonction'];
	            $_SESSION['email'] = $a['email'];
	            $_SESSION['connecté'] = true;
				$_SESSION['success']  = "Vous etes connecté";

				header('location: pages/utilisateurs.php');
			}
		}else {
			array_push($errors, "Votre mot de passe et identifiant ne correspondent pas.");
		}
	}
}
function isAdmin()
{
	if (isset($_SESSION['connecté']) && $_SESSION['role'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
