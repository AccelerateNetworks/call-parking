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

header("Content-Type: application/xml");
$valet_info = trim(event_socket_request($fp, "api valet_info"));
echo $valet_info;
