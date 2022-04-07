/**
 * JavaScript for form editing date conditions.
 *
 * @module moodle-availability_coursecat-form
 */
M.availability_coursecat = M.availability_coursecat || {};

/**
 * @class M.availability_coursecat.form
 * @extends M.core_availability.plugin
 */
M.availability_coursecat.form = Y.Object(M.core_availability.plugin);

/**
 * Initialises this plugin.
 *
 * @method initInner
 * @param {String} coursecat HTML to use for date fields
 */
M.availability_coursecat.form.initInner = function(coursecat) {
    this.html = coursecat;
};

M.availability_coursecat.form.getNode = function(json) {

    var strings = M.str.availability_coursecat;
    var html = '<label>' + strings.title + ' <input type="text" name="coursecat"></label>';
    var node = Y.Node.create('<span>' + html + '</span>');

    // if (json.allow) {
    //     node.one('input').set('checked', true);
    // }

    // Add event handlers (first time only)
    if (!M.availability_coursecat.form.addedEvents) {
        M.availability_coursecat.form.addedEvents = true;
        var root = Y.one('.availability-field');
        root.delegate('change', function() {
            // Whichever dropdown changed, just update the form.
            M.core_availability.form.update();
        }, '.availability_coursecat input');
    }

    return node;
};

M.availability_coursecat.form.fillValue = function(value, node) {
    value.coursecat = node.one('input').get('coursecat');
};
