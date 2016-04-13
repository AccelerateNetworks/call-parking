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
			<a href="status-json.php">JSON version</a>.
		</td>
	</tr>
</table>
<?php
require_once "footer.php";
