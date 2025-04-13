# Branch Fix for Git Updater

## Important Note

The separate "GU Branch Fix" plugin is no longer needed. The functionality has been integrated directly into the main "Fix 'Plugin file does not exist' Notices" plugin.

## Integration Details

The main plugin now includes all the necessary Git Updater branch fixes:

1. Branch name override (changes 'master' to 'main')
2. API URL fixes (replaces '/master/' with '/main/' in API URLs)
3. Download link fixes (replaces '/master.zip' with '/main.zip')
4. Repository metadata overrides
5. Repository type data overrides

These fixes are implemented in the main plugin file (`wp-fix-plugin-does-not-exist-notices.php`) and are automatically loaded when the plugin is activated.

## Usage

Simply activate the main "Fix 'Plugin file does not exist' Notices" plugin, and the Git Updater branch fixes will be applied automatically. There is no need to activate a separate plugin.

## Troubleshooting

If you encounter any issues with Git Updater:

1. Make sure you have the latest version of the "Fix 'Plugin file does not exist' Notices" plugin
2. Deactivate any separate "GU Branch Fix" plugin if it's still installed
3. Use the "Refresh Cache" button in Git Updater to force it to update plugin information
