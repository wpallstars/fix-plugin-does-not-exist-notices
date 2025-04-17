# Frequently Asked Questions

This page answers common questions about the "Fix 'Plugin file does not exist' Notices" plugin.

## General Questions

### What does this plugin do?

This plugin identifies and removes orphaned plugin references in your WordPress database that cause the "Plugin file does not exist" notices to appear in your admin dashboard. These notices typically occur when plugins are removed incorrectly (by deleting the plugin files without properly deactivating them first).

### Will this plugin affect my active plugins?

No, the plugin is designed to only identify and remove references to plugins that no longer exist in your WordPress installation. It will not affect any active, properly functioning plugins.

### Is it safe to use this plugin?

Yes, the plugin is designed to be safe and non-destructive. It only removes database entries that are causing errors and have no corresponding plugin files. The plugin does not modify any core WordPress files or active plugin files.

### Does this plugin work with multisite installations?

Yes, the plugin is fully compatible with WordPress multisite installations. It can clean up orphaned plugin references across all sites in your network.

## Technical Questions

### How does the plugin detect orphaned plugin references?

The plugin scans the `active_plugins` and `active_sitewide_plugins` options in your WordPress database and checks if the referenced plugin files actually exist in your WordPress installation. If a referenced plugin file does not exist, it is identified as an orphaned reference.

### What database tables does this plugin modify?

The plugin only modifies the `wp_options` table (or the equivalent options table in multisite installations). Specifically, it updates the `active_plugins` and `active_sitewide_plugins` options to remove references to non-existent plugins.

### Will this plugin slow down my website?

No, the plugin has a minimal performance impact. The scanning process runs in the admin area only and does not affect your website's front-end performance. The automatic scanning is scheduled to run during low-traffic periods to minimize any potential impact.

### Can I use this plugin with caching plugins?

Yes, this plugin is compatible with all major caching plugins. Since it only operates in the WordPress admin area and modifies database entries that are not typically cached, it should not interfere with your caching setup.

## Usage Questions

### How often should I run the plugin?

We recommend running the plugin:
- After manually deleting any plugins
- When you see "Plugin file does not exist" notices in your admin dashboard
- As part of your regular WordPress maintenance routine (monthly or quarterly)

You can also configure the plugin to run automatic scans on a schedule of your choosing.

### Can I automate the cleanup process?

Yes, you can configure the plugin to automatically clean up orphaned plugin references by enabling the "Automatic Cleanup" option in the plugin settings. You can also use the WP-CLI commands to include the cleanup process in your automated maintenance scripts.

### Does the plugin create logs of its actions?

Yes, the plugin maintains logs of all scanning and cleanup actions. You can view these logs in the plugin's dashboard or download them for reference. This is particularly useful for troubleshooting or for maintaining an audit trail of changes to your WordPress installation.

### Can I undo the changes made by the plugin?

The plugin does not currently provide an "undo" feature, as the changes it makes are typically necessary to fix errors in your WordPress installation. However, if you're concerned about potential issues, you can back up your database before running the plugin.

## Troubleshooting

### The plugin isn't detecting any orphaned references, but I still see notices

This could happen if:
- The notices are coming from a different source
- The plugin references are stored in a non-standard location
- Your WordPress installation has custom modifications

Please [open an issue](https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/issues) on GitHub with details about your environment and the specific notices you're seeing.

### I'm getting an error when trying to run the plugin

If you encounter errors when running the plugin, please check:
- Your WordPress version (the plugin requires WordPress 5.0 or higher)
- Your PHP version (the plugin requires PHP 7.0 or higher)
- Your server's memory limit (the plugin requires at least 64MB of memory)

If you continue to experience issues, please [open an issue](https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/issues) on GitHub with details about your environment and the specific error you're encountering.
