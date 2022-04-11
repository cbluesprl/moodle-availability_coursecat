<?php
/**
 * Settings
 *
 * @package availability_coursecat
 * @copyright 2022 CBlue
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if ($hassiteconfig) {
    $settings->add(new admin_setting_configtext('availability_coursecat/defaultcat',
            get_string('defaultcat', 'availability_coursecat'),
            get_string('defaultcatdesc', 'availability_coursecat'), 'Catalogue', PARAM_TEXT));
}
