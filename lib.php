<?php
/**
 * This script is owned by CBlue SPRL, please contact CBlue regarding any licences issues.
 *
 * @author:      jeanfrancois@cblue.be
 * @copyright:   CBlue SPRL, 2022
 */

/**
 * @param int $categoryid
 * @return core_course_category|false|null
 * @throws moodle_exception
 */
function availability_course_cat_get_root_category(int $categoryid)
{
    $category = \core_course_category::get($categoryid, MUST_EXIST, true);
    if (!empty($category)) {
        $root_cat = explode('/', $category->path);
        if (!empty($root_cat[1])) {
            $category = \core_course_category::get($root_cat[1], MUST_EXIST, true);
        }
    }
    return $category;
}
