# Feature Development Guide for AI Assistants

This document provides guidance for AI assistants to help with feature development for the Fix Plugin Does Not Exist Notices plugin.

## Feature Development Workflow

### 1. Create a Feature Branch

Always start by creating a feature branch from the main branch:

```bash
git checkout main
git pull github main
git checkout -b feature/descriptive-name
```

Use a descriptive name that clearly indicates what the feature is about.

### 2. Implement the Feature

When implementing a new feature:

- Follow WordPress coding standards
- Ensure all strings are translatable
- Add appropriate comments
- Consider performance implications
- Maintain backward compatibility

### 3. Update Documentation

Update relevant documentation to reflect the new feature:

- Add a description to CHANGELOG.md under an "Unreleased" section
- Update readme.txt if the feature affects user-facing functionality
- Update inline documentation/comments
- Remember that any feature addition will require a version increment in all relevant files

### 4. Testing

Test the feature thoroughly:

- Test with the latest WordPress version
- Test with the minimum supported WordPress version (5.0)
- Test with PHP 7.0+ (minimum supported version)
- Test in different environments (if possible)

### 5. Commit Changes

Make atomic commits with clear messages:

```bash
git add .
git commit -m "Add feature: descriptive name"
```

### 6. Prepare for Release

When the feature is ready to be released:

1. Create a version branch for the release:

```bash
git checkout -b v{MAJOR}.{MINOR}.{PATCH}
```

2. Merge your feature branch into the version branch:

```bash
git merge feature/descriptive-name --no-ff
```

3. Update version numbers and changelog entries

4. Follow the standard release process from this point

### 7. Push to Remote (Optional for Collaboration)

If you need to collaborate with others on the feature before it's ready for release:

```bash
git push github HEAD:feature/descriptive-name
git push gitea HEAD:feature/descriptive-name
```

### 8. Create Pull Request (Optional)

If the repository uses pull requests for code review, create a pull request from the feature branch to the version branch.

## Code Standards and Best Practices

### PHP Coding Standards

- Follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- Use tabs for indentation, not spaces
- Use proper naming conventions:
  - Class names: `Class_Name`
  - Function names: `function_name`
  - Variable names: `$variable_name`

### JavaScript Coding Standards

- Follow [WordPress JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/)
- Use tabs for indentation, not spaces
- Use proper naming conventions:
  - Function names: `functionName`
  - Variable names: `variableName`

### Internationalization (i18n)

- Wrap all user-facing strings in appropriate translation functions:
  - `__()` for simple strings
  - `_e()` for echoed strings
  - `esc_html__()` for escaped strings
  - `esc_html_e()` for escaped and echoed strings
- Always use the plugin's text domain: `fix-plugin-does-not-exist-notices`

### Security Best Practices

- Validate and sanitize all input
- Escape all output
- Use nonces for form submissions
- Use capability checks for user actions

## Feature Types and Implementation Guidelines

### Admin Interface Features

When adding features to the admin interface:

- Use WordPress admin UI components for consistency
- Follow WordPress admin UI patterns
- Ensure accessibility compliance
- Add appropriate help text

### Plugin Functionality Features

When adding core functionality:

- Ensure compatibility with WordPress hooks system
- Consider performance impact
- Maintain backward compatibility
- Add appropriate error handling

### Integration Features

When adding integration with other plugins or services:

- Make integrations optional when possible
- Check if the integrated plugin/service is available before using it
- Provide fallback functionality when the integration is not available
- Document the integration requirements
