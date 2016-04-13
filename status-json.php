<?php
/*
	GNU Public License
	Version: GPL 3
*/
require_once "root.php";
require_once "resources/require.php";
require_once "resources/check_auth.php";

$fp = event_socket_create($_SESSION['event_socket_ip_address'], $_SESSION['event_socket_port'], $_SESSION['event_socket_password']);

if (!$fp) {
	die("ERROR");
}

$xml = trim(event_socket_request($fp, "api valet_info"));
$valet_info = new SimpleXMLElement($xml);
$out = array();
foreach($valet_info as $lot) {
	$lot_name = (string)$lot['name'];
	$out[$lot_name] = array();
	foreach($lot as $spot) {
		error_log("Lot $lot_name spot $spot occupied by call ".$spot['uuid']."\n");
		$out[$lot_name][] = array("call_uuid" => (string)$spot['uuid'], "spot" => (string)$spot);
	}
}

echo json_encode($out);
