#!/bin/sh -l

rm .gitignore &> /dev/null
echo -e "/*\n!wp-content/" > ./.gitignore

rm .env.example
rm README.md
rm composer.json
rm composer.lock
rm index.php
rm wp-config.php
rm wpedeploy.sh
rm createzip.sh
rm cpaneldeploy.sh
rm -rf config
rm -rf scripts
rm -rf .github
rm -rf .git
cd wp-content/themes/nix
rm yarn.json
yarn cache clean
yarn
yarn build
rm .gitignore
rm package.json
rm webpack.config.js
rm yarn.lock
rm -rf node_modules
rm -rf assets
rm -rf webpack