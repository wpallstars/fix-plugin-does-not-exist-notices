=== Fix 'Plugin file does not exist.' Notices ===
Contributors: marcusquinn, wpallstars
Donate link: https://www.marcusquinn.com
Tags: plugins, missing plugins, cleanup, error fix, admin tools, plugin file does not exist
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.0
Stable tag: 1.6.18
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easily remove references to deleted plugins that cause "Plugin file does not exist" errors in your WordPress admin. By Marcus Quinn (marcusquinn.com) & WP ALLSTARS (wpallstars.com).

== Description ==

Have you ever deleted a plugin directly from the server or database and then been stuck with annoying error notifications that can't be cleared?

"The plugin folder-name/file-name.php has been deactivated due to an error: Plugin file does not exist."

This small utility plugin adds missing plugins to your WordPress plugins list and provides a "Remove Notice" link, allowing you to safely clean up invalid plugin entries with one click.

= Key Features =

* Adds missing plugins directly to your plugins list
* Provides a simple "Remove Notice" action link
* Works with both single site and multisite WordPress installations
* Includes helpful notifications explaining how to fix plugin errors
* One-click auto-scroll to find missing plugins in large sites
* Clean, user-friendly interface following WordPress design patterns

= How It Works =

When WordPress detects a plugin file that no longer exists but is still referenced in the database as active, it displays an error notice. This plugin:

1. Detects all missing plugin references in your database
2. Adds them to your plugins list with "(File Missing)" indicators
3. Provides a "Remove Notice" link to safely remove them
4. Shows clear notifications guiding you through the cleanup process
5. Safely removes the missing active plugin reference from your database using standard WordPress functions
6. Leaves all remaining plugins installed and active

= Use Cases =

* You've accidentally deleted a plugin via FTP
* A plugin was removed by another admin but references remain
* You've migrated from another site and have leftover plugin references
* Your hosting provider removed a plugin but didn't clean the database

== Installation ==

1. Upload the `fix-plugin-does-not-exist-notices` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. No configuration needed - the plugin works automatically
4. If you have missing plugin errors, you'll immediately see them in your plugins list with "Remove Notice" links

== Frequently Asked Questions ==

= Is it safe to remove plugin references? =

Yes, this plugin only removes entries from the WordPress active_plugins option, which is safe to modify when a plugin no longer exists. It doesn't modify any other database tables or settings.

= What happens after I remove a reference? =

The plugin entry will be removed from your active plugins list, and the corresponding error notification will no longer appear after you refresh the page.

= Can I use this plugin on a multisite installation? =

Yes, the plugin works on both single sites and multisite installations. It properly handles network-activated plugins as well.

= How do I know which plugin references should be removed? =

The plugin will only show "Remove Notice" links for plugins that are listed in your database but don't actually exist in your plugins directory. These are safe to remove.

= Will this break my site? =

No. Since the plugin is only removing references to plugins that no longer exist, removing these references won't affect your site's functionality. In fact, it's cleaning up remnants that might be causing issues.

= What if I accidentally remove a reference I shouldn't have? =

If you remove a reference to a plugin that you later want to reinstall, simply install the plugin again and activate it normally.

= Do I need to keep this plugin installed and active after notices are cleared? =

Although this plugin consumes minimal disk space, and doesn't run unless you are on the /wp-admin/plugins.php page, you don't need to keep it active or installed if you don't have this notice to clear — but it is safe to, if you just want it as a part of your overall WordPress stack of enhancements and conveniences.

== Screenshots ==

1. Error message with explanation notification
2. Missing plugin shown in the plugins list with "Remove Notice" link
3. Auto-scroll feature that highlights the missing plugin

== Changelog ==

= 1.6.18 =
* Optimized AI IDE configuration files to only include patterns not in .gitignore
* Improved efficiency of ignore files for better AI context management
* Enhanced compatibility with various AI-powered development tools

= 1.6.17 =
* Added .augmentignore file with best practices
* Added configuration files for Cursor, Windsurf, v0, and Cline IDEs
* Added more design file formats to .gitignore
* Added .aiconfig file for general AI IDE compatibility

