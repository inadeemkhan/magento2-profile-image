# Mage2 Module Nadeem ProfilePicture

    ``nadeem/module-profilepicture``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Magento2 extension to upload and show profile picture on account pages and top header. | Nadeem Khan

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Nadeem`
 - Enable the module by running `php bin/magento module:enable Nadeem_ProfilePicture`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require nadeem/module-profilepicture`
 - enable the module by running `php bin/magento module:enable Nadeem_ProfilePicture`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - enable (profile_image/general/enable)


## Specifications

 - Helper
	- Nadeem\ProfilePicture\Helper\Data


## Attributes

 - Customer - profile_pic (profile_pic)

