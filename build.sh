#!/bin/bash

# Exit on error
set -e

# Check if version is provided
if [ -z "$1" ]; then
  echo "Error: Please provide a version number. Example: ./build.sh 1.2"
  exit 1
fi

VERSION=$1
PLUGIN_SLUG="wp-fix-plugin-does-not-exist-notices"
BUILD_DIR="build/$PLUGIN_SLUG"
ZIP_FILE="${PLUGIN_SLUG}-${VERSION}.zip"

# Create build directory
echo "Creating build directory..."
mkdir -p $BUILD_DIR

# Install composer dependencies
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# Copy required files
echo "Copying plugin files..."
cp wp-fix-plugin-does-not-exist-notices.php $BUILD_DIR/
cp readme.txt $BUILD_DIR/
cp LICENSE $BUILD_DIR/
cp README.md $BUILD_DIR/
cp CHANGELOG.md $BUILD_DIR/
cp composer.json $BUILD_DIR/

# Copy directories
echo "Copying directories..."
mkdir -p $BUILD_DIR/includes
cp -r includes/* $BUILD_DIR/includes/
mkdir -p $BUILD_DIR/languages
cp -r languages/* $BUILD_DIR/languages/

# Copy assets
mkdir -p $BUILD_DIR/assets/css
cp -r assets/css/* $BUILD_DIR/assets/css/
mkdir -p $BUILD_DIR/assets/js
cp -r assets/js/* $BUILD_DIR/assets/js/

# Copy asset source files (PXD)
mkdir -p $BUILD_DIR/assets/banner
cp -r assets/banner/*.pxd $BUILD_DIR/assets/banner/ 2>/dev/null || :
mkdir -p $BUILD_DIR/assets/icon
cp -r assets/icon/*.pxd $BUILD_DIR/assets/icon/ 2>/dev/null || :
mkdir -p $BUILD_DIR/assets/screenshots
cp -r assets/screenshots/*.pxd $BUILD_DIR/assets/screenshots/ 2>/dev/null || :

# Copy README files from assets directories
cp -r assets/README.md $BUILD_DIR/assets/ 2>/dev/null || :
cp -r assets/banner/README.md $BUILD_DIR/assets/banner/ 2>/dev/null || :
cp -r assets/icon/README.md $BUILD_DIR/assets/icon/ 2>/dev/null || :
cp -r assets/screenshots/README.md $BUILD_DIR/assets/screenshots/ 2>/dev/null || :
cp -r assets/WORDPRESS_ORG_ASSETS.md $BUILD_DIR/assets/ 2>/dev/null || :
cp -r assets/WORDPRESS_ORG_SUBMISSION.md $BUILD_DIR/assets/ 2>/dev/null || :

# Copy PNG files from .wordpress-org/assets to the build directory
mkdir -p $BUILD_DIR/assets/banner
cp -r .wordpress-org/assets/banner-*.png $BUILD_DIR/assets/banner/ 2>/dev/null || :
mkdir -p $BUILD_DIR/assets/icon
cp -r .wordpress-org/assets/icon-*.png $BUILD_DIR/assets/icon/ 2>/dev/null || :
mkdir -p $BUILD_DIR/assets/screenshots
cp -r .wordpress-org/assets/screenshot-*.png $BUILD_DIR/assets/screenshots/ 2>/dev/null || :

mkdir -p $BUILD_DIR/vendor
cp -r vendor/* $BUILD_DIR/vendor/

# Create ZIP file
echo "Creating ZIP file..."
cd build
zip -r ../$ZIP_FILE $PLUGIN_SLUG
cd ..

# Verify the ZIP file was created
if [ -f "$ZIP_FILE" ]; then
  echo "✅ Build successful: $ZIP_FILE created"
  echo "File path: $(pwd)/$ZIP_FILE"

  # Deploy to local WordPress installation
  echo "\nDeploying to local WordPress installation..."
  ./scripts/deploy-local.sh
else
  echo "❌ Build failed: ZIP file was not created"
  exit 1
fi