= 1.6.16 =
* Updated CI configuration files with correct plugin slugs
* Updated CHANGELOG.md with all recent versions
* Fixed outdated references to plugin-reference-cleaner

= 1.6.15 =
* Moved AI workflow documentation to root directory for better visibility
* Consolidated duplicate workflow files
* Improved organization of development documentation

= 1.6.14 =
* Updated documentation to consistently use "Remove Notice" instead of "Remove Reference"
* Added design file extensions to .gitignore (.pxd, .afdesign, .afphoto, .afpub)
* Improved explanation of how the plugin works
* Ensured consistent terminology across all documentation

= 1.6.13 =
* Code cleanup and optimization
* Improved Git Updater integration
* Fixed author display in plugin information
* Ensured compatibility with WordPress 6.4

= 1.6.12 =
* Added WP ALLSTARS as a co-author
* Updated author information and links
* Added author websites to plugin description
* Fixed issue with multiple author URLs

= 1.6.11 =
* CRITICAL FIX: Completely removed auto-deactivation prevention code that was causing fatal errors
* Simplified plugin functionality to focus on core features only
* Improved compatibility with various WordPress configurations
* Ensured plugin works correctly when other plugins are deleted

= 1.6.10 =
* Fixed critical error that could occur when a plugin folder is deleted
* Improved error handling with try/catch blocks
* Added more specific checks for the plugins page
* Enhanced compatibility with various WordPress configurations
* Made the code more defensive to prevent potential issues

= 1.6.9 =
* Fixed issue with notices not appearing below WordPress error messages
* Improved JavaScript detection of WordPress error notices
* Prevented WordPress from automatically clearing error notices on page refresh
* Added multiple timing attempts to ensure notices appear correctly
* Enhanced error notice targeting for better compatibility

= 1.6.8 =
* Fixed notice positioning to appear directly below WordPress error messages
* Improved notice width to match WordPress error messages
* Updated explanatory text for better clarity
* Fixed issue with notices not appearing in some cases
* Improved JavaScript detection of WordPress error messages

= 1.6.7 =
* Fixed duplicate notices issue by removing PHP-generated notice
* Simplified notice system to only show one notice below WordPress error
* Ensured consistent terminology with "Remove Notice" text
* Optimized plugin detection with caching to improve performance
* Fixed JavaScript to correctly handle multiple error messages

= 1.6.6 =
* Fixed issue with "Remove Notice" link not appearing on missing plugin rows
* Fixed issue with automatic removal of plugin references without user action
* Fixed notice positioning to ensure it appears below error messages
* Restored pointer triangle to indicate relationship with error message
* Improved detection of missing plugins in the plugin list
* Enhanced scroll functionality to work with all plugin types

= 1.6.5 =
* Fixed duplicate notices issue - now only one notice appears below error messages
* Changed notice heading to "Fix Plugin Does Not Exist Notices ☝️"
* Updated explanatory text to be more clear about the removal process
* Changed "Remove Reference" link text to "Remove Notice" for better clarity
* Made "(File Missing)" text bold and red for better visibility
* Fixed scroll functionality to work with all plugin rows
* Improved JavaScript to prevent multiple notices from appearing

= 1.6.4 =
* Updated version management to ensure consistent patch version increments
* Improved documentation for version update process
* Enhanced AI workflow files with detailed version increment instructions

= 1.6.3 =
* Fixed Git Updater repository URLs to use full repository paths
* Corrected Update URI configuration for proper update detection
* Improved version management following semantic versioning
* Updated organization name from 'WP All Stars' to 'WP ALLSTARS'
* Updated namespace from 'WPAllStars' to 'WPALLSTARS'

= 1.6.2 =
* Updated POT file version for consistency
* Improved JavaScript localization with proper fallbacks
* Enhanced code quality for WordPress.org submission
* Added Git Updater configuration with Update URI
* Added update server URL configuration

= 1.6.1 =
* Added AI assistant guide and workflow documentation
* Added detailed release process documentation
* Added feature development guidelines
* Added bug fixing procedures
* Added code review standards

