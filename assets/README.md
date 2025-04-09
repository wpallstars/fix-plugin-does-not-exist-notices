# Plugin Assets for WordPress.org

This directory contains assets for the WordPress.org plugin repository.

## Directory Structure

- `banner/` - Banner images for the plugin page header
  - `banner-772x250.jpg` - Standard banner (772x250px)
  - `banner-1544x500.jpg` - Retina banner (1544x500px)
  
- `icon/` - Plugin icon images
  - `icon-128x128.jpg` - Standard icon (128x128px)
  - `icon-256x256.jpg` - Retina icon (256x256px)

- `screenshots/` - Screenshots shown on the plugin page
  - `screenshot-1.jpg` - Error message with explanation notification
  - `screenshot-2.jpg` - Missing plugin shown in the plugins list with "Remove Reference" link
  - `screenshot-3.jpg` - Auto-scroll feature that highlights the missing plugin

## WordPress.org Requirements

### Required Image Dimensions

- **Banner**: 772x250px with 2x retina version at 1544x500px
- **Icon**: 128x128px with 2x retina version at 256x256px
- **Screenshots**: No specific size requirements, but they should be clear and readable

### Image Formats

- All images should be in JPG or PNG format
- Images should be optimized for web (compressed without losing quality)

### Additional Notes

- Screenshots should be numbered sequentially starting with 1
- They should match the descriptions in the `readme.txt` file
- Dark theme versions of banners and icons can be provided by appending `-rtl` to the filename

## Example Filenames

```
assets/
├── banner/
│   ├── banner-772x250.jpg
│   └── banner-1544x500.jpg
├── icon/
│   ├── icon-128x128.jpg
│   └── icon-256x256.jpg
└── screenshots/
    ├── screenshot-1.jpg
    ├── screenshot-2.jpg
    └── screenshot-3.jpg
``` 