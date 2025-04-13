# WordPress.org Plugin Submission Assets Guide

This document explains how to prepare and upload assets for WordPress.org plugin submission. This is the main reference document for all asset-related information.

## WordPress.org SVN Repository Structure

When submitting a plugin to WordPress.org, you'll work with an SVN repository that has this structure:

```
/assets/         # Contains assets for the WordPress.org plugin page
    icon-256x256.png
    icon-128x128.png
    banner-772x250.png
    banner-1544x500.png
    screenshot-1.png
/tags/           # Contains tagged releases
    /1.6.27/
        [plugin files]
    /1.6.26/
        [plugin files]
/trunk/          # Contains the current version of the plugin
    [plugin files]
```

## Right-to-Left (RTL) Support

For languages that read from right to left (like Hebrew and Arabic), you can provide RTL-specific versions of your assets by appending `-rtl` to the filename. For example:
- `banner-772x250-rtl.png`
- `icon-256x256-rtl.png`

Note: `-rtl` is specifically for Right-to-Left language support, not for dark theme versions.

## Asset Requirements

### Icon

- **Format**: PNG
- **Sizes**:
  - Required: 256x256 pixels (`icon-256x256.png`)
  - Optional: 128x128 pixels (`icon-128x128.png`)
- **Location**: Upload to the `/assets/` directory in the WordPress.org SVN repository
- **Status**: ✅ READY - Files are in `.wordpress-org/assets/`

### Banner

- **Format**: PNG
- **Sizes**:
  - Required: 772x250 pixels (`banner-772x250.png`)
  - Optional: 1544x500 pixels (`banner-1544x500.png`) for high-DPI displays
- **Location**: Upload to the `/assets/` directory in the WordPress.org SVN repository
- **Status**: ✅ READY - Files are in `.wordpress-org/assets/`

### Screenshots

- **Format**: PNG
- **Naming**: `screenshot-1.png`
- **Location**: Upload to the `/assets/` directory in the WordPress.org SVN repository
- **Status**: ✅ READY - Files are in `.wordpress-org/assets/`

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
   cp .wordpress-org/assets/icon-256x256.png fix-plugin-does-not-exist-notices/assets/
   cp .wordpress-org/assets/icon-128x128.png fix-plugin-does-not-exist-notices/assets/
   cp .wordpress-org/assets/banner-772x250.png fix-plugin-does-not-exist-notices/assets/
   cp .wordpress-org/assets/banner-1544x500.png fix-plugin-does-not-exist-notices/assets/
   cp .wordpress-org/assets/screenshot-1.png fix-plugin-does-not-exist-notices/assets/

   # Add new files
   cd fix-plugin-does-not-exist-notices
   svn add --force trunk/*
   svn add --force assets/*

   # Commit changes
   svn commit -m "Initial plugin submission"
   ```

## Image Conversion Tools

For converting SVG to PNG or creating different sizes of images, you can use:

- **Graphic Design Software**:
  - Adobe Photoshop
  - Adobe Illustrator
  - Affinity Designer
  - Affinity Photo
  - GIMP (free, open-source)
  - Inkscape (free, open-source)
  - Pixelmator

- **Online Converters**:
  - [SVG to PNG Converter](https://svgtopng.com/)
  - [Convertio](https://convertio.co/svg-png/)
  - [CloudConvert](https://cloudconvert.com/svg-to-png)

- **Command Line** (using ImageMagick):
  ```bash
  # For 256x256 icon
  convert -background none -size 256x256 assets/icon/icon.svg assets/icon/icon-256x256.png

  # For 128x128 icon
  convert -background none -size 128x128 assets/icon/icon.svg assets/icon/icon-128x128.png
  ```

## Resources

- [WordPress Plugin Developer Handbook - Plugin Assets](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [WordPress Plugin Directory README.txt Standard](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/)
