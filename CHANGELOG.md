# Changelog

All notable changes to this project will be documented in this file.

## [2.0.11] - 2024-05-19
### Added
- Created separate "GU Branch Fix" plugin to fix Git Updater branch issues
- Added deploy script for local testing

### Fixed
- Git Updater branch issues with 'main' vs 'master' branch names
- Improved compatibility with Git Updater plugin

## [2.0.10] - 2024-05-18
### Fixed
- Plugin details popup version display issue with Git Updater integration
- Added JavaScript-based solution to ensure correct version display in plugin details

### Improved
- Version consistency across all plugin views
- Enhanced cache busting for plugin information API

## [2.0.9] - 2024-05-18
### Fixed
- Plugin details popup now correctly shows version and author information
- Added support for both old and new plugin slugs to fix caching issues

### Improved
- Cache clearing mechanism to ensure plugin details are always up-to-date
- Enhanced version display in plugin details popup

## [2.0.8] - 2024-05-17
### Fixed
- Plugin details popup now correctly shows version and author information
- Added cache-busting mechanism to ensure plugin details are always up-to-date

### Improved
- Author and contributor information display in plugin details
- Added WordPress 6.5 compatibility indicator

## [2.0.7] - 2024-05-17
### Changed
- Additional text improvements and minor fixes

## [2.0.6] - 2024-05-17
### Changed
- Text improvements and minor fixes

## [2.0.5] - 2024-05-17
### Fixed
- Display correct version in plugin details popup

## [2.0.4] - 2024-05-17
### Fixed
- Display actual plugin version instead of 'N/A' for missing plugins in plugin details view

## [2.0.2] - 2024-05-17
### Changed
- Consolidated WordPress.org assets into .wordpress-org directory
- Improved organization of assets for WordPress.org submission
- Updated .wordpress-org/README.md with comprehensive information

## [2.0.1] - 2024-05-17
### Added
- Contributing section to readme.txt
- reference-plugins directory for plugin development inspiration

### Changed
- Updated "tested up to" version to WordPress 6.7.2
- Improved .gitattributes with comprehensive file handling
- Enhanced documentation organization

## [2.0.0] - 2024-05-17
### Added
- Note clarifying that the plugin has no settings page
- Clarification that functionality is limited to the admin plugins page only

### Changed
- Major version release for WordPress.org submission
- Finalized all assets and documentation for public release

## [1.6.28] - 2024-05-17
### Changed
- Consolidated asset documentation into a single comprehensive guide
- Clarified that `-rtl` suffix is for Right-to-Left languages, not dark mode
- Updated all asset README files to point to the main documentation
- Improved file organization and documentation structure

## [1.6.27] - 2024-05-17
### Changed
- Clarified RTL support in WordPress.org asset documentation
- Corrected information about `-rtl` suffix for assets (for right-to-left languages, not dark themes)
- Consolidated asset files and improved documentation

## [1.6.26] - 2024-05-17
### Changed
- Updated screenshot references to use a single comprehensive screenshot
- Fixed asset directory paths in documentation
- Improved ImageMagick conversion commands for icon generation
- Clarified WordPress.org SVN repository structure

## [1.6.25] - 2024-05-17
### Added
- Comprehensive WordPress.org submission guide with SVN structure explanation

### Changed
- Consolidated asset files into their respective directories
- Clarified asset requirements and submission process
- Improved organization of asset files

## [1.6.24] - 2024-05-17
### Added
- Properly named icon PNG files (icon-256x256.png and icon-128x128.png)

### Changed
- Updated asset preparation documentation
- Improved WordPress.org submission readiness

## [1.6.23] - 2024-05-17
### Added
- Properly named icon, banner, and screenshot files for WordPress.org submission
- Comprehensive guide for WordPress.org asset requirements

### Changed
- Fixed file naming to comply with WordPress.org standards
- Organized assets in separate directories for better management

## [1.6.22] - 2024-05-17
### Changed
- Enhanced support section with multiple support channel options
- Added encouragement for users to leave reviews on WordPress.org
- Improved documentation with clearer support instructions

