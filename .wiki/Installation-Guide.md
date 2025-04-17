# Installation Guide

This guide will walk you through the process of installing the "Fix 'Plugin file does not exist' Notices" plugin on your WordPress site.

## Requirements

Before installing the plugin, make sure your WordPress installation meets the following requirements:

- WordPress 5.0 or higher
- PHP 7.0 or higher
- MySQL 5.6 or higher / MariaDB 10.0 or higher

## Installation Methods

### Method 1: Install via WordPress Admin (Recommended)

1. Log in to your WordPress admin dashboard.
2. Navigate to **Plugins > Add New**.
3. In the search field, type "Fix Plugin Does Not Exist Notices".
4. Look for the plugin by "WP All Stars" and click **Install Now**.
5. After installation is complete, click **Activate** to activate the plugin.

### Method 2: Install via WordPress.org

1. Visit the [plugin page on WordPress.org](https://wordpress.org/plugins/wp-fix-plugin-does-not-exist-notices/).
2. Click the **Download** button to download the plugin ZIP file.
3. Log in to your WordPress admin dashboard.
4. Navigate to **Plugins > Add New**.
5. Click the **Upload Plugin** button at the top of the page.
6. Click **Choose File** and select the ZIP file you downloaded.
7. Click **Install Now**.
8. After installation is complete, click **Activate** to activate the plugin.

### Method 3: Install via Git

If you prefer to install the plugin via Git, you can clone the repository directly into your WordPress plugins directory:

1. Open a terminal or command prompt.
2. Navigate to your WordPress plugins directory:
   ```
   cd /path/to/your/wordpress/wp-content/plugins/
   ```
3. Clone the repository:
   ```
   git clone https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices.git
   ```
4. Log in to your WordPress admin dashboard.
5. Navigate to **Plugins**.
6. Find "Fix 'Plugin file does not exist' Notices" in the list and click **Activate**.

## Post-Installation

After installing and activating the plugin, you should:

1. Navigate to **Plugins** in your WordPress admin dashboard.
2. The plugin will automatically scan for orphaned plugin references.
3. Any detected orphaned references will appear in your plugins list with "(File Missing)" next to their name.
4. Click the **Remove Notice** link under each orphaned plugin to clean it up.

## Troubleshooting Installation Issues

If you encounter any issues during installation, please check the following:

- Make sure your WordPress installation meets the minimum requirements.
- Check that you have sufficient permissions to install plugins on your WordPress site.
- Verify that your server has enough memory allocated to WordPress.
- Ensure that your server allows outbound connections if installing via the WordPress admin.

If you continue to experience issues, please [open an issue](https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/issues) on GitHub with details about your environment and the specific error you're encountering.
