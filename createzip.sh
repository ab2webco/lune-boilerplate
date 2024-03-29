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

# WPE-friendly gitignore
rm .gitignore &> /dev/null
echo -e "/*\n!dist/" > ./.gitignore

# Copy meaningful contents of app into dist
mkdir dist && cp -rp wp-content/plugins dist && cp -rp wp-content/themes dist

# Go into theme directory
cd "$presentWorkingDirectory/dist/themes/$themeName" &> /dev/null

# Build theme assets
yarn cache clean && yarn && yarn build

# Back to the top
cd "$presentWorkingDirectory"

# Cleanup dist
####################
# Remove sage theme cruft
# Files
# Remove Unnecesary Files
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/.gitignore &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/package.json &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/webpack.config.js &> /dev/null
rm "$presentWorkingDirectory"/dist/themes/"$themeName"/yarn.lock &> /dev/null


# Remove Unnecesary Directories
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/node_modules &> /dev/null
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/assets &> /dev/null
rm -rf "$presentWorkingDirectory"/dist/themes/"$themeName"/webpack &> /dev/null

cd dist/themes/

zip -r -X "$themeName".zip "$themeName"/

cp "$themeName".zip ~/Downloads/

cd "$presentWorkingDirectory"

git checkout .

####################
# Back to a clean slate
####################
git checkout "$currentLocalGitBranch" &> /dev/null
rm -rf dist/ &> /dev/null
rm -rf "$themeName".zip &> /dev/null
git branch -D "$tempDeployGitBranch" &> /dev/null
echo "Done"
