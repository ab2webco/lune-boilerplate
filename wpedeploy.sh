# Your theme directory name (/wp-content/themes/yourtheme)
themeName="nix"
########################################

####################
# Usage
####################
# bash wpedeploy.sh nameOfRemote
####################
# Set variables
####################
# WP Engine remote to deploy to
wpengineRemoteName=$1
# Get present working directory
presentWorkingDirectory=`pwd`
# Get current branch user is on
currentLocalGitBranch=`git rev-parse --abbrev-ref HEAD`
# Temporary git branch for building and deploying
tempDeployGitBranch="wpedeployscript/${currentLocalGitBranch}"
# KWB themes directory
ThemesDirectory="${presentWorkingDirectory}/wp-content/themes/"

####################
# Perform checks before running script
####################

# Git checks
####################
# Halt if there are uncommitted files
if [[ -n $(git status -s) ]]; then
  echo -e "[\033[31mERROR\e[0m] Found uncommitted files on current branch \"$currentLocalGitBranch\".\n        Review and commit changes to continue."
  git status
  exit 1
fi

# Check if specified remote exist
git ls-remote "$wpengineRemoteName" &> /dev/null
if [ "$?" -ne 0 ]; then
  echo -e "[\033[31mERROR\e[0m] Unknown git remote \"$wpengineRemoteName\"\n        Visit \033[32mhttps://wpengine.com/git/\e[0m to set this up."
  echo "Available remotes:"
  git remote -v
  exit 1
fi

# Directory checks
####################
# Halt if theme directory does not exist
if [ ! -d "$presentWorkingDirectory"/wp-content/themes/"$themeName" ]; then
  echo -e "[\033[31mERROR\e[0m] Theme \"$themeName\" not found.\n        Set \033[32mthemeName\e[0m variable in $0 to match your theme in $ThemesDirectory"
  echo "Available themes:"
  ls $ThemesDirectory
  exit 1
fi

####################
# Begin deploy process
####################
# Checkout new temporary branch
echo "Preparing theme on branch ${tempDeployGitBranch}..."
git checkout -b "$tempDeployGitBranch" &> /dev/null

# Run composer
pilothouse composer install

# WPE-friendly gitignore
rm .gitignore &> /dev/null
echo -e "/*\n!dist/" > ./.gitignore

# Copy meaningful contents of app into dist
mkdir dist && cp -rp wp-content/plugins dist && cp -rp wp-content/themes dist

# Go into theme directory
cd "$presentWorkingDirectory/dist/themes/$themeName" &> /dev/null

# Build theme assets
yarn install && yarn build

# Back to the top
cd "$presentWorkingDirectory"

# Cleanup dist
####################
# Remove sage theme cruft
# Files
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.bowerrc &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.editorconfig &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.gitignore &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.jscsrc &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.jshintrc &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.travis.yml &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/bower.json &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/gulpfile.js &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/package.json &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/composer.json &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/composer.lock &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/ruleset.xml &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/CHANGELOG.md &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/CONTRIBUTING.md &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/LICENSE.md &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/README.md &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/webpack.config.js &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/yarn.lock &> /dev/null


# Directories
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/node_modules &> /dev/null
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/bower_components &> /dev/null
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/assets &> /dev/null
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/vendor &> /dev/null
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/webpack &> /dev/null

####################
# Push to WP Engine
####################
git ls-files | xargs git rm --cached &> /dev/null
cd "$presentWorkingDirectory"/dist/
find . | grep .git | xargs rm -rf
cd "$presentWorkingDirectory"

git add --all &> /dev/null
git commit -am "WP Engine build from: $(git log -1 HEAD --pretty=format:%s)$(git rev-parse --short HEAD 2> /dev/null | sed "s/\(.*\)/@\1/")" &> /dev/null
echo "Pushing to WPEngine..."

# Push to a remote branch with a different name
# git push remoteName localBranch:remoteBranch
git push "$wpengineRemoteName" "$tempDeployGitBranch":master --force

####################
# Back to a clean slate
####################
git checkout "$currentLocalGitBranch" &> /dev/null
rm -rf dist/ &> /dev/null
git branch -D "$tempDeployGitBranch" &> /dev/null
echo "Done"
