# Fix 'Plugin file does not exist.' Notices

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/fix-plugin-does-not-exist-notices)](https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/)
[![WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/rating/fix-plugin-does-not-exist-notices)](https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/)
[![WordPress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/fix-plugin-does-not-exist-notices)](https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/)
[![License](https://img.shields.io/badge/license-GPL--2.0%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

Easily remove references to deleted plugins that cause "Plugin file does not exist" errors in your WordPress admin.

## Description

Have you ever deleted a plugin directly from the server or database and then been stuck with annoying error notifications that can't be cleared?

"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

This small utility plugin adds missing plugins to your WordPress plugins list and provides a "Remove Notice" link, allowing you to safely clean up invalid plugin entries with one click.

### Key Features

* Adds missing plugins directly to your plugins list
* Provides a simple "Remove Notice" action link
* Works with both single site and multisite WordPress installations
* Includes helpful notifications explaining how to fix plugin errors
* One-click auto-scroll to find missing plugins in large sites
* Clean, user-friendly interface following WordPress design patterns

### How It Works

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin:

1. Detects all missing plugin references in your database
2. Adds them to your plugins list with "(File Missing)" indicators
3. Provides a "Remove Notice" link to safely remove them
4. Shows clear notifications guiding you through the cleanup process
5. Safely removes the missing active plugin reference from your database using standard WordPress functions
6. Leaves all remaining plugins installed and active

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
3. Click the "Remove Notice" link next to any missing plugin
4. The reference will be removed, and the error notification will disappear

## Frequently Asked Questions

### Is it safe to remove plugin references?

Yes, this plugin only removes entries from the WordPress active_plugins option, which is safe to modify when a plugin no longer exists. It doesn't modify any other database tables or settings.

### What happens after I remove a reference?

The plugin entry will be removed from your active plugins list, and the corresponding error notification will no longer appear after you refresh the page.

### Can I use this plugin on a multisite installation?

Yes, the plugin works on both single sites and multisite installations. It properly handles network-activated plugins as well.

### How do I know which plugin references should be removed?

The plugin will only show "Remove Notice" links for plugins that are listed in your database but don't actually exist in your plugins directory. These are safe to remove.

### Will this break my site?

No. Since the plugin is only removing references to plugins that no longer exist, removing these references won't affect your site's functionality. In fact, it's cleaning up remnants that might be causing issues.

### What if I accidentally remove a reference I shouldn't have?

If you remove a reference to a plugin that you later want to reinstall, simply install the plugin again and activate it normally.

### Do I need to keep this plugin installed and active after notices are cleared?

Although this plugin consumes minimal disk space, and doesn't run unless you are on the /wp-admin/plugins.php page, you don't need to keep it active or installed if you don't have this notice to clear — but it is safe to, if you just want it as a part of your overall WordPress stack of enhancements and conveniences.

### How do I fix the "Plugin file does not exist" error in WordPress?

This error occurs when WordPress has a reference to a plugin in its database, but the actual plugin files are missing. Our plugin provides a simple one-click solution: it adds these missing plugins to your plugins list with a "Remove Notice" button that lets you safely remove the database reference.

### Why do I see "The plugin has been deactivated due to an error: Plugin file does not exist"?

This error appears when you've deleted a plugin's files (via FTP or file manager) without properly deactivating it first through the WordPress admin. WordPress still thinks the plugin should be active but can't find its files. Our plugin helps you clean up these references.

### Can this plugin fix errors after migrating a WordPress site?

Yes! After migrating a site, you might see plugin errors if some plugins weren't transferred correctly. This plugin will help you identify and clean up those references without having to edit the database directly.

### Is it safe to remove plugin references that show "Plugin file does not exist"?

Absolutely. If WordPress is showing this error, it means the plugin files are already gone, and you're just cleaning up a database reference. Our plugin uses WordPress's standard functions to safely remove these references without affecting other plugins or site functionality.

### How is this different from manually editing the database?

Manually editing the WordPress database is risky and requires technical knowledge. Our plugin provides a safe, user-friendly way to remove plugin references directly from the WordPress admin interface without any SQL knowledge or database access.

## Screenshots

1. Error message with explanation notification
2. Missing plugin shown in the plugins list with "Remove Notice" link
3. Auto-scroll feature that highlights the missing plugin

## Developers

### Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add some amazing feature'`
4. Push to the branch: `git push origin feature/amazing-feature`
5. Submit a pull request

### AI-Powered Development

This repository is configured to work with various AI-powered development tools. You can use any of the following AI IDEs to contribute to this project:

- [Augment](https://augment.dev/) - AI-powered coding assistant
- [Cursor](https://cursor.sh/) - AI-first code editor
- [v0](https://v0.dev/) - AI-powered design and development tool
- [Windsurf](https://www.windsurf.io/) - AI coding assistant
- [Cline](https://cline.tools/) - AI terminal assistant
- [Roo](https://roo.ai/) - AI pair programmer
- [Gemini Code Assist](https://ai.google.dev/gemini-api) - Google's AI coding assistant
- [Loveable](https://www.loveable.ai/) - AI development environment
- [Bolt](https://www.bolt.dev/) - AI-powered code editor
- [Cody](https://sourcegraph.com/cody) - Sourcegraph's AI coding assistant
- [Continue](https://continue.dev/) - Open-source AI coding assistant

The repository includes configuration files for all these tools to ensure a consistent development experience.

### Technical Details

The plugin works by:
1. Filtering the `all_plugins` array to add missing plugins
2. Adding a custom "Remove Notice" action link via `plugin_action_links`
3. Adding helpful notifications near error messages
4. Providing a secure method to remove plugin references from the database

## Changelog

### 1.6.25
* Consolidated asset files into their respective directories
* Created comprehensive WordPress.org submission guide
* Clarified SVN repository structure and asset requirements
* Improved organization of asset files

### 1.6.24
* Added properly named icon PNG files for WordPress.org submission
* Created icon-256x256.png and icon-128x128.png files
* Updated asset preparation documentation

### 1.6.23
* Prepared assets for WordPress.org plugin submission
* Added properly named icon, banner, and screenshot files
* Created comprehensive guide for WordPress.org asset requirements
* Fixed file naming to comply with WordPress.org standards

### 1.6.22
* Enhanced support section with multiple support channel options
* Added encouragement for users to leave reviews on WordPress.org
* Improved documentation with clearer support instructions

### 1.6.21
* Added support for more AI-powered development tools (Roo, Gemini, Loveable, Bolt, Cody, Continue)
* Updated documentation with links to supported AI IDEs
* Enhanced SEO with additional FAQs and keywords
* Made documentation more generic for boilerplate use
* Updated AI configuration files with modern models and better explanations

### 1.6.20
* Added explanations about the ! prefix in ignore files
* Moved WordPress-specific patterns to .gitignore
* Further improved organization of ignore patterns
* Added examples of how to include files excluded by .gitignore

### 1.6.19
* Consolidated common ignore patterns into .gitignore
* Simplified AI IDE configuration files to only include tool-specific patterns
* Improved organization of ignore patterns for better maintainability
* Added more file types to .gitignore for comprehensive coverage

### 1.6.18
* Optimized AI IDE configuration files to only include patterns not in .gitignore
* Improved efficiency of ignore files for better AI context management
* Enhanced compatibility with various AI-powered development tools

### 1.6.17
* Added .augmentignore file with best practices
* Added configuration files for Cursor, Windsurf, v0, and Cline IDEs
* Added more design file formats to .gitignore
* Added .aiconfig file for general AI IDE compatibility

### 1.6.16
* Updated CI configuration files with correct plugin slugs
* Updated CHANGELOG.md with all recent versions
* Fixed outdated references to plugin-reference-cleaner

### 1.6.15
* Moved AI workflow documentation to root directory for better visibility
* Consolidated duplicate workflow files
* Improved organization of development documentation

### 1.6.14
* Updated documentation to consistently use "Remove Notice" instead of "Remove Reference"
* Added design file extensions to .gitignore (.pxd, .afdesign, .afphoto, .afpub)
* Improved explanation of how the plugin works
* Ensured consistent terminology across all documentation

### 1.6.13
* Code cleanup and optimization
* Improved Git Updater integration
* Fixed author display in plugin information
* Ensured compatibility with WordPress 6.4

### 1.6.12
* Added WP ALLSTARS as a co-author
* Updated author information and links
* Added author websites to plugin description
* Fixed issue with multiple author URLs

### 1.6.11
* CRITICAL FIX: Completely removed auto-deactivation prevention code that was causing fatal errors
* Simplified plugin functionality to focus on core features only
* Improved compatibility with various WordPress configurations
* Ensured plugin works correctly when other plugins are deleted

### 1.6.10
* Fixed critical error that could occur when a plugin folder is deleted
* Improved error handling with try/catch blocks
* Added more specific checks for the plugins page
* Enhanced compatibility with various WordPress configurations
* Made the code more defensive to prevent potential issues

### 1.6.9
* Fixed issue with notices not appearing below WordPress error messages
* Improved JavaScript detection of WordPress error notices
* Prevented WordPress from automatically clearing error notices on page refresh
* Added multiple timing attempts to ensure notices appear correctly
* Enhanced error notice targeting for better compatibility

### 1.6.8
* Fixed notice positioning to appear directly below WordPress error messages
* Improved notice width to match WordPress error messages
* Updated explanatory text for better clarity
* Fixed issue with notices not appearing in some cases
* Improved JavaScript detection of WordPress error messages

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

If you need help with this plugin, there are several ways to get support:

* [WordPress.org Support Forums](https://wordpress.org/support/plugin/fix-plugin-does-not-exist-notices/)
* [GitHub Issues](https://github.com/wpallstars/fix-plugin-does-not-exist-notices/issues)
* [Gitea Issues](https://gitea.wpallstars.com/wpallstars/fix-plugin-does-not-exist-notices/issues)

If you find this plugin helpful, please consider [leaving a review](https://wordpress.org/support/plugin/fix-plugin-does-not-exist-notices/reviews/) on WordPress.org. Your feedback helps others discover the plugin and encourages continued development and support.