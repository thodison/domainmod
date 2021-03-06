<?php
/**
 * /admin/domain-fields/index.php
 *
 * This file is part of DomainMOD, an open source domain and internet asset manager.
 * Copyright (c) 2010-2016 Greg Chetcuti <greg@chetcuti.com>
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
<?php //@formatter:off
include("../../_includes/start-session.inc.php");
include("../../_includes/init.inc.php");

require_once(DIR_ROOT . "classes/Autoloader.php");
spl_autoload_register('DomainMOD\Autoloader::classAutoloader');

$system = new DomainMOD\System();
$error = new DomainMOD\Error();
$layout = new DomainMOD\Layout();
$time = new DomainMOD\Time();

include(DIR_INC . "head.inc.php");
include(DIR_INC . "config.inc.php");
include(DIR_INC . "software.inc.php");
include(DIR_INC . "settings/admin-custom-domain-fields.inc.php");
include(DIR_INC . "database.inc.php");

$system->authCheck();
$system->checkAdminUser($_SESSION['s_is_admin'], $web_root);

$export_data = $_GET['export_data'];

$sql = "SELECT f.id, f.name, f.field_name, f.description, f.notes, f.creation_type_id, f.created_by, f.insert_time, f.update_time, t.name AS type
        FROM domain_fields AS f, custom_field_types AS t
        WHERE f.type_id = t.id
        ORDER BY f.name";

if ($export_data == '1') {

    $result = mysqli_query($connection, $sql) or $error->outputOldSqlError($connection);

    $export = new DomainMOD\Export();
    $export_file = $export->openFile('custom_domain_field_list', strtotime($time->stamp()));

    $row_contents = array($page_title);
    $export->writeRow($export_file, $row_contents);

    $export->writeBlankRow($export_file);

    $row_contents = array(
        'Display Name',
        'DB Field',
        'Data Type',
        'Description',
        'Notes',
        'Creation Type',
        'Created By',
        'Inserted',
        'Updated'
    );
    $export->writeRow($export_file, $row_contents);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_object($result)) {

            $creation_type = $system->getCreationType($connection, $row->creation_type_id);

            if ($row->created_by == '0') {
                $created_by = 'Unknown';
            } else {
                $user = new DomainMOD\User();
                $created_by = $user->getFullName($connection, $row->created_by);
            }

            $row_contents = array(
                $row->name,
                $row->field_name,
                $row->type,
                $row->description,
                $row->notes,
                $creation_type,
                $created_by,
                $time->toUserTimezone($row->insert_time),
                $time->toUserTimezone($row->update_time)
            );

            $export->writeRow($export_file, $row_contents);

        }

    }

    $export->closeFile($export_file);

}
?>
<?php include(DIR_INC . 'doctype.inc.php'); ?>
<html>
<head>
    <title><?php echo $system->pageTitle($software_title, $page_title); ?></title>
    <?php include(DIR_INC . "layout/head-tags.inc.php"); ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<?php include(DIR_INC . "layout/header.inc.php"); ?>
Below is a list of all the Custom Domain Fields that have been added to <?php echo $software_title; ?>.<BR>
<BR>
Custom Domain Fields help extend the functionality of <?php echo $software_title; ?> by allowing the user to create
their own data fields. For example, if you wanted to keep track of which domains are currenty setup in Google Analytics,
you could create a new Google Analytics check box field and start tracking this information for each of your domains.
Combine custom fields with the ability to update them with the Bulk Updater, and the sky's the limit in regards to what
data you can easily track!<BR>
<BR>
And when you export your domain data, the information contained in your custom fields will automatically be included in
the exported data.<BR>
<BR><?php

$result = mysqli_query($connection, $sql) or $error->outputOldSqlError($connection);

if (mysqli_num_rows($result) > 0) { ?>

    <a href="add.php"><?php echo $layout->showButton('button', 'Add Custom Field'); ?></a>&nbsp;&nbsp;&nbsp;
    <a href="index.php?export_data=1"><?php echo $layout->showButton('button', 'Export'); ?></a><BR><BR>

    <table id="<?php echo $slug; ?>" class="<?php echo $datatable_class; ?>">
        <thead>
        <tr>
            <th width="20px"></th>
            <th>Name</th>
            <th>DB Field</th>
            <th>Data Type</th>
            <th>Inserted</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody><?php

        while ($row = mysqli_fetch_object($result)) { ?>

            <tr>
            <td></td>
            <td>
                <a href="edit.php?cdfid=<?php echo $row->id; ?>"><?php echo $row->name; ?></a>
            </td>
            <td>
                <a href="edit.php?cdfid=<?php echo $row->id; ?>"><?php echo $row->field_name; ?></a>
            </td>
            <td>
                <a href="edit.php?cdfid=<?php echo $row->id; ?>"><?php echo $row->type; ?></a>
            </td>
            <td>
                <a href="edit.php?cdfid=<?php echo $row->id; ?>"><?php echo $time->toUserTimezone($row->insert_time); ?></a>
            </td>
            <td><?php

                if ($row->update_time != '0000-00-00 00:00:00') {

                    $temp_update_time = $time->toUserTimezone($row->update_time);

                } else {

                    $temp_update_time = '-';

                } ?>
                <a href="edit.php?cdfid=<?php echo $row->id; ?>"><?php echo $temp_update_time; ?></a>
            </td>
            </tr><?php

        } ?>

        </tbody>
    </table><?php

} else { ?>

    It appears as though you haven't created any Custom Domain Fields yet. <a href="add.php">Click here</a> to add one.<?php

} ?>
<?php include(DIR_INC . "layout/footer.inc.php"); //@formatter:on ?>
</body>
</html>
