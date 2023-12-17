<?php

function ajouterNotificationsEventPubli($db_handle, $ID_event){
	$sql="INSERT INTO notifications (ID_event, etat_event) VALUES ('$ID_emplois', 'NO')";

	$result=$db_handle->query($sql);

	return $result;
}