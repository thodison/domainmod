<?php
/**
 * /settings/index.php
 *
 * This file is part of DomainMOD, an open source domain and internet asset manager.
 * Copyright (C) 2010-2015 Greg Chetcuti <greg@chetcuti.com>
 *
 * Project: http://domainmod.org   Author: http://chetcuti.com
 *
 * DomainMOD is free software: you can redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * DomainMOD is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with DomainMOD. If not, see
 * http://www.gnu.org/licenses/.
 *
 */
?>
<?php
include("../_includes/start-session.inc.php");
include("../_includes/init.inc.php");

require_once(DIR_ROOT . "classes/Autoloader.php");
spl_autoload_register('DomainMOD\Autoloader::classAutoloader');

$system = new DomainMOD\System();

include(DIR_INC . "head.inc.php");
include(DIR_INC . "config.inc.php");
include(DIR_INC . "software.inc.php");
include(DIR_INC . "database.inc.php");

$system->authCheck();

$page_title = "Settings";
$software_section = "system";
?>
<?php include(DIR_INC . 'doctype.inc.php'); ?>
<html>
<head>
    <title><?php echo $system->pageTitle($software_title, $page_title); ?></title>
    <?php include(DIR_INC . "layout/head-tags.inc.php"); ?>
</head>
<body>
<?php include(DIR_INC . "layout/header.inc.php"); ?>
<BR>

<div class="subheadline">User Menu</div>
<BR>
&raquo; <a href="display/">Display Settings</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="email/">Email
    Settings</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="defaults/">User Defaults</a><BR><BR>
&raquo; <a href="update-profile.php">Update Profile</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="password/">Change
    Password</a><BR>
<BR><BR>

<div class="subheadline">Maintenance Menu</div>
<BR>
&raquo; <a href="update-conversions.php">Update Conversion Rates</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a
    href="update-domain-fees.php">Update Domain Fees</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="update-ssl-fees.php">Update
    SSL Fees</a><BR>
<?php
if ($_SESSION['is_admin'] === 1) { //@formatter:off ?>
    <BR><BR>
    <div class="subheadline">Admin Menu</div><BR>
    &raquo; <a href="<?php echo $web_root; ?>/admin/system-settings.php">System Settings</a>&nbsp;&nbsp;/&nbsp;&nbsp;
    <a href="<?php echo $web_root; ?>/admin/defaults/">System Defaults</a>&nbsp;&nbsp;/&nbsp;&nbsp;
    <a href="<?php echo $web_root; ?>/admin/users.php">Users</a><BR>
    <BR>
    &raquo; <a href="<?php echo $web_root; ?>/admin/domain-fields.php">Custom Domain Fields</a>&nbsp;&nbsp;/&nbsp;&nbsp;
    <a href="<?php echo $web_root; ?>/admin/ssl-fields.php">Custom SSL Fields</a><BR><BR>
    &raquo; <a href="<?php echo $web_root; ?>/admin/scheduler/">Task Scheduler</a><BR><BR>
    &raquo; <a href="<?php echo $web_root; ?>/admin/dw/">Data Warehouse</a><BR><BR>
    &raquo; <a href="<?php echo $web_root; ?>/admin/info/">System Information</a><BR><?php
} //@formatter:on ?>
<?php include(DIR_INC . "layout/footer.inc.php"); ?>
</body>
</html>
