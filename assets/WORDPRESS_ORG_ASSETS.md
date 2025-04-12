# WordPress.org Plugin Submission Assets Guide

This document explains how to prepare and upload assets for WordPress.org plugin submission.

## WordPress.org SVN Repository Structure

When submitting a plugin to WordPress.org, you'll work with an SVN repository that has this structure:

```
/assets/         # Contains assets for the WordPress.org plugin page
    icon-256x256.png
    icon-128x128.png
    banner-772x250.png
    banner-1544x500.png
    screenshot-1.png
    screenshot-2.png
    screenshot-3.png
/tags/           # Contains tagged releases
    /1.0.0/
        [plugin files]
    /1.0.1/
        [plugin files]
/trunk/          # Contains the current version of the plugin
    [plugin files]
```

## Asset Requirements

### Icon

- **Format**: PNG
- **Sizes**:
  - Required: 256x256 pixels (`icon-256x256.png`)
  - Optional: 128x128 pixels (`icon-128x128.png`)
- **Location**: Upload to the `/assets/` directory in the WordPress.org SVN repository
- **Status**: ✅ READY - Files are in `assets/icon/`

### Banner

- **Format**: PNG
- **Sizes**:
  - Required: 772x250 pixels (`banner-772x250.png`)
  - Optional: 1544x500 pixels (`banner-1544x500.png`) for high-DPI displays
- **Location**: Upload to the `/assets/` directory in the WordPress.org SVN repository
- **Status**: ✅ READY - Files are in `assets/banner/`

### Screenshots

- **Format**: PNG
- **Naming**: Sequential numbers (`screenshot-1.png`, `screenshot-2.png`, etc.)
- **Location**: Upload to the `/assets/` directory in the WordPress.org SVN repository
- **Status**: ⚠️ PARTIALLY READY
  - `screenshot-1.png` is available in `assets/screenshots/`
  - Need to create `screenshot-2.png` and `screenshot-3.png` to match readme.txt descriptions

## Submission Process

1. **Prepare Plugin Files**:
   - Ensure all plugin files are ready in your local repository
   - Make sure version numbers are consistent across all files

2. **Prepare Assets**:
   - Ensure all assets follow the naming conventions above
   - Verify that screenshots match the descriptions in readme.txt

3. **Upload to WordPress.org**:
   - When you receive SVN access, use these commands:
   ```bash
   # Check out the repository
   svn checkout https://plugins.svn.wordpress.org/fix-plugin-does-not-exist-notices/
   
   # Copy plugin files to trunk
   cp -r [your-local-plugin-files]/* fix-plugin-does-not-exist-notices/trunk/
   
   # Copy assets to assets directory
   cp assets/icon/icon-256x256.png fix-plugin-does-not-exist-notices/assets/
   cp assets/icon/icon-128x128.png fix-plugin-does-not-exist-notices/assets/
   cp assets/banner/banner-772x250.png fix-plugin-does-not-exist-notices/assets/
   cp assets/banner/banner-1544x500.png fix-plugin-does-not-exist-notices/assets/
   cp assets/screenshots/screenshot-1.png fix-plugin-does-not-exist-notices/assets/
   cp assets/screenshots/screenshot-2.png fix-plugin-does-not-exist-notices/assets/
   cp assets/screenshots/screenshot-3.png fix-plugin-does-not-exist-notices/assets/
   
   # Add new files
   cd fix-plugin-does-not-exist-notices
   svn add --force trunk/*
   svn add --force assets/*
   
   # Commit changes
   svn commit -m "Initial plugin submission"
   ```

## Resources

- [WordPress Plugin Developer Handbook - Plugin Assets](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [WordPress Plugin Directory README.txt Standard](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/)
