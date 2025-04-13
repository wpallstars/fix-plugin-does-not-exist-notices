#!/bin/bash

# Exit on error
set -e

# Define source and destination paths
SOURCE_DIR="/Users/marcusquinn/Git/wp-fix-plugin-does-not-exist-notices"
DEST_DIR="/Users/marcusquinn/Local/plugin-testing/app/public/wp-content/plugins/wp-fix-plugin-does-not-exist-notices"

# Check if destination directory exists, create if not
if [ ! -d "$DEST_DIR" ]; then
  echo "Creating destination directory..."
  mkdir -p "$DEST_DIR"
fi

# Rsync the plugin files to the local WordPress installation
echo "Deploying to local WordPress installation..."
rsync -av --delete \
  --exclude-from="$SOURCE_DIR/.gitignore" \
  --exclude="scripts" \
  --exclude=".git" \
  --exclude=".gitignore" \
  "$SOURCE_DIR/" "$DEST_DIR/"

echo "✅ Local deployment successful!"
echo "Plugin deployed to: $DEST_DIR"
