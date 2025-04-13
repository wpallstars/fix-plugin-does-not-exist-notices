#!/bin/bash

# Deploy script for local testing
# This script copies the plugin to the local WordPress plugins directory

# Set variables
SOURCE_DIR="$(pwd)"
TARGET_DIR="$HOME/Local/plugin-testing/app/public/wp-content/plugins"
MAIN_PLUGIN_NAME="wp-fix-plugin-does-not-exist-notices"

# Create target directory if it doesn't exist
mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME"

# Clean up target directory first
echo "Cleaning up target directory..."
rm -rf "$TARGET_DIR/$MAIN_PLUGIN_NAME"/*

# Remove the separate branch fix plugin if it exists
if [ -f "$TARGET_DIR/gu-branch-fix.php" ]; then
    echo "Removing separate branch fix plugin..."
    rm -f "$TARGET_DIR/gu-branch-fix.php"
fi

# Remove the old plugin directory if it exists
if [ -d "$TARGET_DIR/fix-plugin-file-does-not-exist-notices" ]; then
    echo "Removing old plugin directory..."
    rm -rf "$TARGET_DIR/fix-plugin-file-does-not-exist-notices"
fi

# Copy main plugin files
echo "Copying plugin files..."
cp "$SOURCE_DIR/wp-fix-plugin-does-not-exist-notices.php" "$TARGET_DIR/$MAIN_PLUGIN_NAME/wp-fix-plugin-does-not-exist-notices.php"
cp "$SOURCE_DIR/readme.txt" "$TARGET_DIR/$MAIN_PLUGIN_NAME/"

# Copy additional directories and files for the main plugin
if [ -d "$SOURCE_DIR/admin" ]; then
    mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME/admin"
    cp -R "$SOURCE_DIR/admin"/* "$TARGET_DIR/$MAIN_PLUGIN_NAME/admin/"
fi

if [ -d "$SOURCE_DIR/assets" ]; then
    mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME/assets"
    cp -R "$SOURCE_DIR/assets"/* "$TARGET_DIR/$MAIN_PLUGIN_NAME/assets/"
fi

if [ -d "$SOURCE_DIR/includes" ]; then
    mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME/includes"
    cp -R "$SOURCE_DIR/includes"/* "$TARGET_DIR/$MAIN_PLUGIN_NAME/includes/"
fi

if [ -d "$SOURCE_DIR/languages" ]; then
    mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME/languages"
    cp -R "$SOURCE_DIR/languages"/* "$TARGET_DIR/$MAIN_PLUGIN_NAME/languages/"
fi

if [ -d "$SOURCE_DIR/vendor" ]; then
    mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME/vendor"
    cp -R "$SOURCE_DIR/vendor"/* "$TARGET_DIR/$MAIN_PLUGIN_NAME/vendor/"
fi

echo "Deployment complete!"
echo "Plugin deployed to: $TARGET_DIR/$MAIN_PLUGIN_NAME"

echo "\nRemember to activate these plugins in WordPress:"
echo "1. Fix 'Plugin file does not exist' Notices"
echo "2. Git Updater"
