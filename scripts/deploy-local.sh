#!/bin/bash

# Exit on error
set -e

# Define paths
PLUGIN_SLUG="wp-fix-plugin-does-not-exist-notices"
SOURCE_DIR="/Users/marcusquinn/Git/wp-fix-plugin-does-not-exist-notices/build/$PLUGIN_SLUG"
DEST_DIR="/Users/marcusquinn/Local/plugin-testing/app/public/wp-content/plugins/$PLUGIN_SLUG"

# Check if build directory exists
if [ ! -d "$SOURCE_DIR" ]; then
  echo "Build directory not found. Running build script first..."
  cd /Users/marcusquinn/Git/wp-fix-plugin-does-not-exist-notices
  ./build.sh "$(grep -m 1 "Version:" wp-fix-plugin-does-not-exist-notices.php | awk -F': ' '{print $2}' | tr -d '[:space:]')"
  # Exit if build failed
  if [ ! -d "$SOURCE_DIR" ]; then
    echo "❌ Build failed: Build directory was not created"
    exit 1
  fi
fi

# Check if destination directory exists, create if not
if [ ! -d "$DEST_DIR" ]; then
  echo "Creating destination directory..."
  mkdir -p "$DEST_DIR"
fi

# Rsync the plugin files to the local WordPress installation
echo "Deploying to local WordPress installation..."
rsync -av --delete "$SOURCE_DIR/" "$DEST_DIR/"

echo "✅ Local deployment successful!"
echo "Plugin deployed to: $DEST_DIR"
