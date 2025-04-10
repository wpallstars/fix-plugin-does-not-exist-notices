# Fix 'Plugin file does not exist.' Notices

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/fix-plugin-does-not-exist-notices)](https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/)
[![WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/rating/fix-plugin-does-not-exist-notices)](https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/)
[![WordPress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/fix-plugin-does-not-exist-notices)](https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/)
[![License](https://img.shields.io/badge/license-GPL--2.0%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

Easily remove references to deleted plugins that cause "Plugin file does not exist" errors in your WordPress admin.

## Description

Have you ever deleted a plugin directly from the server or database and then been stuck with annoying error notifications that can't be cleared?

"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

This small utility plugin adds missing plugins to your WordPress plugins list and provides a "Remove Reference" link, allowing you to safely clean up invalid plugin entries with one click.

### Key Features

* Adds missing plugins directly to your plugins list
* Provides a simple "Remove Reference" action link
* Works with both single site and multisite WordPress installations
* Includes helpful notifications explaining how to fix plugin errors
* One-click auto-scroll to find missing plugins in large sites
* Clean, user-friendly interface following WordPress design patterns

### How It Works

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin:

1. Detects all missing plugin references in your database
2. Adds them to your plugins list with "(File Missing)" indicators
3. Provides a "Remove Reference" link to safely remove them
4. Shows clear notifications guiding you through the cleanup process

### Use Cases

* You've accidentally deleted a plugin via FTP
* A plugin was removed by another admin but references remain
* You've migrated from another site and have leftover plugin references
* Your hosting provider removed a plugin but didn't clean the database

## Installation

### From WordPress.org:

1. Visit Plugins > Add New in your WordPress admin
2. Search for "Fix 'Plugin file does not exist.' Notices"
3. Click "Install Now" and then "Activate"

### Manual Installation:

1. Download the plugin ZIP file
2. Go to Plugins > Add New > Upload Plugin
3. Upload the ZIP file
4. Activate the plugin

## Usage

1. After activation, navigate to Plugins > Installed Plugins
2. If you have missing plugin errors, you'll see them in your plugins list with "(File Missing)" markers
3. Click the "Remove Reference" link next to any missing plugin
4. The reference will be removed, and the error notification will disappear

## Frequently Asked Questions

### Is it safe to remove plugin references?

Yes, this plugin only removes entries from the WordPress active_plugins option, which is safe to modify when a plugin no longer exists. It doesn't modify any other database tables or settings.

### What happens after I remove a reference?

The plugin entry will be removed from your active plugins list, and the corresponding error notification will no longer appear after you refresh the page.

### Can I use this plugin on a multisite installation?

Yes, the plugin works on both single sites and multisite installations. It properly handles network-activated plugins as well.

## Screenshots

1. Error message with explanation notification
2. Missing plugin shown in the plugins list with "Remove Reference" link
3. Auto-scroll feature that highlights the missing plugin

## Developers

### Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add some amazing feature'`
4. Push to the branch: `git push origin feature/amazing-feature`
5. Submit a pull request

### Technical Details

The plugin works by:
1. Filtering the `all_plugins` array to add missing plugins
2. Adding a custom "Remove Reference" action link via `plugin_action_links`
3. Adding helpful notifications near error messages
4. Providing a secure method to remove plugin references from the database

## Changelog

### 1.4.0
- Updated plugin name and text domain
- Repository rename from plugin-reference-cleaner to fix-plugin-does-not-exist-notices

### 1.3.3
* Improved notification placement next to WordPress error messages
* Added "Click here to scroll" button that automatically locates missing plugins
* Enhanced reliability with multiple injection methods
* Added visual arrow pointing from notification to error message

### 1.3.2
* Added prominent notification directly below WordPress error messages
* Improved user guidance with visual cues to connect error and solution
* Added eye-catching styling to help users understand how to fix errors

### 1.3.1
* Added instructional notification explaining how to use the plugin
* Improved user guidance with step-by-step instructions
* Enhanced visual identification of missing plugins

### 1.3.0
* Complete redesign for maximum compatibility with all WordPress themes
* Now adds missing plugins directly to the plugins list table
* Uses standard WordPress admin UI patterns instead of DOM manipulation
* Added "Remove Reference" action link in the plugins list
* Significantly improved reliability across all WordPress configurations

[View full changelog](CHANGELOG.md)

## License

This project is licensed under the GPL-2.0+ License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please visit [WP All Stars](https://www.wpallstars.com). 