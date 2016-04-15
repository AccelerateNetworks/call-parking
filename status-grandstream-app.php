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
// <?xml version="1.0" encoding="UTF-8">
$out->startDocument('1.0','UTF-8');

// <xmlapp title="Call Status">
$out->startElement("xmlapp");
$out->writeAttribute('title', 'Call Status');

// <view>
$out->startElement('view');

// <section>
$out->startElement('section');

label($domain['domain_name']);

foreach($valet_info as $lot) {
  if((string)$lot['name'] == 'parking_lot@'.$domain['domain_name']) {
    foreach($lot as $spot) {
      $spot_num = (int)$spot;
      $caller_id_number = uuid_getvar((string)$spot['uuid'], 'caller_id_number');
      label("$spot_num occupied by $caller_id_number");
    }
  }
}

// </section>
$out->endElement();

// </view>
$out->endElement();

// <Softkeys>
$out->startElement('Softkeys');

// <Softkey action="QuitApp" label="Exit" />
$out->writeAttribute('action', 'QuitApp');
$out->writeAttribute('label', 'Exit');
$out->endElement();

// <Softkey action="UseURL" label="Refresh" commandArgs="..." />
$out->startElement('Softkey');
$out->writeAttribute('action', 'UseURL');
$out->writeAttribute('label', 'Refresh');
$out->writeAttribute('commandArgs', 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?token=".$_GET['token']);

// </Softkeys>
$out->endElement();

// </xmlapp>
$out->endElement();
echo $out->outputMemory();
