<?php

namespace Signify\EnvBar\Extensions;

use SilverStripe\Control\Director;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Security;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\Requirements;

/**
 * EnvBarExtension
 *
 * This class extends the @see SilverStripe\CMS\Controllers\ContentController
 * class.
 *
 * It contains methods to check the environment type, page status (versioning)
 * and user access (member permissions) and returns values to populate the
 * EnvBar.
 *
 * It also contains methods to modify the @see SilverStripe\Control\HTTPResponse
 * before and after the @see SilverStripe\Control\RequestHandler
 * inserting the CSS and HTML required to produce the EnvBar.
 *
 * @package Signify\EnvBar\Extensions
 * @author  Lani Field <lani.field@signify.co.nz>
 * @version 1.0.1
 *
 * @param  \SilverStripe\Control\HTTPRequest $request
 * @return \SilverStripe\Control\HTTPResponse $result
 *         with the EnvBar CSS and HTML inserted.
 */
class EnvBarExtension extends DataExtension
{
    /**
     * Load the CSS requirement.
     *
     * @param  \SilverStripe\Control\HTTPRequest $request
     * @param  string $action
     * @return void
     * @see SilverStripe\Control\RequestHandler::handleAction
     */
    public function beforeCallActionHandler($request, $action)
    {
        Requirements::css('signify-nz/silverstripe-environmentindicator:client/dist/css/envbar.css');
    }

    /**
     * Rewrite the HTML of the viewed page to insert the EnvBar.
     *
     * @param  \SilverStripe\Control\HTTPRequest $request
     * @param  string $action
     * @param  \SilverStripe\ORM\FieldType\DBHTMLText $result
     *         from the original RequestHandler
     * @return \SilverStripe\ORM\FieldType\DBHTMLText $result
     *         with the EnvBar HTML inserted
     * @see SilverStripe\Control\RequestHandler::handleAction
     */
    public function afterCallActionHandler($request, $action, $result)
    {
        if (!($result instanceof DBHTMLText)) {
            return $result;
        }
        $html = $result->getValue();
        $envBar = $this->generateEnvBar()->getValue();
        $html = preg_replace(
            '/(<body[^>]*>)/i',
            '\\1' . $envBar,
            $html
        );
        $result->setValue($html);
        return $result;
    }

    /**
     * Check the environment type.
     *
     * @return string
     *         "dev" if the site is in dev mode,
     *         "test" if the site is in test mode (e.g. QA or UAT),
     *         "live" otherwise (e.g. Production)
     */
    public function getEnvironment()
    {
        if (Director::isDev()) {
            return 'dev';
        } elseif (Director::isTest()) {
            return 'test';
        } else {
            return 'live';
        }
    }

    /**
     * Check the version of the page being viewed.
     *
     * @return string
     *         "published" if it is the current live version in this environment,
     *         "draft" if it is a modified or unpublished version,
     *         "not staged" otherwise
     */
    public function getPageStatus()
    {
        if (Versioned::get_stage() === 'Live') {
            return 'published';
        } elseif (Versioned::get_stage() === 'Stage') {
            return 'draft';
        } else {
            return 'not staged';
        }
    }

    /**
     * Check whether CurrentUser has access to edit pages.
     *
     * @return boolean
     *         "true" if the user can edit pages,
     *         "false" otherwise
     */
    public function getCanAccess()
    {
        $member = Security::getCurrentUser();
        if (Permission::checkMember($member, 'CMS_ACCESS_CMSMain')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Generate the HTML to inject using the EnvBar.ss template.
     *
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    private function generateEnvBar()
    {
        return $this->owner->renderWith('EnvBar');
    }
}
