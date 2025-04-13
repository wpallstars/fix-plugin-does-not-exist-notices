# GU Branch Fix

A simple WordPress plugin to fix Git Updater branch issues for plugins using 'main' instead of 'master'.

## Description

This small utility plugin addresses an issue with Git Updater where it defaults to using 'master' as the primary branch name, while many modern repositories use 'main' as their primary branch.

The plugin adds filters to:
1. Change the branch from 'master' to 'main' for specific plugins
2. Fix API URLs by replacing '/master/' with '/main/'
3. Fix download links by replacing '/master.zip' with '/main.zip'

## Installation

1. Upload the plugin files to the `/wp-content/plugins/gu-branch-fix` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. No configuration is needed - it works automatically.

## Usage

This plugin is specifically designed to work with the "Fix 'Plugin file does not exist' Notices" plugin, but can be easily modified to work with any plugin that uses 'main' as its primary branch.

To add support for other plugins, simply modify the conditional checks in the filter functions.

## Changelog

### 1.0.0
* Initial release

## License

This plugin is licensed under the GPL v2 or later.
