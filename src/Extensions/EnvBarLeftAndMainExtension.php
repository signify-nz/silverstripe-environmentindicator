<?php

namespace Signify\EnvBar\Extensions;

use SilverStripe\Control\Director;
use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

/**
 * EnvBarLeftAndMainExtension
 *
 * This class extends the @see SilverStripe\Admin\LeftAndMain class.
 *
 * It inserts a custom div above the menu header the CMS Admin interface during
 * the init method via the css and javascript requirements.
 *
 * It uses the javascriptTemplate requirement so the environment type can be
 * passed in to the jQuery function for display.
 *
 * @package Signify\EnvBar\Extensions
 * @author Lani Field <lani.field@signify.co.nz>
 * @version 1.0.0
 */
class EnvBarLeftAndMainExtension extends Extension
{
    public function init()
    {
        Requirements::css('signify-nz/silverstripe-environmentindicator:admin/client/dist/css/envbar.css');

        $vars = [
            'EnvType' => Director::get_environment_type(),
        ];
        Requirements::javascriptTemplate(
            'signify-nz/silverstripe-environmentindicator:admin/client/dist/js/envbar.js',
            $vars
        );
    }
}
