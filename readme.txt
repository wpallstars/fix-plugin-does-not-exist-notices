=== Plugin Reference Cleaner ===
Author: Marcus Quinn
Author URI: https://wpallstars.com
Version: 1.1
License: GPL-2.0+

== Description ==

Plugin Reference Cleaner adds a convenient "Remove Reference" button to plugin deactivation error notices in WordPress. This tool helps administrators clean up invalid plugin entries that can occur when plugins are improperly removed from the server.

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin enhances those notices with a button that allows you to safely remove the invalid reference with a single click.

Note: This plugin only needs to be installed and active if you have an error notification showing at /wp-admin/plugins.php, like this:
"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

== Features ==

* Adds a "Remove Reference" button to plugin error notices
* Works for both single site and multisite WordPress installations
* Confirms before removing any plugin references
* Simple, lightweight solution with no settings page required

== Installation ==

1. Upload the plugin-reference-cleaner.php file to your /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. No configuration needed - the plugin works automatically

== Usage ==

1. Navigate to Plugins > Installed Plugins
2. If any "Plugin file does not exist" error notices appear, a "Remove Reference" button will be displayed
3. Click the button and confirm to remove the invalid plugin reference
4. The page will refresh with the error notice removed

== Changelog ==

= 1.1 =
* Improved error handling
* Added support for multisite installations

= 1.0 =
* Initial release

== Support ==

For support, please visit https://wpallstars.com 