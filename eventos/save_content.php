<?php
require_once 'includes/Requests.php';

if (isset($_POST['id_event_type'])) 
{
	$request = new Requests();
	$result  = $request->insert('event', $_POST);
	echo $result;
}