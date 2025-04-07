# Plugin Reference Cleaner

A WordPress plugin that adds a "Remove Reference" button to plugin deactivation error notices, allowing users to clean up invalid plugin entries in the database.

## Description

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin enhances those notices with a button that allows you to safely remove the invalid reference with a single click.

**Note:** This plugin only needs to be installed and active if you have an error notification showing like this:
"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

## Features

* Adds a "Remove Reference" button to plugin error notices
* Works for both single site and multisite WordPress installations
* Confirms before removing any plugin references
* Simple, lightweight solution with no settings page required
* Secure implementation with proper permissions checking

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