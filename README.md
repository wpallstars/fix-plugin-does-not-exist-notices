# Plugin Reference Cleaner

Have you ever deleted a plugin some other way than on the `/wp-admin/plugins.php` page, you'll probabaly have been stuck with this annoying notifications that can't be cleared:

> "The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

This small WordPress utility plugin adds a "Remove Reference" button to these plugin deactivation error notices, allowing you to clean up the invalid plugin entries in the database.

## Description

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin enhances those notices with a button that allows you to safely remove the invalid reference with a single click.

You can find these with `SELECT * FROM wp_options WHERE option_name = 'active_plugins';` — but, the cleanup involved removing the rogue entry, and renumbering the others. This plugin can simply do that for you at the click of a button added to that WP standard notification.

It's probabaly something that should be added to WP core. If anyone from the core team wants to adopt this solution, it's GPL, so feel free.

**Note:** This plugin only needs to be installed and active if you have an error notification showing like this:
"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

If you don't have this notification perpetually showing on your `/wp-admin/plugins.php` page, then you don't need this, but you might like to save or bookmark it for if ever you do.

**Testing:** Just delete any plugin (that you can replace) from your `/wp-content/plugins` directory, via ftp or however you manage your WordPress files, then revisit your `/wp-admin/plugins.php` page with this plugin active to show the "Remove Reference" button.

The only ways I know to clear this missing plugin notification are:
1. Reinstall it and delete on the `/wp-admin/plugins.php` page.
2. Run `SELECT * FROM wp_options WHERE option_name = 'active_plugins';` (or `wp_1_options`, `wp_2_options`, `wp_3_options`, etc on a multisite network, using the side id of the site affected) via phpMyAdmin or Adminer, etc, or via mysql via your server commandline. Then edit the record, copying the json into an AI LLM and asking it to update without the reference to the missing plugin.
3. Use this plugin.

## Features

* Adds a "Remove Reference" button to plugin error notices
* Works for both single site and multisite WordPress installations
* Confirms before removing any plugin references
* Simple, lightweight solution with no settings page required
* Secure implementation with proper permissions checking
* Compatible with WordPress 5.0+

## Installation

1. Upload the plugin-reference-cleaner.php file to your /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. No configuration needed - the plugin works automatically

## Usage

1. Navigate to Plugins > Installed Plugins
2. If any "Plugin file does not exist" error notices appear, a "Remove Reference" button will be displayed
3. Click the button and confirm to remove the invalid plugin reference
4. The page will refresh with the error notice removed

## Support

For support, please visit [WP ALLSTARS](https://wpallstars.com)

## License

This plugin is licensed under the [GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html). 