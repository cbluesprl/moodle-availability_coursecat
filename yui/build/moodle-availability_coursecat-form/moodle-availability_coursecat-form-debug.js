YUI.add('moodle-availability_coursecat-form', function (Y, NAME) {

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
    console.log('The param was: ' + coursecat);
    this.html = coursecat;
};

M.availability_coursecat.form.getNode = function(json) {

    var strings = M.str.availability_coursecat;
    var html = '<label>' + strings.title + ' <input type="text" name="coursecat" placeholder="Catalogue"></label>';
    var node = Y.Node.create('<span>' + html + '</span>');

    console.log(json.coursecat);
    if (json.coursecat !== undefined) {
        node.one('input[name=coursecat]').set('value', json.coursecat);
    }

    // Add event handlers (first time only)
    if (!M.availability_coursecat.form.addedEvents) {
        M.availability_coursecat.form.addedEvents = true;
        var root = Y.one('.availability-field');
        root.delegate('valuechange', function() {
            console.log('toto');
            // Whichever dropdown changed, just update the form.
            M.core_availability.form.update();
        }, '.availability_coursecat input');
    }

    return node;
};

M.availability_coursecat.form.fillValue = function(value, node) {
    console.log('fill');
    console.log(value);
    console.log(node);
    value.coursecat = node.one('input[name=coursecat]').get('value');
};


}, '@VERSION@', {"requires": ["base", "node", "event", "io", "moodle-core_availability-form"]});
