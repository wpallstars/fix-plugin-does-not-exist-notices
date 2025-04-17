# How It Works

This page explains the technical details of how the "Fix 'Plugin file does not exist' Notices" plugin works to identify and clean up orphaned plugin references in your WordPress installation.

## Understanding the Problem

When a plugin is properly deactivated and deleted through the WordPress admin interface, WordPress removes all references to that plugin from the database. However, if a plugin is deleted by directly removing its files (via FTP, SSH, or file manager), WordPress doesn't know that the plugin has been removed.

As a result, WordPress continues to try to load the plugin during initialization, but since the plugin files no longer exist, it generates a "Plugin file does not exist" notice in the admin dashboard. These notices can be confusing and annoying, especially for non-technical users.

## The Solution

The "Fix 'Plugin file does not exist' Notices" plugin addresses this issue by:

1. Scanning the WordPress database for references to plugins
2. Checking if the referenced plugin files actually exist
3. Providing a user-friendly interface to remove references to non-existent plugins
4. Automatically cleaning up the database to prevent the notices from appearing

## Technical Implementation

### Scanning Process

The plugin scans the following locations in the WordPress database:

1. **Options Table**:
   - `active_plugins` option: Contains a serialized array of active plugins
   - `active_sitewide_plugins` option (for multisite): Contains a serialized array of network-activated plugins
   - `recently_activated` option: Contains a serialized array of recently deactivated plugins

2. **Site Options Table (for multisite)**:
   - `active_sitewide_plugins` site option: Contains a serialized array of network-activated plugins

3. **User Meta Table**:
   - `wp_user_settings` user meta: May contain references to plugins in user-specific settings

### Validation Process

For each plugin reference found, the plugin:

1. Extracts the plugin file path (e.g., `plugin-name/plugin-file.php`)
2. Constructs the full path to the plugin file (e.g., `/wp-content/plugins/plugin-name/plugin-file.php`)
3. Checks if the plugin file exists using PHP's `file_exists()` function
4. If the file doesn't exist, marks the reference as orphaned

### Cleanup Process

When cleaning up orphaned references, the plugin:

1. Retrieves the current value of the relevant option or meta
2. Deserializes the value (if it's serialized)
3. Removes the orphaned references from the data structure
4. Reserializes the value (if necessary)
5. Updates the option or meta with the new value

### Safety Measures

To ensure safety and prevent data corruption, the plugin:

1. Validates all data before and after modification
2. Uses WordPress core functions for database operations when possible
3. Implements proper error handling and logging
4. Provides undo capabilities through database backups
5. Follows WordPress coding standards and best practices

## Integration with WordPress

The plugin integrates with WordPress in the following ways:

### Admin Interface

- Adds a menu item under **Tools > Fix Plugin Notices**
- Provides a user-friendly interface for scanning and cleaning up orphaned references
- Displays detailed information about detected issues
- Offers bulk actions for efficient cleanup

### Hooks and Filters

- Uses WordPress action hooks to integrate with the admin interface
- Provides custom hooks and filters for developers to extend or modify functionality
- Integrates with WordPress cron for scheduled scans

### WP-CLI Integration

- Provides WP-CLI commands for scanning and cleaning up orphaned references
- Supports batch processing for large installations
- Offers verbose output for debugging and logging

## Performance Considerations

The plugin is designed with performance in mind:

- Scans are performed efficiently to minimize database queries
- Resource-intensive operations are batched to prevent timeouts
- Automatic scans are scheduled during low-traffic periods
- Caching is used where appropriate to improve performance

## Security Considerations

The plugin follows security best practices:

- All user inputs are properly sanitized and validated
- Database queries are prepared and escaped to prevent SQL injection
- Capability checks are performed to ensure only authorized users can perform actions
- Nonce verification is used to prevent CSRF attacks

## Compatibility

The plugin is designed to be compatible with:

- All WordPress versions from 5.0 and up
- Single-site and multisite WordPress installations
- Various hosting environments and server configurations
- Common caching and optimization plugins
- Popular security plugins
