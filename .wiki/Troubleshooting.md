# Troubleshooting

This page provides solutions to common issues you might encounter when using the "Fix 'Plugin file does not exist' Notices" plugin.

## Common Issues and Solutions

### Plugin Doesn't Detect Any Orphaned References

**Issue**: The plugin doesn't detect any orphaned references, but you still see "Plugin file does not exist" notices in your WordPress admin.

**Possible Causes and Solutions**:

1. **Different Source of Notices**:
   - The notices might be coming from a different source, not related to orphaned plugin references.
   - Check the exact wording of the notices and look for clues about their origin.
   - Check if the notices appear on specific pages or under specific conditions.

2. **Non-Standard Storage Location**:
   - Some plugins or themes might store plugin references in non-standard locations.
   - Try enabling the "Deep Scan" option in the plugin settings to scan additional locations.

3. **Custom WordPress Modifications**:
   - If your WordPress installation has custom modifications, they might be affecting how plugin references are stored or displayed.
   - Consult with your developer or hosting provider about any custom modifications.

4. **Caching Issues**:
   - Clear your browser cache and any server-side caches.
   - Disable caching plugins temporarily to see if that resolves the issue.

### Plugin Scan Fails or Times Out

**Issue**: The plugin scan fails to complete or times out.

**Possible Causes and Solutions**:

1. **Server Resource Limitations**:
   - Your server might have resource limitations (memory, execution time) that prevent the scan from completing.
   - Try increasing the PHP memory limit and execution time in your `wp-config.php` file:
     ```php
     define('WP_MEMORY_LIMIT', '256M');
     define('WP_MAX_MEMORY_LIMIT', '512M');
     set_time_limit(300); // 5 minutes
     ```

2. **Large Database**:
   - If you have a large database, the scan might take longer to complete.
   - Try using the WP-CLI command instead, which is more efficient for large databases:
     ```
     wp fix-plugin-notices scan
     ```

3. **Server Configuration**:
   - Some server configurations might block long-running processes.
   - Contact your hosting provider to check if there are any restrictions on script execution time.

### Cleanup Doesn't Remove Notices

**Issue**: The plugin successfully identifies and cleans up orphaned references, but you still see notices.

**Possible Causes and Solutions**:

1. **Cached Notices**:
   - The notices might be cached in your browser or by a caching plugin.
   - Clear your browser cache and any server-side caches.
   - Disable caching plugins temporarily to see if that resolves the issue.

2. **Multiple Sources of Notices**:
   - There might be multiple sources of notices, and the plugin only addressed some of them.
   - Run the scan again to see if it detects any additional orphaned references.
   - Check the exact wording of the remaining notices to identify their source.

3. **Plugin Conflicts**:
   - Another plugin might be interfering with the cleanup process.
   - Try temporarily deactivating other plugins to see if that resolves the issue.

4. **Database Corruption**:
   - In rare cases, database corruption might prevent the cleanup from being effective.
   - Consider running a database repair using a tool like WP-CLI:
     ```
     wp db repair
     ```

### Plugin Causes Errors After Cleanup

**Issue**: After using the plugin to clean up orphaned references, you experience errors or unexpected behavior.

**Possible Causes and Solutions**:

1. **Dependent Plugins**:
   - Some plugins might depend on the orphaned references that were removed.
   - Check your active plugins to see if any of them might have dependencies.
   - Consider restoring from a backup if necessary.

2. **Custom Code Dependencies**:
   - Custom code in your theme or other plugins might depend on the orphaned references.
   - Check your theme's `functions.php` file and any custom plugins for dependencies.

3. **Incomplete Cleanup**:
   - The cleanup process might have been incomplete, leaving your database in an inconsistent state.
   - Try running the cleanup process again to ensure all orphaned references are removed.

## Advanced Troubleshooting

### Debugging Mode

You can enable debugging mode to get more detailed information about the plugin's operations:

1. Add the following code to your `wp-config.php` file:
   ```php
   define('WPFPDEN_DEBUG', true);
   ```

2. Run the plugin scan and cleanup processes.

3. Check the debug log file in the plugin's `logs` directory for detailed information.

### Manual Database Inspection

If you're comfortable working with the WordPress database, you can manually inspect the relevant options:

1. Use a tool like phpMyAdmin to access your WordPress database.

2. Look at the `wp_options` table (or the equivalent options table in multisite installations).

3. Check the values of the `active_plugins` and `active_sitewide_plugins` options.

4. Look for references to plugin files that don't exist in your `wp-content/plugins` directory.

### Getting Help

If you've tried the solutions above and are still experiencing issues, please:

1. Gather as much information as possible about your environment:
   - WordPress version
   - PHP version
   - Server information
   - Active plugins
   - Exact wording of any error messages or notices

2. [Open an issue](https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/issues) on GitHub with all the information you've gathered.

3. Be prepared to provide additional information if requested by the plugin developers.
