# Bug Fixing Guide for AI Assistants

This document provides guidance for AI assistants to help with bug fixing for the Fix Plugin Does Not Exist Notices plugin.

## Bug Fixing Workflow

### 1. Create a Bug Fix Branch

Always start by creating a bug fix branch from the main branch:

```bash
git checkout main
git pull github main
git checkout -b fix/bug-description
```

Use a descriptive name that clearly indicates what bug is being fixed.

### 2. Understand the Bug

Before fixing a bug, make sure you understand:

- What is the expected behavior?
- What is the actual behavior?
- What are the steps to reproduce the bug?
- What is the impact of the bug?
- What is the root cause of the bug?

### 3. Fix the Bug

When fixing a bug:

- Make minimal changes necessary to fix the bug
- Avoid introducing new features while fixing bugs
- Maintain backward compatibility
- Add appropriate comments explaining the fix
- Consider adding tests to prevent regression

### 4. Update Documentation

Update relevant documentation to reflect the bug fix:

- Add a description to CHANGELOG.md under an "Unreleased" section
- Update readme.txt if the bug fix affects user-facing functionality

### 5. Testing

Test the bug fix thoroughly:

- Verify that the bug is fixed
- Ensure no regression in related functionality
- Test with the latest WordPress version
- Test with the minimum supported WordPress version (5.0)
- Test with PHP 7.0+ (minimum supported version)

### 6. Commit Changes

Make atomic commits with clear messages:

```bash
git add .
git commit -m "Fix #123: Brief description of the bug fix"
```

If there's an issue number, reference it in the commit message.

### 7. Push to Remote

Push the bug fix branch to the remote repositories:

```bash
git push github HEAD:fix/bug-description
git push gitea HEAD:fix/bug-description
```

### 8. Create Pull Request (Optional)

If the repository uses pull requests for code review, create a pull request from the bug fix branch to the main branch.

## Determining Version Increment

After fixing a bug, determine the appropriate version increment:

- **PATCH** (e.g., 1.6.0 → 1.6.1): For most bug fixes that don't change functionality
- **MINOR** (e.g., 1.6.0 → 1.7.0): For bug fixes that introduce new features or significant changes
- **MAJOR** (e.g., 1.6.0 → 2.0.0): For bug fixes that introduce breaking changes

## Hotfix Process

For critical bugs that need immediate fixing in a released version:

### 1. Create a Hotfix Branch

```bash
git checkout v{MAJOR}.{MINOR}.{PATCH}
git checkout -b hotfix/v{MAJOR}.{MINOR}.{PATCH+1}
```

### 2. Fix the Bug

Apply the minimal fix necessary to address the critical issue.

### 3. Update Version Numbers

Increment the PATCH version and update all version numbers:

- Main plugin file (fix-plugin-does-not-exist-notices.php)
- FPDEN_VERSION constant
- CHANGELOG.md
- readme.txt

### 4. Commit and Push

```bash
git add .
git commit -m "Hotfix: Brief description of the critical bug fix"
git push github HEAD:hotfix/v{MAJOR}.{MINOR}.{PATCH+1}
git push gitea HEAD:hotfix/v{MAJOR}.{MINOR}.{PATCH+1}
```

### 5. Create and Push Tag

```bash
git tag -a v{MAJOR}.{MINOR}.{PATCH+1} -m "Hotfix release version {MAJOR}.{MINOR}.{PATCH+1}"
git push github refs/tags/v{MAJOR}.{MINOR}.{PATCH+1}
git push gitea refs/tags/v{MAJOR}.{MINOR}.{PATCH+1}
```

## Common Bug Types and Fixing Strategies

### WordPress Compatibility Issues

- Test with the specific WordPress version where the issue occurs
- Check for deprecated functions or hooks
- Review WordPress changelog for relevant changes

### PHP Compatibility Issues

- Test with the specific PHP version where the issue occurs
- Check for deprecated PHP functions or features
- Use appropriate polyfills if necessary

### JavaScript Issues

- Test in different browsers
- Check for browser console errors
- Consider browser-specific workarounds if necessary

### CSS Issues

- Test in different browsers and screen sizes
- Use browser developer tools to inspect elements
- Consider browser-specific workarounds if necessary

### Database Issues

- Use proper database prefixing
- Sanitize database inputs
- Use prepared statements for queries
- Consider database version differences
