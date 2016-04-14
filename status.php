<?php
/*
	GNU Public License
	Version: GPL 3
*/
require_once "root.php";
require_once "resources/require.php";
require_once "resources/check_auth.php";

//add multi-lingual support
$language = new text;
$text = $language->get();

//additional includes
require_once "resources/header.php";
require_once "resources/paging.php";
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<b>Parked Calls</b>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table id="parkedcalls" class="tr_hover" width="100%">
				<thead>
					<tr>
						<th>Spot</th>
						<th>Caller ID Name</th>
						<th>Caller ID Number</th>
						<th>Total Call Time</th>
					</tr>
				</thead>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript" src="vendor/moment/min/moment.min.js"></script>
<script type="text/javascript" src="status.js"></script>
<?php
require_once "footer.php";
