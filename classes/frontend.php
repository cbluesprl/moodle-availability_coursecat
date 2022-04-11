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
 * Front-end class.
 *
 * @package availability_coursecat
 * @copyright 2022 CBlue
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace availability_coursecat;

defined('MOODLE_INTERNAL') || die();

/**
 * Front-end class.
 *
 * @package availability_coursecat
 * @copyright 2022 CBlue
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class frontend extends \core_availability\frontend {

    protected function get_javascript_strings() {
        // these paramaters are used in availability_coursecat.form.initInner in yui/src/form.js as get_string function
        return ['rootcat'];
    }

    /**
     * @param \stdClass $course
     * @param \cm_info|null $cm
     * @param \section_info|null $section
     * @return array
     * @throws \dml_exception
     */
    protected function get_javascript_init_params($course, \cm_info $cm = null,
            \section_info $section = null) {

        require_once __DIR__ . '/../lib.php';

        $category = availability_course_cat_get_root_category($course->category);
        $defaultcat = get_config('availability_coursecat', 'defaultcat');

        // these paramaters are used in availability_coursecat.form.initInner in yui/src/form.js
        return [$category->name, $defaultcat];
    }
}
