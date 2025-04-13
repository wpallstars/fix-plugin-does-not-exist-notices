# WordPress.org Plugin Submission Assets Guide

This document outlines the requirements for assets when submitting a plugin to the WordPress.org plugin repository.

## Asset Requirements

### Icon

- **Format**: PNG
- **Size**: 256x256 pixels
- **Filename**: `icon-256x256.png`
- **Location**: SVN `/assets` directory (not included in the plugin zip)
- **Optional**: You can also include `icon-128x128.png` for backward compatibility

### Banner

- **Format**: PNG
- **Sizes**:
  - Regular: 772x250 pixels (`banner-772x250.png`)
  - High-DPI: 1544x500 pixels (`banner-1544x500.png`)
- **Location**: SVN `/assets` directory (not included in the plugin zip)

### Screenshots

- **Format**: PNG
- **Naming**: Sequential numbers (`screenshot-1.png`, `screenshot-2.png`, etc.)
- **Location**: SVN `/assets` directory (not included in the plugin zip)
- **Important**: The number and order must match the descriptions in the `readme.txt` file

## Current Status

### Icon
- ✅ SVG source available in `.wordpress-org/assets/icon.svg`
- ✅ PNG files created in `.wordpress-org/assets/icon-256x256.png` and `.wordpress-org/assets/icon-128x128.png`

### Banner
- ✅ Both sizes available in `.wordpress-org/assets/`
- ✅ Properly named files: `banner-772x250.png` and `banner-1544x500.png`

### Screenshots
- ✅ One screenshot available in `.wordpress-org/assets/screenshot-1.png`
- ✅ Screenshot description in readme.txt updated to reference only one screenshot

## SVN Directory Structure

When submitting to WordPress.org, your SVN repository will have this structure:

```
/assets/
    icon-256x256.png
    icon-128x128.png
    banner-772x250.png
    banner-1544x500.png
    screenshot-1.png
/tags/
    /1.6.27/
        [plugin files]
    /1.6.26/
        [plugin files]
/trunk/
    [current plugin files]
```

## Action Items

1. Ensure all files follow the proper naming convention
2. Upload all assets to the WordPress.org SVN repository in the `/assets` directory using these commands:

```bash
# Copy assets to WordPress.org SVN assets directory
cp .wordpress-org/assets/icon-256x256.png /path/to/wordpress-svn/assets/
cp .wordpress-org/assets/icon-128x128.png /path/to/wordpress-svn/assets/
cp .wordpress-org/assets/banner-772x250.png /path/to/wordpress-svn/assets/
cp .wordpress-org/assets/banner-1544x500.png /path/to/wordpress-svn/assets/
cp .wordpress-org/assets/screenshot-1.png /path/to/wordpress-svn/assets/
```

## Resources

- [WordPress Plugin Developer Handbook - Plugin Assets](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [WordPress Plugin Directory README.txt Standard](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/)
