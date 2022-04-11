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
 * @param {String} rootcat Root Category of this course module
 * @param {String} defaultcat Default Category from Availability Coursecat plugin settings
 */
M.availability_coursecat.form.initInner = function(rootcat, defaultcat) {
    this.rootcat = rootcat;
    this.defaultcat = defaultcat;
};

M.availability_coursecat.form.getNode = function(json) {

    var strings = M.str.availability_coursecat;
    var html = '<label>' + strings.title + ' <input type="text" name="coursecat" placeholder="' + this.defaultcat +'"></label>' +
        '<div class="alert alert-info">' + M.util.get_string('rootcat', 'availability_coursecat') + ' : ' + this.rootcat + '</div>';
    var node = Y.Node.create('<span>' + html + '</span>');

    if (json.coursecat !== undefined) {
        node.one('input[name=coursecat]').set('value', json.coursecat);
    }

    // Add event handlers (first time only)
    if (!M.availability_coursecat.form.addedEvents) {
        M.availability_coursecat.form.addedEvents = true;
        var root = Y.one('.availability-field');
        root.delegate('valuechange', function() {
            // Whichever dropdown changed, just update the form.
            M.core_availability.form.update();
        }, '.availability_coursecat input');
    }

    return node;
};

M.availability_coursecat.form.fillValue = function(value, node) {
    value.coursecat = node.one('input[name=coursecat]').get('value');
};
