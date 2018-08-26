<?php
require_once 'includes/Requests.php';

$request = new Requests();
$result   = $request->load_markers();

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';

$key = 0;

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{ 
	echo '<marker ';
	echo 'id="' . $row['id_event'] . '" ';
	echo 'desc="' . $row['description'] . '" ';
	echo 'lat="' . $row['latitude'] . '" ';
	echo 'lng="' . $row['longitude'] . '" ';
	echo 'type="' . $row['id_event_type'] . '" ';
	echo '/>';
	$key++;
}
echo '</markers>';
