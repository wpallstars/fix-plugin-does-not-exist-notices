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

### 1. Create a New Branch

```bash
git checkout -b v{MAJOR}.{MINOR}.{PATCH}
```

Example:
```bash
git checkout -b v1.7.0
```

### 2. Update Version Numbers

Update the version number in the following files:

#### a. Main Plugin File (wp-fix-plugin-does-not-exist-notices.php)

```php
/**
 * Plugin Name: Fix 'Plugin file does not exist.' Notices
 * Plugin URI: https://wordpress.org/plugins/fix-plugin-does-not-exist-notices/
 * Description: Adds missing plugins to the plugins list with a "Remove Reference" link so you can permanently clean up invalid plugin entries and remove error notices.
 * Version: {MAJOR}.{MINOR}.{PATCH}
 * ...
 */
```

Also update the FPDEN_VERSION constant:

```php
define( 'FPDEN_VERSION', '{MAJOR}.{MINOR}.{PATCH}' );
```

#### b. CHANGELOG.md

Add a new section at the top of the CHANGELOG.md file:

```markdown
## [{MAJOR}.{MINOR}.{PATCH}] - YYYY-MM-DD
### Added
- New feature 1
- New feature 2

### Changed
- Change 1
- Change 2

### Fixed
- Bug fix 1
- Bug fix 2
```

#### c. POT File (languages/wp-fix-plugin-does-not-exist-notices.pot)

Update the Project-Id-Version and POT-Creation-Date (IMPORTANT - don't forget this step!):

```
"Project-Id-Version: Fix 'Plugin file does not exist' Notices {MAJOR}.{MINOR}.{PATCH}\n"
"POT-Creation-Date: YYYY-MM-DDT00:00:00+00:00\n"
```

Note: Always use the current date for POT-Creation-Date in the format YYYY-MM-DD.

#### d. readme.txt

Update the stable tag:

```
Stable tag: {MAJOR}.{MINOR}.{PATCH}
```

Add a new entry to the changelog section:

```
= {MAJOR}.{MINOR}.{PATCH} =
* New feature 1
* New feature 2
* Change 1
* Change 2
* Fixed bug 1
* Fixed bug 2
```

Update the upgrade notice section:

```
= {MAJOR}.{MINOR}.{PATCH} =
Brief description of the most important changes in this release
```

### 3. Commit Changes

```bash
git add wp-fix-plugin-does-not-exist-notices.php CHANGELOG.md readme.txt README.md languages/wp-fix-plugin-does-not-exist-notices.pot
git commit -m "Prepare release v{MAJOR}.{MINOR}.{PATCH}"
```

### 4. Test Changes Locally

Test the changes thoroughly on the version branch to ensure everything works as expected:

- Test with the latest WordPress version
- Test with PHP 7.0+ (minimum supported version)
- Verify all features work as expected
- Check for any PHP warnings or notices

### 5. Merge to Main

When satisfied with testing, merge the version branch to main:

```bash
git checkout main
git merge v{MAJOR}.{MINOR}.{PATCH} --no-ff
```

The `--no-ff` flag creates a merge commit even if a fast-forward merge is possible, which helps preserve the branch history.

### 6. Push Main to Remotes

```bash
git push github main
git push gitea main
```

### 7. Create and Push Tag

```bash
git tag -a v{MAJOR}.{MINOR}.{PATCH} -m "Release version {MAJOR}.{MINOR}.{PATCH}"
git push github refs/tags/v{MAJOR}.{MINOR}.{PATCH}
git push gitea refs/tags/v{MAJOR}.{MINOR}.{PATCH}
```

### 8. Monitor GitHub Actions

Open the GitHub Actions page to monitor the build and deployment process:
https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices/actions

### 9. Verify Release

- [ ] Check that the GitHub release was created successfully
- [ ] Verify that the plugin was deployed to WordPress.org
- [ ] Test the plugin from WordPress.org to ensure it works correctly

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
