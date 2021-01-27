<?php
include('functions.php');
if(isset($_GET['view'])){
	$output = "";
	if(!empty($_GET['view'])){
		
		$db->query("UPDATE notifications SET statut = 1  WHERE statut = 0 ");
		header('Location: intervention.php');
	}

	$notifications = $db->query("SELECT * FROM notifications,employe WHERE notifications.id_user = employe.id_user AND statut = 0");
	$notifications = $notifications->fetchAll();

	$notification_statut = $db->query("SELECT * FROM notifications WHERE statut = 0");

	$notification_statut = 	$notification_statut->fetchAll();
	$nombre_de_notification_non_lue = count($notification_statut);
	if(count($notifications)>0){
		foreach ($notifications as  $notification) {
			$output .= '<p class="red">Vous aviez '. $nombre_de_notification_non_lue .' message</p><a class="dropdown-item media bg-flat-color-1"  id="dropdown-item">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">'.$notification['nom_employe']. ' ' . $notification['prenom'] .'</span>
                                    <span class="time float-right">maintenant</span>
                                        <p>' .$notification['sujet']. '</p>
                                </span>
                            </a>';
		}
	}else{
	$output = '<a class="dropdown-item media bg-flat-color-1" href="#" onclick="return false;">
                                
                                <span class="message media-body">
                                   
                                        <p class="text-white">Pas de notifications</p>
                                </span>
                            </a>';
	}


	$data = array(
		'sujet' => $output,
		'notification_non_lue' => $nombre_de_notification_non_lue,
	);
	echo json_encode($data);
}

?>