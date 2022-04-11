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
 * Date condition.
 *
 * @package availability_coursecat
 * @copyright 2022 CBlue
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace availability_coursecat;

defined('MOODLE_INTERNAL') || die();

/**
 * Date condition.
 *
 * @package availability_coursecat
 * @copyright 2022 CBlue
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class condition extends \core_availability\condition {

    protected $coursecat;

    protected $allow;

    /**
     * Constructor.
     *
     * @param \stdClass $structure Data structure from JSON decode
     * @throws \coding_exception If invalid data structure.
     */
    public function __construct($structure) {

        if (!property_exists($structure, 'coursecat')) {
            $this->coursecat = '';
        } elseif (!empty($structure->coursecat)) {
            $this->coursecat = $structure->coursecat;
        } else {
            throw new \coding_exception('Missing or invalid course category');
        }
    }

    public function save() {
        $result = (object)array('type' => 'coursecat', 'coursecat' => $this->coursecat);
        if ($this->coursecat) {
            $result->coursecat = $this->coursecat;
        }
        return $result;
    }

    public function is_available($not, \core_availability\info $info, $grabthelot, $userid) {

        require_once __DIR__ . '/../lib.php';

        $cat_root = availability_course_cat_get_root_category($info->get_course()->category);
        $tree = $info->get_availability_tree();
        $conditions = $tree->get_all_children('availability_coursecat\condition');

        if ($conditions[0]->coursecat == $cat_root->name && !$not) {
            $this->allow = true;
            return true;
        } else {
            $this->allow = false;
            return false;
        }
    }

    public function get_description($full, $not, \core_availability\info $info) {
        $allow = $not ? !$this->allow : $this->allow;
        return $allow ? 'Allowed' : 'Not allowed until root course category contains ' . $this->coursecat;
    }

    protected function get_debug_string() {
        return $this->allow ? 'YES' : 'NO';
    }
}
