# Usage Instructions

This page provides detailed instructions on how to use the "Fix 'Plugin file does not exist' Notices" plugin to clean up orphaned plugin references in your WordPress installation.

## Accessing the Plugin

After installing and activating the plugin, you can access it by navigating to **Tools > Fix Plugin Notices** in your WordPress admin dashboard.

## Plugin Interface

The plugin interface consists of the following sections:

### Dashboard

The dashboard provides an overview of:

- Number of orphaned plugin references detected
- Last scan date and time
- Quick action buttons for common tasks

### Scan Results

This section displays a list of all detected orphaned plugin references, including:

- Plugin name (if available)
- Plugin file path
- Status (active/inactive)
- Action buttons for each entry

### Settings

The settings section allows you to configure:

- Automatic scanning frequency
- Notification preferences
- Logging options
- Advanced cleanup options

## Basic Usage

### Scanning for Orphaned Plugin References

1. Navigate to **Tools > Fix Plugin Notices**.
2. Click the **Scan Now** button.
3. The plugin will scan your WordPress database for orphaned plugin references.
4. Once the scan is complete, the results will be displayed in the Scan Results section.

### Cleaning Up Orphaned References

#### Individual Cleanup

1. In the Scan Results section, locate the orphaned plugin reference you want to clean up.
2. Click the **Fix** button next to the entry.
3. The plugin will remove the orphaned reference from your WordPress database.
4. A success message will be displayed once the cleanup is complete.

#### Bulk Cleanup

1. In the Scan Results section, check the boxes next to the orphaned plugin references you want to clean up.
2. Select "Fix Selected" from the Bulk Actions dropdown.
3. Click the **Apply** button.
4. The plugin will remove all selected orphaned references from your WordPress database.
5. A success message will be displayed once the cleanup is complete.

#### Automatic Cleanup

You can configure the plugin to automatically clean up orphaned plugin references:

1. Navigate to the Settings section.
2. Enable the "Automatic Cleanup" option.
3. Configure the frequency and conditions for automatic cleanup.
4. Click **Save Changes**.

## Advanced Usage

### Command Line Interface

The plugin provides a WP-CLI command for scanning and cleaning up orphaned plugin references:

```
wp fix-plugin-notices scan
wp fix-plugin-notices cleanup
wp fix-plugin-notices cleanup --all
```

For more information on using the command line interface, see the [Command Line Interface](Command-Line-Interface) documentation.

### Hooks and Filters

The plugin provides several hooks and filters that allow you to customize its behavior:

```php
// Example: Customize the scan frequency
add_filter('wpfpden_scan_frequency', function($frequency) {
    return 'daily'; // Options: hourly, daily, weekly
});
```

For more information on available hooks and filters, see the [Hooks and Filters](Hooks-and-Filters) documentation.

## Best Practices

To prevent orphaned plugin references in the future:

1. Always use the WordPress admin interface to deactivate and delete plugins.
2. If you need to manually delete a plugin, make sure to deactivate it first through the WordPress admin.
3. Regularly scan for orphaned plugin references, especially after making changes to your plugins.
4. Keep the "Fix 'Plugin file does not exist' Notices" plugin updated to ensure it can handle the latest WordPress changes.
