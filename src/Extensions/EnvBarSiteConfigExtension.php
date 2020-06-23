<?php

namespace Signify\EnvBar\Extensions;

use BadMethodCallException;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

/**
 * Add override boolean to the site config settings
 * @see SilverStripe\SiteConfig\SiteConfig
 * to allow CMS admin to disable automatic display of the Environment Indicator
 * bar on the frontend pages.
 *
 * @author Lani Field <lani.field@signify.co.nz>
 * @version 1.1.0
 * @package Signify\EnvBar\Extensions
 */
class EnvBarSiteConfigExtension extends DataExtension
{
    /**
     * Add override column to SiteConfig db record.
     *
     * @var string[]
     */
    private static $db = [
        'EnvBarOverride' => 'Boolean',
    ];

    /**
     * Add Checkbox field for override value to new Environment Indicator tab
     * in CMS Settings.
     *
     * @param FieldList $fields
     * @return void
     * @throws BadMethodCallException
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.EnvironmentIndicator', [
            CheckboxField::create(
                'EnvBarOverride',
                'Tick to turn off the environment indicator bar'
            ),
        ]);
    }
}
