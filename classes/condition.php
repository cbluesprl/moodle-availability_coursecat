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

    protected $rootcat;

    /**
     * Constructor.
     *
     * @param \stdClass $structure Data structure from JSON decode
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function __construct($structure) {

        require_once __DIR__ . '/../lib.php';

        // empty condition will always use plugin setting if exists
        $defaultcat = get_config('availability_coursecat', 'defaultcat');
        if (!empty($structure->coursecat)) {
            $this->coursecat = $structure->coursecat;
        } else if (!empty($defaultcat)) {
            $this->coursecat = $defaultcat;
        } else {
            throw new \coding_exception('Missing or invalid course category');
        }
    }

    /**
     * @return object
     */
    public function save() {
        $result = (object) array('type' => 'coursecat', 'coursecat' => $this->coursecat);
        if ($this->coursecat) {
            $result->coursecat = $this->coursecat;
        }
        return $result;
    }

    /**
     * @param bool $not
     * @param \core_availability\info $info
     * @param bool $grabthelot
     * @param int $userid
     * @return bool
     * @throws \coding_exception
     */
    public function is_available($not, \core_availability\info $info, $grabthelot, $userid) {

        $tree = $info->get_availability_tree();
        $conditions = $tree->get_all_children('availability_coursecat\condition');
        $this->rootcat = availability_course_cat_get_root_category($info->get_course()->category);

        if (stripos($this->rootcat->name, $conditions[0]->coursecat) !== false) {
            $this->allow = true;
        } else {
            $this->allow = false;
        }
        if ($not) {
            $this->allow = !$this->allow;
        }
        return $this->allow;
    }

    /**
     * @param bool $full
     * @param bool $not
     * @param \core_availability\info $info
     * @return \lang_string|string
     * @throws \coding_exception
     */
    public function get_description($full, $not, \core_availability\info $info) {
        $allow = $not ? !$this->allow : $this->allow;

        $notallow = get_string('notallowed', 'availability_coursecat', ['coursecat' => $this->coursecat]);
        if (!empty($this->rootcat->name)) {
            $notallow .= '. ' . get_string('actualrootcat', 'availability_coursecat', ['rootcat' => $this->rootcat->name]);
        }

        return $allow ? get_string('allowednot', 'availability_coursecat', ['coursecat' => $this->coursecat]) : $notallow;
    }

    /**
     * @return string
     */
    protected function get_debug_string() {
        return $this->allow ? 'YES' : 'NO';
    }
}
