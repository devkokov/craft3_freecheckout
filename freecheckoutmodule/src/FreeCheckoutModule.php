<?php
/**
 * Free Checkout module for Craft CMS 3.x
 *
 * Free Checkout gateway for Craft Commerce 2

Immediately approves the purchase if the amount is 0.

Will reject the purchases with amount greater than 0.

Works same as Dummy gateway with the only difference that it only approves free purchases.

Inspired by https://github.com/intoeetive/freecheckout
 *
 * @link      https://www.burnthebook.co.uk
 * @copyright Copyright (c) 2018 Dimitar Kokov
 */

namespace modules\freecheckoutmodule;

use craft\commerce\services\Gateways;
use craft\events\RegisterComponentTypesEvent;
use Craft;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;
use modules\freecheckoutmodule\gateways\Gateway;
use yii\base\Event;
use yii\base\Module;

/**
 * Class FreeCheckoutModule
 *
 * @author    Dimitar Kokov
 * @package   FreeCheckoutModule
 * @since     1.0.0
 *
 */
class FreeCheckoutModule extends Module
{
    // Static Properties
    // =========================================================================

    /**
     * @var FreeCheckoutModule
     */
    public static $instance;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/freecheckoutmodule', $this->getBasePath());

        // Base template directory
        Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function (RegisterTemplateRootsEvent $e) {
            if (is_dir($baseDir = $this->getBasePath().DIRECTORY_SEPARATOR.'templates')) {
                $e->roots[$this->id] = $baseDir;
            }
        });

        // Set this as the global instance of this module class
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$instance = $this;

        Event::on(
            Gateways::class,
            Gateways::EVENT_REGISTER_GATEWAY_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = Gateway::class;
            }
        );

        Craft::info(
            'Free Checkout module loaded',
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================
}