## [1.6.21] - 2024-05-17
### Added
- Support for more AI-powered development tools (Roo, Gemini, Loveable, Bolt, Cody, Continue)
- Links to supported AI IDEs in documentation
- Additional FAQs for better SEO

### Changed
- Updated AI configuration files with modern models (gpt-4o)
- Made documentation more generic for boilerplate use
- Enhanced explanations in configuration files
- Added more keywords for better SEO

## [1.6.20] - 2024-05-17
### Changed
- Added explanations about the ! prefix in ignore files
- Moved WordPress-specific patterns to .gitignore
- Further improved organization of ignore patterns
- Added examples of how to include files excluded by .gitignore

## [1.6.19] - 2024-05-17
### Changed
- Consolidated common ignore patterns into .gitignore
- Simplified AI IDE configuration files to only include tool-specific patterns
- Improved organization of ignore patterns for better maintainability
- Added more file types to .gitignore for comprehensive coverage

## [1.6.18] - 2024-05-17
### Changed
- Optimized AI IDE configuration files to only include patterns not in .gitignore
- Improved efficiency of ignore files for better AI context management
- Enhanced compatibility with various AI-powered development tools

## [1.6.17] - 2024-05-17
### Added
- .augmentignore file with best practices
- Configuration files for Cursor, Windsurf, v0, and Cline IDEs
- More design file formats to .gitignore
- .aiconfig file for general AI IDE compatibility

## [1.6.16] - 2024-05-17
### Fixed
- Updated CI configuration files with correct plugin slugs
- Updated CHANGELOG.md with all recent versions
- Fixed outdated references to plugin-reference-cleaner

## [1.6.15] - 2024-05-17
### Changed
- Moved AI workflow documentation to root directory for better visibility
- Consolidated duplicate workflow files
- Improved organization of development documentation
- Updated CI configuration files with correct plugin slugs

## [1.6.14] - 2024-05-17
### Changed
- Updated documentation to consistently use "Remove Notice" instead of "Remove Reference"
- Added design file extensions to .gitignore (.pxd, .afdesign, .afphoto, .afpub)
- Improved explanation of how the plugin works
- Ensured consistent terminology across all documentation

## [1.6.13] - 2024-05-17
### Changed
- Code cleanup and optimization
- Improved Git Updater integration
- Fixed author display in plugin information
- Ensured compatibility with WordPress 6.4

## [1.6.12] - 2024-05-17
### Added
- Added WP ALLSTARS as a co-author
- Updated author information and links
- Added author websites to plugin description
- Fixed issue with multiple author URLs

## [1.6.11] - 2024-05-17
### Fixed
- Improved Git Updater integration
- Fixed plugin header information
- Updated author information

## [1.6.10] - 2024-05-17
### Fixed
- Corrected plugin header information
- Improved Git Updater compatibility
- Updated documentation

## [1.6.9] - 2024-05-17
### Fixed
- Fixed Git Updater integration
- Updated plugin header information
- Improved documentation

## [1.6.8] - 2024-05-17
### Fixed
- Fixed Git Updater integration
- Updated plugin header information

## [1.6.7] - 2024-05-17
### Fixed
- Fixed Git Updater integration
- Updated plugin header information

## [1.6.6] - 2024-05-17
### Fixed
- Fixed Git Updater integration
- Updated plugin header information

## [1.6.5] - 2024-05-16
### Fixed
- Fixed Git Updater integration
- Updated plugin header information

## [1.6.4] - 2024-05-16
### Improved
- Version management to ensure consistent patch version increments
- Documentation for version update process
- AI workflow files with detailed version increment instructions

## [1.6.3] - 2024-05-15
### Fixed
- Git Updater repository URLs to use full repository paths
- Update URI configuration for proper update detection
- Version management following semantic versioning

### Changed
- Updated organization name from 'WP All Stars' to 'WP ALLSTARS'
- Updated namespace from 'WPAllStars' to 'WPALLSTARS'

