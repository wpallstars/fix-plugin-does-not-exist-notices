# Fix 'Plugin file does not exist' Notices

Welcome to the documentation wiki for the "Fix 'Plugin file does not exist' Notices" WordPress plugin.

This plugin helps WordPress administrators eliminate the annoying "Plugin file does not exist" notices that appear in the WordPress admin area when plugins are removed incorrectly.

## Quick Links

- [Installation Guide](Installation-Guide)
- [Usage Instructions](Usage-Instructions)
- [Frequently Asked Questions](Frequently-Asked-Questions)
- [Troubleshooting](Troubleshooting)
- [Contributing](Contributing)
- [Changelog](Changelog)

## About This Plugin

The "Fix 'Plugin file does not exist' Notices" plugin addresses a common issue in WordPress where removing a plugin by deleting its directory (instead of using the proper deactivation and deletion process) leaves orphaned references in the WordPress database. These orphaned references cause WordPress to display error notices in the admin area, which can be confusing and annoying for site administrators.

This plugin provides a simple, effective solution by:

1. Automatically detecting orphaned plugin references in the WordPress database
2. Adding these missing plugins to your plugins list with a "Remove Notice" action link
3. Allowing you to safely clean up invalid plugin references directly from the plugins page

## Key Features

- **Automatic Detection**: Identifies orphaned plugin references in the WordPress database
- **One-Click Cleanup**: Removes the orphaned references with a single click via the "Remove Notice" action link
- **Seamless Integration**: Works directly within the WordPress plugins page
- **No Settings Page**: Zero configuration required - just install and it works
- **Multisite Compatible**: Works with both single-site and multisite WordPress installations
- **Update Source Selection**: Choose between WordPress.org, GitHub, or Gitea for plugin updates

## Getting Started

To get started with the plugin, check out the [Installation Guide](Installation-Guide) and [Usage Instructions](Usage-Instructions).

## Support

If you encounter any issues or have questions about the plugin, please check the [Frequently Asked Questions](Frequently-Asked-Questions) and [Troubleshooting](Troubleshooting) sections. If you still need help, you can [open an issue](https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/issues) on GitHub.
