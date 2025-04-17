# Usage Instructions

This page provides detailed instructions on how to use the "Fix 'Plugin file does not exist' Notices" plugin to clean up orphaned plugin references in your WordPress installation.

## How the Plugin Works

The plugin works automatically in the background without requiring any configuration:

1. It detects orphaned plugin references in your WordPress database
2. It adds these missing plugins to your plugins list with a "Remove Notice" action link
3. It allows you to safely clean up invalid plugin references directly from the plugins page

## Basic Usage

### Viewing Orphaned Plugin References

1. After installing and activating the plugin, navigate to **Plugins** in your WordPress admin dashboard.
2. The plugin automatically scans for orphaned plugin references.
3. Any detected orphaned references will appear in your plugins list with "(File Missing)" next to their name.
4. Each orphaned plugin will have a description explaining that it's still marked as active in your database but its files can't be found.

### Cleaning Up Orphaned References

#### Individual Cleanup

1. In the plugins list, locate the orphaned plugin reference you want to clean up (marked with "File Missing").
2. Click the **Remove Notice** link under the plugin name.
3. The plugin will remove the orphaned reference from your WordPress database.
4. A success message will be displayed once the cleanup is complete.
5. The plugin reference will no longer appear in your plugins list, and the error notice will be eliminated.

## Update Source Selection

The plugin allows you to choose your preferred update source:

1. In the plugins list, find the "Fix 'Plugin file does not exist' Notices" plugin.
2. Click the **Update Source** link under the plugin name.
3. A modal dialog will appear with three options:
   - **WordPress.org**: Get updates from the official WordPress plugin repository
   - **GitHub**: Get updates from the GitHub repository
   - **Gitea**: Get updates from the Gitea repository
4. Select your preferred update source and click **Save**.
5. The plugin will now check for updates from your selected source.

## No Settings Page

This plugin intentionally has no settings page or admin menu. It works automatically in the background and provides all functionality directly on the plugins page where it's needed most.

## Multisite Compatibility

The plugin is fully compatible with WordPress multisite installations:

- In a network admin context, it detects and fixes orphaned network-activated plugin references
- In a site admin context, it detects and fixes orphaned site-activated plugin references

## Best Practices

To prevent orphaned plugin references in the future:

1. Always use the WordPress admin interface to deactivate and delete plugins.
2. If you need to manually delete a plugin, make sure to deactivate it first through the WordPress admin.
3. Regularly scan for orphaned plugin references, especially after making changes to your plugins.
4. Keep the "Fix 'Plugin file does not exist' Notices" plugin updated to ensure it can handle the latest WordPress changes.
