<?php
require_once "root.php";
require_once "resources/require.php";
require 'utils.php';
$domainSQL = "SELECT v_domains.domain_name, v_domains.domain_uuid FROM v_domains, v_device_settings WHERE v_device_settings.device_setting_subcategory = 'xmlapptoken' AND v_device_settings.device_setting_value = :token AND v_device_settings.domain_uuid = v_domains.domain_uuid;";
$domain = do_sql($domainSQL, array(":token" => $_GET['token']))[0];

$fp = event_socket_create($_SESSION['event_socket_ip_address'], $_SESSION['event_socket_port'], $_SESSION['event_socket_password']);
$xml = trim(event_socket_request($fp, "api valet_info"));
$valet_info = new SimpleXMLElement($xml);

$out = new XMLWriter();
$out->openMemory();
$out->startDocument('1.0','UTF-8');
$out->startElement("xmlapp");
$out->writeAttribute('title', 'Call Status');
$out->startElement('view');

label($domain['domain_name']);
echo "<!--";
print_r($valet_info);
echo "-->";
foreach($valet_info->{'parking_lot@'.$domain['domain_name']} as $spot) {
  $spot_num = (int)$spot;
  $caller_id_number = uuid_getvar((string)$spot['uuid'], 'caller_id_number');
  label("$spot_num occupied by $caller_id_number");
}
$out->endElement();
echo $out->outputMemory();
