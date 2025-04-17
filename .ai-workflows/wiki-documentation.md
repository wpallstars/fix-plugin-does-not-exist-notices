# Wiki Documentation Management

This document outlines the process for maintaining and updating the wiki documentation for the "Fix 'Plugin file does not exist' Notices" plugin.

## Wiki Structure

The wiki documentation is stored in the `.wiki` directory in the repository. This directory contains Markdown files that are automatically synced to the GitHub wiki when changes are pushed to the main branch.

### Key Files

- **Home.md**: The landing page of the wiki
- **_Sidebar.md**: The sidebar navigation for the wiki
- **README.md**: Instructions for contributing to the wiki
- **Other .md files**: Individual documentation pages
- **assets/**: Directory for images and other assets used in the documentation

## Documentation Synchronization

To ensure consistency across all documentation sources, follow these guidelines:

### When Updating README.md or readme.txt

1. Identify the sections that need to be reflected in the wiki documentation
2. Update the corresponding wiki pages in the `.wiki` directory
3. Ensure that feature descriptions, usage instructions, and other relevant information are consistent across all documentation sources
4. Update the changelog in all locations:
   - README.md
   - readme.txt
   - CHANGELOG.md
   - .wiki/Changelog.md

### When Adding New Features or Functions

1. Document the feature in the appropriate README.md and readme.txt sections
2. Create or update the corresponding wiki page in the `.wiki` directory
3. Include:
   - Feature description
   - Usage instructions
   - Examples
   - Screenshots (if applicable)
   - Any relevant configuration options

### When Adding Hooks or Filters

1. Document the hook or filter in the README.md file
2. Update or create the `.wiki/Hooks-and-Filters.md` page with:
   - Hook/filter name
   - Description
   - Parameters
   - Return value
   - Example usage
   - Default behavior

### When Updating Code Structure

1. Update the `.wiki/How-It-Works.md` page to reflect the new code structure
2. If the changes affect the plugin's architecture, update any relevant diagrams or explanations
3. Ensure that the documentation accurately reflects the current state of the codebase

## Wiki Maintenance Workflow

### Regular Maintenance

1. Review the wiki documentation monthly to ensure it's up-to-date
2. Check for broken links, outdated information, or missing content
3. Update screenshots and examples to reflect the latest version of the plugin

### Release-Driven Updates

1. Before each release, review and update all wiki documentation
2. After the release, update the `.wiki/Changelog.md` file with the latest changes
3. Ensure that new features or changes are properly documented in the wiki

### User-Driven Updates

1. Monitor GitHub issues and WordPress.org support forums for common questions
2. Update the FAQ and troubleshooting sections based on user feedback
3. Add new examples or clarifications based on user questions

## Repository-Specific Documentation

When working in a multi-repository workspace, it's critical to ensure that wiki documentation accurately reflects the features and functionality of the **current repository only**.

### Avoiding Cross-Repository Confusion

1. **Verify Features Before Documenting**:
   - Always verify that a feature exists in the current repository before documenting it
   - Use `codebase-retrieval` to search for feature implementations
   - Check the actual code, not just comments or references

2. **Repository-Specific Content**:
   - Document only features that exist in the current repository
   - Don't assume features from other repositories are present in this one
   - Be explicit about which repository the documentation applies to

3. **Feature Inspiration vs. Existing Features**:
   - If documenting a feature inspired by another repository but not yet implemented, clearly mark it as a proposed feature
   - Don't document features as if they exist when they're only planned or inspired by other repositories

4. **Cross-Repository References**:
   - If referencing functionality from another repository, clearly indicate that it's external
   - Use phrases like "unlike Repository X, this plugin does not include..."

For detailed guidelines on working in multi-repository workspaces, see **@.ai-workflows/multi-repo-workspace.md**.

## Best Practices

### Content Guidelines

- Use clear, concise language
- Include step-by-step instructions for complex tasks
- Use screenshots or diagrams to illustrate concepts
- Provide code examples for developers
- Keep the documentation organized and easy to navigate

### Formatting Guidelines

- Use consistent Markdown formatting
- Use descriptive file names with hyphens instead of spaces
- Include a title at the top of each page using a level 1 heading (`# Title`)
- Use appropriate heading levels (H2, H3, etc.) for section organization
- Include links to related pages where appropriate

### Workflow Integration

- When working on code changes, consider documentation updates as part of the same task
- Create or update wiki documentation in the same branch as code changes
- Include documentation updates in pull request descriptions
- Request documentation review as part of the code review process

## Automatic Syncing

When changes are pushed to the main branch and include modifications to files in the `.wiki` directory, a GitHub Action will automatically sync these changes to the GitHub wiki. This ensures that the documentation is always up-to-date with the latest changes.

The sync workflow is defined in `.github/workflows/sync-wiki.yml` and runs whenever changes to the `.wiki` directory are pushed to the main branch.

## Documentation Testing

Before pushing documentation changes:

1. Preview the Markdown files locally to ensure proper formatting
2. Check all links to ensure they work correctly
3. Verify that code examples are correct and up-to-date
4. Ensure that screenshots accurately reflect the current UI

## Troubleshooting Wiki Sync Issues

If the wiki sync fails:

1. Check the GitHub Actions logs for error messages
2. Verify that the wiki repository exists and is accessible
3. Ensure that the GitHub token has the necessary permissions
4. Try manually syncing the wiki by following the steps in the workflow file
