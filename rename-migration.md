# Repository Rename Migration Guide

This document outlines the steps needed to safely rename the GitHub and Gitea repositories from `plugin-reference-cleaner` to `fix-plugin-does-not-exist-notices` while maintaining history and ensuring proper redirects.

## GitHub Repository Rename

1. Go to the GitHub repository settings: 
   - https://github.com/wpallstars/plugin-reference-cleaner/settings

2. In the "General" tab, find the "Repository name" section and enter the new name: 
   - `fix-plugin-does-not-exist-notices`

3. Click "Rename"

GitHub will automatically set up redirects from the old URL to the new URL, so any existing links to the old repository will still work.

## Gitea Repository Rename

1. Go to the Gitea repository settings:
   - https://gitea.wpallstars.com/wpallstars/plugin-reference-cleaner/settings

2. Find the "Repository Name" field and change it to:
   - `fix-plugin-does-not-exist-notices`

3. Click "Update Repository"

## Update Local Repository

After renaming the remote repositories, update your local git configuration:

```bash
# 1. Update the remote URLs for both GitHub and Gitea
git remote set-url github https://github.com/wpallstars/fix-plugin-does-not-exist-notices.git
git remote set-url gitea git@gitea.wpallstars.com:wpallstars/fix-plugin-does-not-exist-notices.git

# 2. Verify the changes
git remote -v

# 3. Create a new local clone (optional but recommended)
cd ..
git clone git@gitea.wpallstars.com:wpallstars/fix-plugin-does-not-exist-notices.git
cd fix-plugin-does-not-exist-notices
```

## WordPress.org Plugin Submission

When submitting to WordPress.org, you'll need to use the new slug:

- Plugin slug: `fix-plugin-does-not-exist-notices`

After approval, update the GitHub secrets with:

```
SVN_USERNAME: your_wordpress_username
SVN_PASSWORD: your_wordpress_password
SLUG: fix-plugin-does-not-exist-notices
```

## Final Steps

1. Update any documentation or links that reference the old repository name
2. Commit and push all the renamed files
3. Create a new release with the new file naming conventions 