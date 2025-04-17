# Changelog

This page documents all notable changes to the "Fix 'Plugin file does not exist' Notices" plugin.

## Version 2.4.0 (2025-04-17)
- Added: Comprehensive documentation for working in multi-repository workspaces
- Added: Guidelines to prevent feature hallucination in multi-repo environments
- Added: New .ai-workflows/multi-repo-workspace.md file with detailed best practices
- Improved: AI assistant documentation with repository context verification
- Improved: Wiki documentation to accurately reflect plugin functionality

## Version 2.3.1 (2025-04-16)
- Updated: Tested compatibility with WordPress 6.8
- Improved: Documentation to reflect WordPress 6.8 compatibility

## Version 2.3.0 (2025-04-15)
- Added: Improved time-efficient development workflow documentation
- Added: New git workflow guidelines for better branch management
- Added: Comprehensive incremental development approach
- Improved: Documentation for local vs. remote testing
- Improved: Version management process for more efficient development

## Version 2.2.5 (2025-04-14)
- Added: Documentation for the developer preferences memory file in .ai-workflows/
- Improved: AI assistant instructions for maintaining developer preferences
- Updated: Version numbers across all files for consistency

## Version 2.2.4 (2025-04-14)
- Added: Developer preferences memory file for AI assistants
- Improved: AI assistant documentation with instructions for maintaining developer preferences
- Updated: WordPress.org documentation with correct plugin slug and version numbers

## Version 2.2.3 (2025-04-14)
- Changed: Moved admin-specific files to admin/lib directory for better organization
- Updated: Namespaces to reflect the new file locations
- Added: Comprehensive folder structure documentation
- Fixed: File references in the main plugin file

## Version 2.2.2-stable (2025-04-14)
- Changed: Renamed includes files to lowercase for consistency with the rest of the codebase
- Removed: Redundant Git Updater patches and version-fix.js as they're no longer needed
- Improved: Documentation for Git Updater integration and release process
- Fixed: Token-efficient documentation with references to .ai-workflows files
- Added: Comprehensive release process documentation with emphasis on merging to main branch

## Version 2.2.1 (2025-04-14)
- Changed: Commented out version-fix.js script as it's no longer needed after refactoring
- Fixed: Version consistency across all files

## Version 2.2.0 (2025-04-14)
- Added: Completely refactored plugin to use OOP best practices
- Added: New class structure with proper namespaces
- Improved: Code organization and maintainability
- Improved: Better separation of concerns with dedicated classes
- Changed: Changed "Choose Update Source" link to just "Update Source"
- Fixed: Close button in the update source modal
- Added: Links to the main page for each update source in the modal
- Changed: Replaced all instances of "WP ALLSTARS" with "WPALLSTARS"

## Version 2.1.1 (2025-04-13)
- Added: New "Choose Update Source" feature allowing users to select their preferred update source (WordPress.org, GitHub, or Gitea)
- Added: Modal dialog with detailed information about each update source option
- Added: Visual indicator showing the currently selected update source
- Fixed: Updated heading styles in CHANGELOG.md for better readability
- Fixed: Corrected dates in changelog to use 2025 instead of 2024
- Improved: Documentation improvements for better clarity
- Improved: Enhanced Git Updater integration with user-selectable update sources

## Version 2.1.0 (2025-04-13)
- Changed: Minor version bump for Git Updater compatibility
- Improved: Error handling for Git Updater integration
- Improved: Type checking in branch fix functions
- Improved: Documentation for Git Updater installation and cache refreshing

## Version 2.0.13 (2025-04-12)
- Fixed: Critical error when Git Updater passes an object instead of a string to API URL filter
- Fixed: Type checking in branch fix functions to handle both string and object inputs
- Improved: Error handling for Git Updater integration
- Improved: Documentation for Git Updater installation and cache refreshing

## Version 2.0.12 (2025-04-11)
- Fixed: Integrated Git Updater branch fix directly into main plugin
- Removed: Separate "GU Branch Fix" plugin (no longer needed)
- Added: Documentation explaining branch fix integration
- Improved: Compatibility with Git Updater plugin
- Improved: Deploy script to remove separate branch fix plugin

## Version 2.0.11 (2025-04-10)
- Added: Created separate "GU Branch Fix" plugin to fix Git Updater branch issues
- Added: Deploy script for local testing
- Fixed: Git Updater branch issues with 'main' vs 'master' branch names
- Improved: Compatibility with Git Updater plugin

## Version 2.0.10 (2025-04-09)
- Fixed: Plugin details popup version display issue with Git Updater integration
- Added: JavaScript-based solution to ensure correct version display in plugin details
- Improved: Version consistency across all plugin views
- Improved: Enhanced cache busting for plugin information API

## Version 2.0.9 (2025-04-08)
- Fixed: Plugin details popup now correctly shows version and author information
- Fixed: Added support for both old and new plugin slugs to fix caching issues
- Improved: Cache clearing mechanism to ensure plugin details are always up-to-date
- Improved: Enhanced version display in plugin details popup

## Version 2.0.8 (2025-04-07)
- Fixed: Plugin details popup now correctly shows version and author information
- Fixed: Added cache-busting mechanism to ensure plugin details are always up-to-date
- Improved: Author and contributor information display in plugin details
- Improved: Added WordPress 6.5 compatibility indicator

## Version 2.0.7 (2025-04-06)
- Changed: Additional text improvements and minor fixes

## Version 2.0.6 (2025-04-05)
- Changed: Text improvements and minor fixes

## Version 2.0.5 (2025-04-04)
- Fixed: Display correct version in plugin details popup

## Version 2.0.4 (2025-04-03)
- Fixed: Display actual plugin version instead of 'N/A' for missing plugins in plugin details view

## Version 2.0.2 (2025-04-02)
- Changed: Consolidated WordPress.org assets into .wordpress-org directory
- Improved: Organization of assets for WordPress.org submission
- Updated: .wordpress-org/README.md with comprehensive information

## Version 2.0.1 (2025-04-01)
- Added: Contributing section to readme.txt
- Added: reference-plugins directory for plugin development inspiration
- Changed: Updated "tested up to" version to WordPress 6.7.2
- Improved: .gitattributes with comprehensive file handling
- Improved: Enhanced documentation organization

## Version 2.0.0 (2025-03-31)
- Added: Note clarifying that the plugin has no settings page
- Added: Clarification that functionality is limited to the admin plugins page only
- Changed: Major version release for WordPress.org submission
- Changed: Finalized all assets and documentation for public release

## Version 1.0 (2025-03-15)
- Initial release
- Added: "Remove Reference" button for plugin deactivation error notices
- Added: AJAX processing for reference removal
