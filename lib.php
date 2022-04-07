<?php
/**
 * This script is owned by CBlue SPRL, please contact CBlue regarding any licences issues.
 *
 * @author:      jeanfrancois@cblue.be
 * @copyright:   CBlue SPRL, 2022
 */

function availability_course_cat_get_root_category($categoryid)
{
    $category = \core_course_category::get($categoryid);
    $root_cat = explode('/', $category->path);
    return \core_course_category::get($root_cat[1]);
}