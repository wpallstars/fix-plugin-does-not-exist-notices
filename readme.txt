=== Plugin Reference Cleaner ===
Author: Marcus Quinn
Author URI: https://wpallstars.com
Version: 1.1
License: GPL-2.0+

== Description ==

Have you ever deleted a plugin some other way than on the /wp-admin/plugins.php page, you'll probably have been stuck with this annoying notification that can't be cleared:

"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

This small WordPress utility plugin adds a "Remove Reference" button to these plugin deactivation error notices, allowing you to clean up the invalid plugin entries in the database.

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin enhances those notices with a button that allows you to safely remove the invalid reference with a single click.

You can find these with `SELECT * FROM wp_options WHERE option_name = 'active_plugins';` — but, the cleanup involved removing the rogue entry, and renumbering the others. This plugin can simply do that for you at the click of a button added to that WP standard notification.

It's probably something that should be added to WP core. If anyone from the core team wants to adopt this solution, it's GPL, so feel free.

Note: This plugin only needs to be installed and active if you have an error notification showing at /wp-admin/plugins.php, like this:
"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

If you don't have this notification perpetually showing on your /wp-admin/plugins.php page, then you don't need this, but you might like to save or bookmark it for if ever you do.

== Features ==

* Adds a "Remove Reference" button to plugin error notices
* Works for both single site and multisite WordPress installations
* Confirms before removing any plugin references
* Simple, lightweight solution with no settings page required
* Secure implementation with proper permissions checking
* Compatible with WordPress 5.0+

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
* Enhanced security with proper capability checks

= 1.0 =
* Initial release

== Support ==

For support, please visit https://wpallstars.com 