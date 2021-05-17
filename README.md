# Dadolun_ThemeLayoutBlock

## Features
This module gives the possibility to insert cms blocks into frontend page layouts.
8 custom positions are available (4 before and 4 after the main-content):
- Main Top
- Top A
- Top B
- Top C
- Main Bottom
- Bottom A
- Bottom B
- Bottom C

You can choose to insert your cms block on CMS pages, Product pages, Category pages and also other layout.
In order to manage custom position this module adds custom attributes for CMS pages, Products and Categories.
A dedicated section is added for the other frontend layouts on "Content > Design > Custom Blocks".

## Installation
You can install this module adding it on app/code folder or with composer.
##### COMPOSER
You need to update your composer.json "repositories" node:
```
{
    "type": "vcs",
    "url":  "git@github.com:dadolun95/magento2-theme-layout-block.git"
}
```
Then execute this command:
```
composer require dadolun95/magento2-theme-layout-block
```
Then you'll need to enable the module and update your database:
```
php bin/magento module:enable Dadolun_ThemeLayoutBlock
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```
##### SOURCE CODE
If you choose to add the module from source code instead of using composer you need to add module's files on your app/code folder.
Then enable it and update the database:
```
php bin/magento module:enable Dadolun_ThemeLayoutBlock
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

## Contributing
Contributions are very welcome. In order to contribute, please fork this repository and submit a [pull request](https://docs.github.com/en/free-pro-team@latest/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).
