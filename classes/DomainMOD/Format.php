<?php
/**
 * /classes/DomainMOD/Format.php
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
//@formatter:off
namespace DomainMOD;

class Format
{

    public function stripSpacing($input)
    {

        $output = trim(preg_replace("/^\n+|^[\t\s]*\n+/m", "", $input));

        return $output;

    }

    public function replaceBreaks($input_notes)
    {

        $output_notes = trim($input_notes);
        $output_notes = str_replace("\n\n", "<BR><BR>", $output_notes);
        $output_notes = str_replace("\n", "<BR>", $output_notes);

        return $output_notes;

    }

} //@formatter:on
