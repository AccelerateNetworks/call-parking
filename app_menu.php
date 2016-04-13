<?php
$y = 0;
$apps[$x]['menu'][$y]['title']['en-us'] = "Call Parking";
$apps[$x]['menu'][$y]['uuid'] = "c1d935b7-9d25-4f37-8aea-d40f5dc65dee";
$apps[$x]['menu'][$y]['parent_uuid'] = "fd29e39c-c936-f5fc-8e2b-611681b266b5";
$apps[$x]['menu'][$y]['category'] = "internal";
$apps[$x]['menu'][$y]['path'] = "/app/call-parking/";
$apps[$x]['menu'][$y]['groups'][] = "superadmin";

$y++;
$apps[$x]['menu'][$y]['title']['en-us'] = "Parked Calls";
$apps[$x]['menu'][$y]['uuid'] = "a8d132f0-6412-4fbe-a3e8-63e3304c4200";
$apps[$x]['menu'][$y]['parent_uuid'] = "0438b504-8613-7887-c420-c837ffb20cb1";
$apps[$x]['menu'][$y]['category'] = "internal";
$apps[$x]['menu'][$y]['path'] = "/app/call-parking/status.php";
$apps[$x]['menu'][$y]['groups'][] = "superadmin";
