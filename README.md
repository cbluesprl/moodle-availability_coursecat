# Availability coursecat
Restrict course module based on course root category name.

Course module will be restricted if the root category name of the course contains (or not) the restriction text.

The restriction interface will indicate the root category of the current course module.

Restriction message will be : 'Not available unless: Root course category contains "XXX". Actual root category is : "YYY"'

A default root category name can be configured in plugin settings.

## Conditional availability conditions
Check the global documentation about conditional availability conditions: https://docs.moodle.org/en/Conditional_activities_settings

## Installation:

There are two installation methods available.

Follow one of these, then log into your Moodle site as an administrator and visit the notifications page to complete the install.

### Git

This requires Git being installed. If you do not have Git installed, please visit the [Git website](https://git-scm.com/downloads "Git website").

Once you have Git installed, simply visit your Moodle mod directory and clone the repository using the following command.

```
git clone https://github.com/cbluesprl/moodle-availability_coursecat.git availability/condition/coursecat
```

Or add it with submodule command if you use submodules.

```
git submodule add https://github.com/cbluesprl/moodle-availability_coursecat.git availability/condition/coursecat
```

### Download the zip

Unpack the zip file into the availability/condition/ directory. A new directory will be created called coursecat. 

Go to Site administration > Notifications to complete the plugin installation.

## Troubleshooting
1. Goto "Administration" > "Advanced features", and ensure that "Enable completion tracking" is set to yes.
2. Make sure "Enable completion tracking" is set to "yes" in the course settings.
3. Goto "Administration" > "Course administration" > "Course completion", and configure the the conditions required for course completion. Note: you must set some conditions, you cannot just set the "completion requirements" option at the top. Save.
4. Goto "Administration" > "Course adminiatration". Make sure you can now "Course completion" listed under "reports". If you cannot see this report then course completion has not been set correctly.
5. Start restricting

## Requirements
This plugin requires Moodle 3.11+

## License
Licensed under the [GNU GPL License](http://www.gnu.org/copyleft/gpl.html).