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

#### a. Main Plugin File (fix-plugin-does-not-exist-notices.php)

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

#### c. readme.txt

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
git add fix-plugin-does-not-exist-notices.php CHANGELOG.md readme.txt
git commit -m "Prepare release v{MAJOR}.{MINOR}.{PATCH}"
```

### 4. Push Branch to Remotes

```bash
git push github HEAD:v{MAJOR}.{MINOR}.{PATCH}
git push gitea HEAD:v{MAJOR}.{MINOR}.{PATCH}
```

### 5. Create and Push Tag

```bash
git tag -a v{MAJOR}.{MINOR}.{PATCH} -m "Release version {MAJOR}.{MINOR}.{PATCH}"
git push github refs/tags/v{MAJOR}.{MINOR}.{PATCH}
git push gitea refs/tags/v{MAJOR}.{MINOR}.{PATCH}
```

### 6. Monitor GitHub Actions

Open the GitHub Actions page to monitor the build and deployment process:
https://github.com/wpallstars/fix-plugin-does-not-exist-notices/actions

### 7. Verify Release

- [ ] Check that the GitHub release was created successfully
- [ ] Verify that the plugin was deployed to WordPress.org
- [ ] Test the plugin from WordPress.org to ensure it works correctly

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

### 4. Commit and Push

```bash
git add .
git commit -m "Fix issues in v{MAJOR}.{MINOR}.{PATCH}"
git push github HEAD:hotfix/v{MAJOR}.{MINOR}.{PATCH+1}
git push gitea HEAD:hotfix/v{MAJOR}.{MINOR}.{PATCH+1}
```

### 5. Create and Push Tag

```bash
git tag -a v{MAJOR}.{MINOR}.{PATCH+1} -m "Hotfix release version {MAJOR}.{MINOR}.{PATCH+1}"
git push github refs/tags/v{MAJOR}.{MINOR}.{PATCH+1}
git push gitea refs/tags/v{MAJOR}.{MINOR}.{PATCH+1}
```

### 6. Monitor and Verify

Follow steps 6 and 7 from the release process to monitor and verify the hotfix release.
