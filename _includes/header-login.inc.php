<?php
// /_includes/header-login.inc.php
// 
// Domain Manager - A web-based application written in PHP & MySQL used to manage a collection of domain names.
// Copyright (C) 2010 Greg Chetcuti
// 
// Domain Manager is free software; you can redistribute it and/or modify it under the terms of the GNU General
// Public License as published by the Free Software Foundation; either version 2 of the License, or (at your
// option) any later version.
// 
// Domain Manager is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
// implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
// for more details.
// 
// You should have received a copy of the GNU General Public License along with Domain Manager. If not, please 
// see http://www.gnu.org/licenses/
?>
<BR><BR><BR>
<a name="top"></a>
<table align="center" width="<?=$site_width_login?>" border="0" cellspacing="0" cellpadding="0">
	<tr>
        <td class="header-table-center">
			<a href="<?=$web_root?>"><img border="0" src="<?=$web_root?>/images/logo.png"></a>
		</td>
        <td class="header-table-right">
			<?php if ($_SESSION['session_is_logged_in'] == 1) { ?>
                <em>logged in as <strong><?=$_SESSION['session_username']?></strong> (<a class="subtlelink" href="<?=$web_root?>/system/update-profile.php"><?=$_SESSION['session_first_name']?> <?=$_SESSION['session_last_name']?></a>)</em>&nbsp;&nbsp;[ <a href="<?=$web_root?>/logout.php">Logout</a> ]
            <?php } ?>
		</td>
	</tr>
</table>
<table align="center" width="<?=$site_width_login?>" border="0" cellspacing="0" cellpadding="0">
	<tr>
        <td class="main-table" height="100%">
			<?php if ($software_section != "login" && $software_section != "installation" && $software_section != "resetpassword" && $_SESSION['session_running_login_checks'] != 1) { ?>
            <?php include($full_server_path . "/_includes/layout/menu-main.inc.php"); ?><BR>
            <hr width="100%" size="1" noshade><BR>
            <?php } ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="10">&nbsp;</td>
                    <td>
                        <BR><BR>
                        <?php 
                            include($full_server_path . "/_includes/layout/table-maintenance.inc.php"); 
                        ?>
                        <?php 
                        if ($_SESSION['session_result_message'] != "") {
                            include($full_server_path . "/_includes/layout/table-result-message.inc.php"); 
                            unset($_SESSION['session_result_message']);
                        }
                        ?>