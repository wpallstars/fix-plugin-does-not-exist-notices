#!/bin/bash

# Deploy script for local testing
# This script copies the plugins to the local WordPress plugins directory

# Set variables
SOURCE_DIR="$(pwd)"
TARGET_DIR="$HOME/Local/plugin-testing/app/public/wp-content/plugins"
MAIN_PLUGIN_NAME="fix-plugin-file-does-not-exist-notices"
BRANCH_FIX_PLUGIN_NAME="gu-branch-fix"

# Create target directories if they don't exist
mkdir -p "$TARGET_DIR/$MAIN_PLUGIN_NAME"
mkdir -p "$TARGET_DIR/$BRANCH_FIX_PLUGIN_NAME"

# Clean up target directories first
echo "Cleaning up target directories..."
rm -rf "$TARGET_DIR/$MAIN_PLUGIN_NAME"/*
rm -rf "$TARGET_DIR/$BRANCH_FIX_PLUGIN_NAME"/*

# Copy main plugin files
echo "Copying main plugin files..."
cp "$SOURCE_DIR/wp-fix-plugin-does-not-exist-notices.php" "$TARGET_DIR/$MAIN_PLUGIN_NAME/fix-plugin-file-does-not-exist-notices.php"
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

# Copy branch fix plugin files
echo "Copying branch fix plugin files..."
cp "$SOURCE_DIR/gu-branch-fix.php" "$TARGET_DIR/$BRANCH_FIX_PLUGIN_NAME/"

echo "Deployment complete!"
echo "Main plugin deployed to: $TARGET_DIR/$MAIN_PLUGIN_NAME"
echo "Branch fix plugin deployed to: $TARGET_DIR/$BRANCH_FIX_PLUGIN_NAME"

echo "\nRemember to activate both plugins in WordPress:"
echo "1. Fix 'Plugin file does not exist' Notices"
echo "2. GU Branch Fix"
echo "3. Git Updater"
