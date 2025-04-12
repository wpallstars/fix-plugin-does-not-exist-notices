# WordPress.org Plugin Repository Assets

This directory contains assets specific to the WordPress.org plugin repository and is used for automatic deployment via GitHub Actions.

## Directory Structure

```
/assets/
    icon-256x256.png
    icon-128x128.png
    banner-772x250.png
    banner-1544x500.png
    screenshot-1.png
```

## Purpose

When using GitHub Actions for WordPress.org plugin deployments (via the 10up WordPress GitHub Actions), this directory is used to automatically update plugin assets in the WordPress.org repository.

## Naming Conventions

Files must be named exactly as shown above to be properly recognized by the WordPress.org system during the deployment process.

## Right-to-Left (RTL) Support

For plugins that support Right-to-Left languages (like Hebrew and Arabic), you can provide RTL versions of assets by appending `-rtl` to the filename:

- `banner-772x250-rtl.png`
- `banner-1544x500-rtl.png`
- `icon-256x256-rtl.png`

Note that the `-rtl` suffix is specifically for Right-to-Left language support, not for dark mode versions of assets.

## Additional Resources

For more detailed information about WordPress.org plugin assets, please see:

- [WordPress Plugin Developer Handbook - Plugin Assets](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/)
- [WordPress Plugin Directory README.txt Standard](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/)