## [1.6.2] - 2024-05-15
### Changed
- Updated POT file version for consistency
- Improved JavaScript localization with proper fallbacks
- Enhanced code quality for WordPress.org submission
### Added
- Git Updater configuration with Update URI
- Update server URL configuration

## [1.6.1] - 2024-05-15
### Added
- AI assistant guide and workflow documentation
- Detailed release process documentation
- Feature development guidelines
- Bug fixing procedures
- Code review standards

## [1.6.0] - 2024-05-15
### Added
- Full translation support with POT file
- JavaScript localization for better multilingual support
- Plugin constants for improved code organization
- Git Updater support for updates from GitHub and Gitea

### Changed
- Updated code to follow WordPress internationalization best practices
- Improved asset loading with version constants
- Smart update detection based on installation source

## [1.5.0] - 2024-05-15
### Added
- Improved compatibility with WordPress 6.4
- Enhanced error detection for plugin references

### Fixed
- Minor UI improvements for better visibility
- Accessibility enhancements for screen readers

## [1.4.1] - 2023-11-30
### Added
- FAQ about keeping the plugin installed after notices are cleared

## [1.4.0] - 2023-11-30
### Changed
- Updated plugin name and text domain
- Repository rename from plugin-reference-cleaner to wp-fix-plugin-does-not-exist-notices

## [1.3.3] - 2023-10-05
### Added
- "Click here to scroll" button to automatically find missing plugins
- Visual arrow pointing from notification to error message
- Smooth scrolling with highlighting of missing plugin rows

### Improved
- Notification reliability using multiple injection methods
- Earlier placement in page load cycle for better visibility
- Enhanced error detection for all WordPress error message formats

## [1.3.2] - 2023-10-05
### Added
- Prominent notification that appears directly below WordPress error messages
- Visual styling to help users connect error message with solution
- Direction arrows and highlighted text to improve user guidance

## [1.3.1] - 2023-10-05
### Added
- Instructional notification explaining how to use the plugin
- Step-by-step guidance for removing plugin references
- Clear visual indicators for missing plugins

## [1.3.0] - 2023-10-05
### Changed
- Complete redesign for maximum compatibility with all WordPress themes
- Now uses the plugins list table for missing plugin references
- Uses standard WordPress admin UI patterns and hooks

### Added
- Missing plugins now appear directly in the plugins list
- "Remove Reference" action link in the plugins list
- Success/error notices after removing references

### Fixed
- Compatibility issues with various WordPress admin themes
- Reliability issues with notification detection

## [1.2.4] - 2023-10-05
### Fixed
- Compatibility with more WordPress admin UI variations
- Specific targeting for admin notices in various themes

### Added
- Advanced DOM traversal using TreeWalker API
- Multiple fallback approaches to ensure button appears
- Enhanced console logging for troubleshooting

## [1.2.3] - 2023-10-05
### Fixed
- Button not appearing in some WordPress admin themes
- Error message detection for greater theme compatibility

### Improved
- DOM traversal to find notification elements in various themes
- Added console logging for troubleshooting

## [1.2.2] - 2023-10-05
### Fixed
- Timeout issue during plugin activation
- Potential infinite recursion in admin notices handling

### Improved
- Hook management to prevent performance issues
- Optimized by only loading on plugins page

## [1.2.1] - 2025-04-07
### Improved
- Fixed typos in documentation
- Improved text clarity
- Added question mark to first sentence for better readability

## [1.2] - 2025-04-07
### Added
- Improved documentation with detailed explanation
- Added SQL reference for technical users
- Suggested potential inclusion in WordPress core

## [1.1] - 2025-04-07
### Added
- Support for multisite WordPress installations
- Network admin page integration
- Woodpecker CI integration for automated releases

### Improved
- Error handling
- User experience with better confirmation messages
- Security by adding proper capability checks

## [1.0] - 2025-03-15
### Added
- Initial release
- "Remove Reference" button for plugin deactivation error notices
- AJAX processing for reference removal