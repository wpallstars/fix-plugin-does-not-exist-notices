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

### How do I know which plugin references should be removed?

The plugin will only show "Remove Reference" links for plugins that are listed in your database but don't actually exist in your plugins directory. These are safe to remove.

### Will this break my site?

No. Since the plugin is only removing references to plugins that no longer exist, removing these references won't affect your site's functionality. In fact, it's cleaning up remnants that might be causing issues.

### What if I accidentally remove a reference I shouldn't have?

If you remove a reference to a plugin that you later want to reinstall, simply install the plugin again and activate it normally.

### Do I need to keep this plugin installed and active after notices are cleared?

Although this plugin consumes minimal disk space, and doesn't run unless you are on the /wp-admin/plugins.php page, you don't need to keep it active or installed if you don't have this notice to clear — but it is safe to, if you just want it as a part of your overall WordPress stack of enhancements and conveniences.

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

### 1.6.7
* Fixed duplicate notices issue by removing PHP-generated notice
* Simplified notice system to only show one notice below WordPress error
* Ensured consistent terminology with "Remove Notice" text
* Optimized plugin detection with caching to improve performance
* Fixed JavaScript to correctly handle multiple error messages

### 1.6.6
* Fixed issue with "Remove Notice" link not appearing on missing plugin rows
* Fixed issue with automatic removal of plugin references without user action
* Fixed notice positioning to ensure it appears below error messages
* Restored pointer triangle to indicate relationship with error message
* Improved detection of missing plugins in the plugin list
* Enhanced scroll functionality to work with all plugin types

### 1.6.5
* Fixed duplicate notices issue - now only one notice appears below error messages
* Changed notice heading to "Fix Plugin Does Not Exist Notices ☝️"
* Updated explanatory text to be more clear about the removal process
* Changed "Remove Reference" link text to "Remove Notice" for better clarity
* Made "(File Missing)" text bold and red for better visibility
* Fixed scroll functionality to work with all plugin rows
* Improved JavaScript to prevent multiple notices from appearing

### 1.6.4
* Updated version management to ensure consistent patch version increments
* Improved documentation for version update process
* Enhanced AI workflow files with detailed version increment instructions

### 1.6.3
* Fixed Git Updater repository URLs to use full repository paths
* Corrected Update URI configuration for proper update detection
* Improved version management following semantic versioning
* Updated organization name from 'WP All Stars' to 'WP ALLSTARS'
* Updated namespace from 'WPAllStars' to 'WPALLSTARS'

### 1.6.2
* Updated POT file version for consistency
* Improved JavaScript localization with proper fallbacks
* Enhanced code quality for WordPress.org submission
* Added Git Updater configuration with Update URI
* Added update server URL configuration

### 1.6.1
* Added AI assistant guide and workflow documentation
* Added detailed release process documentation
* Added feature development guidelines
* Added bug fixing procedures
* Added code review standards

### 1.6.0
* Added full translation support with POT file
* Added JavaScript localization for better multilingual support
* Added plugin constants for improved code organization
* Added Git Updater support for updates from GitHub and Gitea
* Updated code to follow WordPress internationalization best practices
* Improved asset loading with version constants
* Added smart update detection based on installation source

### 1.5.0
* Improved compatibility with WordPress 6.4
* Enhanced error detection for plugin references
* Minor UI improvements for better visibility
* Accessibility enhancements for screen readers

[View full changelog](CHANGELOG.md)

## License

This project is licensed under the GPL-2.0+ License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please visit [WP ALLSTARS](https://www.wpallstars.com).