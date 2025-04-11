<?php
/**
 * Plugin Updater
 *
 * @package FixPluginDoesNotExistNotices
 */

namespace WPAllStars\FixPluginDoesNotExistNotices;

/**
 * Class Updater
 *
 * Handles plugin updates from different sources based on installation origin.
 */
class Updater {

    /**
     * Plugin file path
     *
     * @var string
     */
    private $plugin_file;

    /**
     * Installation source
     *
     * @var string
     */
    private $source;

    /**
     * Constructor
     *
     * @param string $plugin_file Main plugin file path.
     */
    public function __construct($plugin_file) {
        $this->plugin_file = $plugin_file;
        $this->source = $this->determine_installation_source();
        $this->init();
    }

    /**
     * Initialize the updater based on the installation source
     *
     * @return void
     */
    public function init() {
        // Only initialize Git Updater if not installed from WordPress.org
        if ($this->source !== 'wordpress.org') {
            $this->init_git_updater();
        }
    }

    /**
     * Determine the installation source of the plugin
     *
     * @return string Installation source: 'github', 'gitea', or 'wordpress.org'
     */
    private function determine_installation_source() {
        // Default to WordPress.org
        $source = 'wordpress.org';

        // Check if the plugin was installed from GitHub
        if ($this->is_github_installation()) {
            $source = 'github';
        }
        // Check if the plugin was installed from Gitea
        elseif ($this->is_gitea_installation()) {
            $source = 'gitea';
        }

        return $source;
    }

    /**
     * Check if the plugin was installed from GitHub
     *
     * @return bool
     */
    private function is_github_installation() {
        // Check for GitHub-specific markers in the plugin directory
        $plugin_dir = plugin_dir_path($this->plugin_file);

        // Look for .git directory with GitHub remote
        if (file_exists($plugin_dir . '.git')) {
            $git_config = @file_get_contents($plugin_dir . '.git/config');
            if ($git_config && strpos($git_config, 'github.com') !== false) {
                return true;
            }
        }

        // Check for GitHub-specific files that might indicate it was downloaded from GitHub
        if (file_exists($plugin_dir . '.github')) {
            return true;
        }

        return false;
    }

    /**
     * Check if the plugin was installed from Gitea
     *
     * @return bool
     */
    private function is_gitea_installation() {
        // Check for Gitea-specific markers in the plugin directory
        $plugin_dir = plugin_dir_path($this->plugin_file);

        // Look for .git directory with Gitea remote
        if (file_exists($plugin_dir . '.git')) {
            $git_config = @file_get_contents($plugin_dir . '.git/config');
            if ($git_config && strpos($git_config, 'gitea.wpallstars.com') !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Initialize Git Updater Lite
     *
     * @return void
     */
    private function init_git_updater() {
        // Check if the Git Updater Lite class exists (composer autoload)
        if (!class_exists('\\Fragen\\Git_Updater\\Lite')) {
            // Try to include the autoloader
            $autoloader = dirname($this->plugin_file) . '/vendor/autoload.php';
            if (file_exists($autoloader)) {
                require_once $autoloader;
            } else {
                return; // Can't load Git Updater Lite
            }
        }

        // Set the update server based on the installation source
        add_filter('gul_update_server', function() {
            if ($this->source === 'github') {
                return 'https://github.com/wpallstars/fix-plugin-does-not-exist-notices'; // GitHub repository URL
            } elseif ($this->source === 'gitea') {
                return 'https://gitea.wpallstars.com/wpallstars/fix-plugin-does-not-exist-notices'; // Gitea repository URL
            }
            return '';
        });

        // Initialize Git Updater Lite
        if (class_exists('\\Fragen\\Git_Updater\\Lite')) {
            (new \Fragen\Git_Updater\Lite($this->plugin_file))->run();
        }
    }
}
