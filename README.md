# Free Checkout module for Craft CMS 3.x

Free Checkout gateway for Craft Commerce 2

Immediately approves the purchase if the amount is 0.

Will reject the purchases with amount greater than 0.

Works same as Manual gateway with the only difference that it only approves free purchases.

Inspired by https://github.com/intoeetive/freecheckout

## Requirements

This module requires Craft CMS 3.0.0-RC1 or later.

## Installation

To install the module, follow these instructions.

First, you'll need to add the `freecheckoutmodule` folder to your `modules` folder.

You'll need to add the contents of the `app.php` file to your `config/app.php` (or just copy it there if it does not exist). This ensures that your module will get loaded for each request. The file might look something like this:
```
return [
    'modules' => [
        'free-checkout-module' => [
            'class' => \modules\freecheckoutmodule\FreeCheckoutModule::class,
        ],
    ],
    'bootstrap' => ['free-checkout-module'],
];
```
You'll also need to make sure that you add the following to your project's `composer.json` file so that Composer can find your module:

    "autoload": {
        "psr-4": {
          "modules\\freecheckoutmodule\\": "modules/freecheckoutmodule/src/"
        }
    },

After you have added this, you will need to do:

    composer dump-autoload
 
 …from the project’s root directory, to rebuild the Composer autoload map. This will happen automatically any time you do a `composer install` or `composer update` as well.
