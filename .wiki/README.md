# Wiki Documentation for Fix 'Plugin file does not exist' Notices

This directory contains the wiki documentation for the "Fix 'Plugin file does not exist' Notices" WordPress plugin. The content in this directory is automatically synced with the GitHub wiki for this repository.

## How to Contribute to the Documentation

1. Clone the repository:
   ```
   git clone https://github.com/wpallstars/wp-fix-plugin-does-not-exist-notices.git
   ```

2. Make changes to the files in the `.wiki` directory.

3. Commit and push your changes to the main branch:
   ```
   git add .wiki
   git commit -m "Update wiki documentation"
   git push origin main
   ```

4. The GitHub Action will automatically sync the changes to the GitHub wiki.

## Documentation Structure

- `Home.md`: The landing page of the wiki
- `_Sidebar.md`: The sidebar navigation for the wiki
- Other `.md` files: Individual documentation pages
- `assets/`: Directory for images and other assets used in the documentation

## Formatting Guidelines

- Use Markdown for all documentation files
- Use descriptive file names with hyphens instead of spaces (e.g., `installation-guide.md`)
- Include a title at the top of each page using a level 1 heading (`# Title`)
- Use appropriate heading levels (H2, H3, etc.) for section organization
- Include links to related pages where appropriate
- Place images in the `assets` directory and reference them using relative paths

## Automatic Syncing

When changes are pushed to the main branch and include modifications to files in the `.wiki` directory, a GitHub Action will automatically sync these changes to the GitHub wiki. This ensures that the documentation is always up-to-date with the latest changes.
