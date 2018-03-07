<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Affiliations
 *
 * This plugin is designed to work with Moodle 3.2+ and allows students to select 
 * which entities they would like to be affiliated with. The student will be placed
 * into the corresponding cohort.
 *
 * @package    local
 * @subpackage affiliations
 * @copyright  2018 Saylor Academy
 * @author     John Azinheira
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

namespace local_affiliations\output;

defined('MOODLE_INTERNAL') || die();

class manageaffiliatespage implements \renderable, \templatable {
    /**
     * An array of the current affiliates
     *
     * @var array
     */
    protected $affiliates;

    public function __construct() {
        $this->affiliates = [];
        
    }
    /**
     * Prepare data for use in a template
     *
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(\renderer_base $output) {
        global $DB;

        // Get all the affiliates and load into an array.
        $affiliates = $DB->get_records('local_affiliations_affiliate');

        foreach ($affiliates as $affiliate) {
            $data['affiliates'][] = array('id' => $affiliate->id,
                                    'cohortid' => $affiliate->cohortid,
                                    'fullname' => $affiliate->fullname,
                                    'shortname' => $affiliate->shortname);
        }

        return $data;
    }
}