= 1.6.0 =
* Added full translation support with POT file
* Added JavaScript localization for better multilingual support
* Added plugin constants for improved code organization
* Added Git Updater support for updates from GitHub and Gitea
* Updated code to follow WordPress internationalization best practices
* Improved asset loading with version constants
* Added smart update detection based on installation source

= 1.5.0 =
* Improved compatibility with WordPress 6.4
* Enhanced error detection for plugin references
* Minor UI improvements for better visibility
* Accessibility enhancements for screen readers

= 1.4.1 =
* Added FAQ about keeping the plugin installed after notices are cleared

= 1.4.0 =
* Updated plugin name and text domain
* Repository rename from plugin-reference-cleaner to fix-plugin-does-not-exist-notices

= 1.3.3 =
* Improved notification placement next to WordPress error messages
* Added "Click here to scroll" button that automatically locates missing plugins
* Enhanced reliability with multiple injection methods
* Added visual arrow pointing from notification to error message

= 1.3.2 =
* Added prominent notification directly below WordPress error messages
* Improved user guidance with visual cues to connect error and solution
* Added eye-catching styling to help users understand how to fix errors

= 1.3.1 =
* Added instructional notification explaining how to use the plugin
* Improved user guidance with step-by-step instructions
* Enhanced visual identification of missing plugins

= 1.3.0 =
* Complete redesign for maximum compatibility with all WordPress themes
* Now adds missing plugins directly to the plugins list table
* Uses standard WordPress admin UI patterns instead of DOM manipulation
* Added "Remove Reference" action link in the plugins list
* Significantly improved reliability across all WordPress configurations

= 1.2.4 =
* Fixed compatibility with more WordPress admin themes
* Added advanced DOM traversal to find error messages
* Implemented fallback mechanisms to ensure button appears
* Added detailed console logging for troubleshooting

= 1.2.3 =
* Fixed button not appearing in some WordPress admin themes
* Improved error message detection for greater compatibility
* Enhanced DOM traversal to find notification elements

= 1.2.2 =
* Fixed timeout issue during plugin activation
* Improved hook management to prevent potential infinite recursion
* Optimized performance by only loading on plugins page

= 1.2.1 =
* Fixed typos in documentation
* Improved text clarity
* Added question mark to first sentence for better readability

= 1.2 =
* Improved documentation with detailed explanation
* Added SQL reference for technical users
* Suggested potential inclusion in WordPress core

= 1.1 =
* Improved error handling
* Added support for multisite installations
* Enhanced security with proper capability checks

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.6.18 =
Optimized AI IDE configuration files for better efficiency and compatibility.

= 1.6.17 =
Added configuration files for AI-powered IDEs and improved compatibility with development tools.

= 1.6.16 =
Updated CI configuration files and fixed outdated references to the previous plugin name.

= 1.6.15 =
Improved organization of development documentation with consolidated AI workflow files.

= 1.6.14 =
Improved documentation with consistent terminology and better explanation of how the plugin works.

= 1.6.13 =
Code cleanup, improved Git Updater integration, and ensured compatibility with WordPress 6.4.

= 1.6.12 =
Added WP ALLSTARS as a co-author and updated author information.

= 1.6.11 =
URGENT CRITICAL FIX: Completely removes code that was causing fatal errors. If you're experiencing the "critical error" message, this update will resolve it.

= 1.6.3 =
Fixed Git Updater repository URLs and updated organization naming for consistent branding across all platforms!

= 1.6.2 =
Improved JavaScript localization, enhanced code quality, and added Git Updater configuration for seamless updates!

= 1.6.1 =
Added comprehensive AI assistant guide and workflow documentation for improved development processes!

= 1.6.0 =
Added full translation support and Git Updater compatibility for direct updates from GitHub and Gitea!

= 1.5.0 =
Improved compatibility with WordPress 6.4 and accessibility enhancements for screen readers!

= 1.3.3 =
Major usability improvement with auto-scroll feature to help find missing plugins in your list!

= 1.3.0 =
Completely redesigned for better compatibility with all WordPress themes - now works with any WordPress installation!

= 1.2.2 =
Important stability fix - resolves timeout issues during plugin activation!

== Support ==

For support, please visit https://wpallstars.com