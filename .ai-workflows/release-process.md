# Release Process for AI Assistants

This document provides step-by-step instructions for AI assistants to help with the release process for the Fix Plugin Does Not Exist Notices plugin.

## Pre-Release Checklist

- [ ] All features for this release are complete
- [ ] All bug fixes for this release are complete
- [ ] CHANGELOG.md is up to date
- [ ] readme.txt is up to date
- [ ] All tests pass

## Determining the New Version Number

Based on the changes made, determine the appropriate version increment:

1. **PATCH** (e.g., 1.6.0 → 1.6.1): For bug fixes and minor improvements
   - **IMPORTANT**: Always increment the patch version for every change, even small ones, to make rollbacks easier if issues are found in testing
2. **MINOR** (e.g., 1.6.0 → 1.7.0): For new features and significant improvements
3. **MAJOR** (e.g., 1.6.0 → 2.0.0): For breaking changes

## Release Steps

### 1. Start from a Feature Branch or Create a New Branch

You can either use an existing feature branch or create a new branch specifically for the release:

```bash
# Option 1: Use existing feature branch
git checkout feature/branch-name

# Option 2: Create a new branch
git checkout -b v{MAJOR}.{MINOR}.{PATCH}
```

Example:
```bash
git checkout feature/refactor-and-improvements
# or
git checkout -b v2.2.1
```

### 2. Update Version Numbers

Update the version number in the following files:

#### a. Main Plugin File (wp-fix-plugin-does-not-exist-notices.php)

Update both the plugin header and the version parameter in the Plugin class initialization:

```php
/**
 * Plugin Name: Fix 'Plugin file does not exist.' Notices
 * Plugin URI: https://www.wpallstars.com
 * Description: Adds missing plugins to your plugins list with a "Remove Notice" action link, allowing you to safely clean up invalid plugin references.
 * Version: {MAJOR}.{MINOR}.{PATCH}
 * ...
 */

// At the bottom of the file, update the version parameter:
new WPALLSTARS\FixPluginDoesNotExistNotices\Plugin(__FILE__, '{MAJOR}.{MINOR}.{PATCH}');
```

#### b. JavaScript Files with Version Constants

Check for any JavaScript files that might contain version constants:

```javascript
// Current plugin version - this should match the version in the main plugin file
const CURRENT_VERSION = '{MAJOR}.{MINOR}.{PATCH}';
```

**Note**: As of version 2.2.1, we've removed redundant JavaScript files like `version-fix.js` since Git Updater now correctly detects the version from the main branch.

#### c. CHANGELOG.md

Add a new section at the top of the CHANGELOG.md file:

```markdown
All notable changes to this project should be documented both here and in the main Readme files.

#### [{MAJOR}.{MINOR}.{PATCH}] - YYYY-MM-DD
#### Added/Changed/Fixed
- Change 1
- Change 2
- Change 3

#### [{PREVIOUS_VERSION}] - YYYY-MM-DD
```

Note: Use the `####` heading format for consistency with the existing CHANGELOG.md structure.

#### d. POT File (languages/wp-fix-plugin-does-not-exist-notices.pot)

