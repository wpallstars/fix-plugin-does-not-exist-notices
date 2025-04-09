# Changelog

All notable changes to this project will be documented in this file.

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