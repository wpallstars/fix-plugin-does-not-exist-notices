<?php
/**
 * Plugin Name: GU Branch Fix
 * Plugin URI: https://www.wpallstars.com
 * Description: Fixes Git Updater branch issues for plugins using 'main' instead of 'master'
 * Version: 1.0.0
 * Author: Marcus Quinn & WP ALLSTARS
 * Author URI: https://www.wpallstars.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Initialize Git Updater branch fixes
 */
function gu_branch_fix_init() {
    // Fix for Git Updater branch
    add_filter('gu_get_repo_branch', 'gu_branch_fix_branch', 999, 3);

    // Fix for Git Updater API URLs
    add_filter('gu_get_repo_api', 'gu_branch_fix_api_url', 999, 3);

    // Fix for Git Updater download URLs
    add_filter('gu_download_link', 'gu_branch_fix_download_link', 999, 3);
}

/**
 * Fix Git Updater branch issues
 *
 * This simple plugin adds a filter to change the branch from 'master' to 'main'
 * for the wp-fix-plugin-does-not-exist-notices plugin.
 *
 * @param string $branch The branch name
 * @param string $git The git service (github, gitlab, etc.)
 * @param object $repo The repository object
 * @return string The modified branch name
 */
function gu_branch_fix_branch($branch, $git, $repo) {
    if (isset($repo->slug) &&
        (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
         strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {
        return 'main';
    }
    return $branch;
}

/**
 * Fix Git Updater API URLs
 *
 * @param string $api_url The API URL
 * @param string $git The git service (github, gitlab, etc.)
 * @param object $repo The repository object
 * @return string The modified API URL
 */
function gu_branch_fix_api_url($api_url, $git, $repo) {
    if (isset($repo->slug) &&
        (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
         strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {
        return str_replace('/master/', '/main/', $api_url);
    }
    return $api_url;
}

/**
 * Fix Git Updater download URLs
 *
 * @param string $download_link The download URL
 * @param string $git The git service (github, gitlab, etc.)
 * @param object $repo The repository object
 * @return string The modified download URL
 */
function gu_branch_fix_download_link($download_link, $git, $repo) {
    if (isset($repo->slug) &&
        (strpos($repo->slug, 'wp-fix-plugin-does-not-exist-notices') !== false ||
         strpos($repo->slug, 'fix-plugin-does-not-exist-notices') !== false)) {
        return str_replace('/master.zip', '/main.zip', $download_link);
    }
    return $download_link;
}

// Hook into WordPress
add_action('plugins_loaded', 'gu_branch_fix_init');