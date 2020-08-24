<?php

namespace Signify\EnvBar\Tests;

use SilverStripe\Dev\FunctionalTest;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Tests the display of the EnvBar according to the environment type,
 * page stage and the user's access
 */
class EnvBarSiteConfigExtensionTest extends FunctionalTest
{
    protected static $fixture_file = 'EnvBarExtensionTest.yml';

    /**
     * Test EnvBar present when display is enabled in CMS
     */
    public function testDisplayEnabled()
    {
        $url = $this->objFromFixture(
            'SilverStripe\CMS\Model\SiteTree',
            'default'
        )->URLSegment;

        $user = $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        );

        $this->EnvBarVisible(
            $url,
            $user
        );
    }

    /**
     * Test EnvBar NOT present when display is disabled in CMS
     */
    public function testDisplayDisabled()
    {
        $url = $this->objFromFixture(
            'SilverStripe\CMS\Model\SiteTree',
            'default'
        )->URLSegment;

        $user = $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        );

        $this->EnvBarNotVisible(
            $url,
            $user
        );
    }


    /**
     * Test EnvBar is present somewhere on page
     */
    public function EnvBarVisible($url, $user)
    {
        if ($user) {
            $this->logInAs($user);
        }
        SiteConfig::current_site_config()->setField('EnvBarDisplay', 'true');
        $testPage = $this->get($url);
        $this->assertContains(
            '.page__envbar',
            $testPage->getBody()
        );
        if ($user) {
            $this->logOut();
        }
    }

    /**
     * Test EnvBar is not injected into the page
     */
    public function EnvBarNotVisible($url, $user)
    {
        if ($user) {
            $this->logInAs($user);
        }
        SiteConfig::current_site_config()->setField('EnvBarDisplay', 'false');
        $testPage = $this->get($url);
        $this->assertNotContains(
            '.page__envbar',
            $testPage->getBody()
        );
        if ($user) {
            $this->logOut();
        }
    }
}
