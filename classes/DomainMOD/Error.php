<?php
/**
 * /classes/DomainMOD/Error.php
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
namespace DomainMOD;

class Error
{

    public function outputSqlError($db_connection, $msg_to_display)
    {

        return trigger_error(htmlentities($msg_to_display . ": " . mysqli_error($db_connection)), E_USER_ERROR);

    }

    // This function is temporary. After I convert all database queries to prepared statements this won't be needed.
    public function outputOldSqlError($db_connection)
    {

        return trigger_error(htmlentities(mysqli_error($db_connection)), E_USER_ERROR);

    }

}
