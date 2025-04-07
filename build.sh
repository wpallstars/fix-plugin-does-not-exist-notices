#!/bin/bash

# Exit on error
set -e

# Check if version is provided
if [ -z "$1" ]; then
  echo "Error: Please provide a version number. Example: ./build.sh 1.2"
  exit 1
fi

VERSION=$1
PLUGIN_SLUG="plugin-reference-cleaner"
BUILD_DIR="build/$PLUGIN_SLUG"
ZIP_FILE="${PLUGIN_SLUG}-${VERSION}.zip"

# Create build directory
echo "Creating build directory..."
mkdir -p $BUILD_DIR

# Copy required files
echo "Copying plugin files..."
cp plugin-reference-cleaner.php $BUILD_DIR/
cp readme.txt $BUILD_DIR/
cp LICENSE $BUILD_DIR/
cp README.md $BUILD_DIR/
cp CHANGELOG.md $BUILD_DIR/

# Create ZIP file
echo "Creating ZIP file..."
cd build
zip -r ../$ZIP_FILE $PLUGIN_SLUG
cd ..

# Verify the ZIP file was created
if [ -f "$ZIP_FILE" ]; then
  echo "✅ Build successful: $ZIP_FILE created"
  echo "File path: $(pwd)/$ZIP_FILE"
else
  echo "❌ Build failed: ZIP file was not created"
  exit 1
fi 