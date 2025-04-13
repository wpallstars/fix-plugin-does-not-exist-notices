# WordPress.org Plugin Repository Assets

This directory contains assets specific to the WordPress.org plugin repository and is used for automatic deployment via GitHub Actions.

## Directory Structure

```
/.wordpress-org/
    /assets/
        icon-256x256.png
        icon-128x128.png
        banner-772x250.png
        banner-1544x500.png
        screenshot-1.png
```

## Asset Organization

- **All Asset Files**: All files for WordPress.org are stored in this directory (`.wordpress-org/assets/`)
  - PNG files (icon-256x256.png, banner-772x250.png, etc.)
  - Source files (PXD, SVG)
  - Documentation

## Purpose

When using GitHub Actions for WordPress.org plugin deployments (via the 10up WordPress GitHub Actions), this directory is used to automatically update plugin assets in the WordPress.org repository.

## Naming Conventions

Files must be named exactly as shown above to be properly recognized by the WordPress.org system during the deployment process:

### Banner Images
- `banner-772x250.png` - 772x250 pixel PNG banner (required for WordPress.org)
- `banner-1544x500.png` - 1544x500 pixel PNG banner for high-DPI displays (optional for WordPress.org)

### Icon Images
- `icon-256x256.png` - 256x256 pixel PNG icon (required for WordPress.org)
- `icon-128x128.png` - 128x128 pixel PNG icon (optional for WordPress.org)

### Screenshots
- `screenshot-1.png` - Main screenshot showing the plugin in action

## Right-to-Left (RTL) Support

For plugins that support Right-to-Left languages (like Hebrew and Arabic), you can provide RTL versions of assets by appending `-rtl` to the filename:

- `banner-772x250-rtl.png`
- `banner-1544x500-rtl.png`
- `icon-256x256-rtl.png`

Note that the `-rtl` suffix is specifically for Right-to-Left language support, not for dark mode versions of assets.

## Build Process

The build script (`build.sh`) is configured to:
1. Use all asset files from the `.wordpress-org/assets/` directory
2. Copy these files to the appropriate locations in the build directory

## Additional Resources

For more detailed information about WordPress.org plugin assets, please see:

- [WordPress Plugin Developer Handbook - Plugin Assets](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [WordPress Plugin Directory README.txt Standard](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/)
- [WordPress.org Plugin Submission Assets Guide](./.wordpress-org/WORDPRESS_ORG_ASSETS.md)