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
- ✅ SVG source available
- ❌ Need to create `icon-256x256.png` from the SVG

### Banner
- ✅ Both sizes available
- ✅ Properly renamed versions created in `assets/banner-png/`

### Screenshots
- ❌ Only 1 of 3 referenced screenshots available
- ❌ Need to create `screenshot-2.png` and `screenshot-3.png`
- ✅ Properly renamed version of the first screenshot created in `assets/screenshots-png/`

## SVN Directory Structure

When submitting to WordPress.org, your SVN repository will have this structure:

```
/assets/
    icon-256x256.png
    banner-772x250.png
    banner-1544x500.png
    screenshot-1.png
    screenshot-2.png
    screenshot-3.png
/tags/
    /1.0.0/
        [plugin files]
    /1.0.1/
        [plugin files]
/trunk/
    [current plugin files]
```

## Action Items

1. Convert the SVG icon to a 256x256 PNG file
2. Create the missing screenshots (2 and 3)
3. Ensure all files follow the proper naming convention
4. Upload all assets to the WordPress.org SVN repository in the `/assets` directory

## Resources

- [WordPress Plugin Developer Handbook - Plugin Assets](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [WordPress Plugin Directory README.txt Standard](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/)
