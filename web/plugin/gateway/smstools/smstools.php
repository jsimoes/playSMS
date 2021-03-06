<?php
defined('_SECURE_') or die('Forbidden');
if(!isadmin()){forcenoaccess();};

include $apps_path['plug']."/gateway/smstools/config.php";

$gw = gateway_get();

if ($gw == $smstools_param['name']) {
	$status_active = "<span class=status_active />";
} else {
	$status_active = "<span class=status_inactive />";
}

switch ($op) {
	case "manage":
		if ($err = $_SESSION['error_string']) {
			$content = "<div class=error_string>$err</div>";
		}
		$content .= "
			<h2>"._('Manage smstools')."</h2>
			<table width=100%>
				<tbody>
				<tr>
					<td width=270>"._('Gateway name')."</td><td>smstools $status_active</td>
				</tr>
				</tbody>
			</table>";
		echo $content;
		break;
	case "manage_activate":
		$db_query = "UPDATE "._DB_PREF_."_tblConfig_main SET c_timestamp='".mktime()."',cfg_gateway_module='smstools'";
		$db_result = dba_query($db_query);
		$_SESSION['error_string'] = _('Gateway has been activated');
		header("Location: index.php?app=menu&inc=gateway_smstools&op=manage");
		exit();
		break;
}

?>