Update the Project-Id-Version and POT-Creation-Date (IMPORTANT - don't forget this step!):

```
"Project-Id-Version: Fix 'Plugin file does not exist' Notices {MAJOR}.{MINOR}.{PATCH}\n"
"POT-Creation-Date: YYYY-MM-DDT00:00:00+00:00\n"
```

Note: Always use the current date for POT-Creation-Date in the format YYYY-MM-DD.

#### e. readme.txt

Update the stable tag:

```
Stable tag: {MAJOR}.{MINOR}.{PATCH}
```

Add a new entry to the changelog section:

```
= {MAJOR}.{MINOR}.{PATCH} =
* Change 1
* Change 2
* Change 3
```

### 3. Build and Test Locally

Run the build script to create the plugin ZIP file and deploy to your local WordPress testing environment:

```bash
./build.sh {MAJOR}.{MINOR}.{PATCH}
```

This will:
1. Create a build directory
2. Install composer dependencies
3. Copy required files to the build directory
4. Create a ZIP file named `wp-fix-plugin-does-not-exist-notices-{MAJOR}.{MINOR}.{PATCH}.zip`
5. Deploy the plugin to your local WordPress testing environment

Test the plugin thoroughly in your local WordPress environment:
- Test with the latest WordPress version
- Verify all features work as expected
- Check for any PHP warnings or notices
- Test any specific changes made in this version

### 4. Commit Changes

```bash
git add wp-fix-plugin-does-not-exist-notices.php CHANGELOG.md readme.txt admin/js/version-fix.js languages/wp-fix-plugin-does-not-exist-notices.pot
git commit -m "Version {MAJOR}.{MINOR}.{PATCH} - Brief description of changes"
```

### 5. Create a Tag

```bash
git tag -a v{MAJOR}.{MINOR}.{PATCH} -m "Version {MAJOR}.{MINOR}.{PATCH} - Brief description of changes"
```

### 6. Push Branch and Tag to Remotes

```bash
# Push the branch
git push github feature/branch-name
git push gitea feature/branch-name

# Push the tag
git push github v{MAJOR}.{MINOR}.{PATCH}
git push gitea v{MAJOR}.{MINOR}.{PATCH}
```

### 7. Verify GitHub Release

Check that the GitHub release was created successfully with the ZIP file attached:
https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/releases

If the release doesn't appear or doesn't have the ZIP file attached, check the GitHub Actions page:
https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/actions

### 8. Merge to Main (CRITICAL STEP)

**IMPORTANT**: This step is critical for Git Updater to detect the new version. Git Updater reads the readme.txt file from the main branch, not from tags or releases.

Merge the feature branch to main immediately after pushing the tag:

```bash
git checkout main
git merge feature/branch-name --no-ff
git push github main
git push gitea main
```

The `--no-ff` flag creates a merge commit even if a fast-forward merge is possible, which helps preserve the branch history.

**Note**: Only use named branches like feature/*, fix/*, etc. for development. Release branches (v*) should always be merged to main immediately after tagging to ensure Git Updater can detect the new version.

### 9. Verify Release

- [ ] Check that the GitHub release was created successfully with the ZIP file attached
- [ ] Verify that the plugin was deployed to WordPress.org (if applicable)
- [ ] Test the plugin from the GitHub release ZIP to ensure it works correctly
- [ ] Verify that Git Updater can detect and install the new version

## Testing Previous Versions

To test a previous version of the plugin:

```bash
# Checkout a specific tag for testing
git checkout v{MAJOR}.{MINOR}.{PATCH}

# Or create a test branch from a specific tag
git checkout v{MAJOR}.{MINOR}.{PATCH} -b test/some-feature
```

## Rollback Procedure (If Needed)

If issues are discovered after release:

### 1. Create a Hotfix Branch

```bash
git checkout v{MAJOR}.{MINOR}.{PATCH}
git checkout -b hotfix/v{MAJOR}.{MINOR}.{PATCH+1}
```

### 2. Fix the Issues

Make the necessary changes to fix the issues.

### 3. Update Version Numbers

Increment the PATCH version and update all version numbers as described above.

### 4. Test the Hotfix

Test the hotfix thoroughly to ensure it resolves the issue without introducing new problems.

### 5. Commit Changes

```bash
git add .
git commit -m "Fix issues in v{MAJOR}.{MINOR}.{PATCH}"
```

### 6. Merge to Main

```bash
git checkout main
git merge hotfix/v{MAJOR}.{MINOR}.{PATCH+1} --no-ff
git push github main
git push gitea main
```

### 7. Create and Push Tag

```bash
git tag -a v{MAJOR}.{MINOR}.{PATCH+1} -m "Hotfix release version {MAJOR}.{MINOR}.{PATCH+1}"
git push github refs/tags/v{MAJOR}.{MINOR}.{PATCH+1}
git push gitea refs/tags/v{MAJOR}.{MINOR}.{PATCH+1}
```

### 8. Monitor and Verify

Follow steps 8 and 9 from the release process to monitor and verify the hotfix release.
