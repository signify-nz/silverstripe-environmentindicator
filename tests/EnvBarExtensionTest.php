<?php

namespace Signify\EnvBar\Tests;

use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Kernel;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\Versioned\Versioned;

/**
 * Tests the display of the EnvBar according to the environment type,
 * page stage and the user's access
 */
class EnvBarExtensionTest extends FunctionalTest
{
    protected static $fixture_file = 'EnvBarExtensionTest.yml';

    /**
     * Test EnvBar when in the dev environment viewing a draft page
     */
    public function testDevEnvironmentDraftStage()
    {
        $environment = 'dev';
        $kernel = Injector::inst()->get(Kernel::class);
        $kernel->setEnvironment($environment);

        $stage = 'draft';
        $url = $this->getStagePageURL($stage);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        ), $stage, $environment);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'editor'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testNotAuthorised($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'registereduser'
        ), $stage, $environment);

        $this->testRedirectToLogin($url, null, $stage, $environment);
    }

    /**
     * Test EnvBar when in the test environment viewing a draft page
     */
    public function testTestEnvironmentDraftStage()
    {
        $environment = 'test';
        $kernel = Injector::inst()->get(Kernel::class);
        $kernel->setEnvironment($environment);

        $stage = 'draft';
        $url = $this->getStagePageURL($stage);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        ), $stage, $environment);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'editor'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testNotAuthorised($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'registereduser'
        ), $stage, $environment);

        $this->testRedirectToLogin($url, null, $stage, $environment);
    }

    /**
     * Test EnvBar when in the live environment viewing a draft page
     */
    public function testLiveEnvironmentDraftStage()
    {
        $environment = 'live';
        $kernel = Injector::inst()->get(Kernel::class);
        $kernel->setEnvironment($environment);

        $stage = 'draft';
        $url = $this->getStagePageURL($stage);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        ), $stage, $environment);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'editor'
        ), $stage, $environment);

        $this->testEnvBarNotIncluded($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testNotAuthorised($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'registereduser'
        ), $stage, $environment);

        $this->testRedirectToLogin($url, null, $stage, $environment);
    }

    /**
     * Test EnvBar when in the dev environment viewing a published page
     */
    public function testDevEnvironmentPublishedStage()
    {
        $environment = 'dev';
        $kernel = Injector::inst()->get(Kernel::class);
        $kernel->setEnvironment($environment);

        $stage = 'published';
        $url = $this->getStagePageURL($stage);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        ), $stage, $environment);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'editor'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'registereduser'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, null, $stage, $environment);
    }

    /**
     * Test EnvBar when in the test environment viewing a published page
     */
    public function testTestEnvironmentPublishedStage()
    {
        $environment = 'test';
        $kernel = Injector::inst()->get(Kernel::class);
        $kernel->setEnvironment($environment);

        $stage = 'published';
        $url = $this->getStagePageURL($stage);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        ), $stage, $environment);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'editor'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'registereduser'
        ), $stage, $environment);

        $this->testEnvBarVisible($url, null, $stage, $environment);
    }

    /**
     * Test EnvBar when in the live environment viewing a published page
     */
    public function testLiveEnvironmentPublishedStage()
    {
        $environment = 'live';
        $kernel = Injector::inst()->get(Kernel::class);
        $kernel->setEnvironment($environment);

        $stage = 'published';
        $url = $this->getStagePageURL($stage);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'admin'
        ), $stage, $environment);

        $this->testEnvBarAccessGranted($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'editor'
        ), $stage, $environment);

        $this->testEnvBarNotIncluded($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testEnvBarNotIncluded($url, $this->objFromFixture(
            'SilverStripe\Security\Member',
            'reviewer'
        ), $stage, $environment);

        $this->testEnvBarNotIncluded($url, null, $stage, $environment);
    }

    /**
     * Test the content of the EnvBar is correct for an authorised user
     */
    public function testEnvBarAccessGranted($url, $user, $stage, $environment)
    {
        $this->logInAs($user);
        $this->get($url);
        $this->assertExactHTMLMatchBySelector(
            '.page__envbar',
            [
                '<a href="/admin/pages/edit/show/1" target="_blank" rel="noopener noreferrer" '
                    . 'class="page__envbar page__envbar--link page__envbar--'
                    . strtolower($environment) . '">Logged in as <strong>'
                    . strtoupper($user->FirstName) . '</strong> viewing the <strong>'
                    . strtoupper($stage) . '</strong> version of this page in the <strong>'
                    . strtoupper($environment) . '</strong> environment.<br/>'
                    . 'This bar will not be visible to unauthorised users when live. '
                    . 'Click to <strong>EDIT</strong> in new tab.</a>'
            ]
        );
        $this->logOut();
    }

    /**
     * Test the content of the EnvBar is correct for an unauthorised user
     */
    public function testEnvBarVisible($url, $user, $stage, $environment)
    {
        if ($user) {
            $this->logInAs($user);
        }
        $this->get($url);
        $this->assertExactHTMLMatchBySelector(
            '.page__envbar',
            [
                '<span class="page__envbar page__envbar--'
                    . strtolower($environment) . '">You are viewing the <strong>'
                    . strtoupper($stage) . '</strong> version of this page in the <strong>'
                    . strtoupper($environment) . '</strong> environment.<br/>'
                    . 'This bar will not be visible to unauthorised users when live.</span>'
            ]
        );
        if ($user) {
            $this->logOut();
        }
    }

    /**
     * Test EnvBar is not injected into the page
     */
    public function testEnvBarNotIncluded($url, $user, $stage, $environment)
    {
        if ($user) {
            $this->logInAs($user);
        }
        $testPage = $this->get($url);
        $this->assertNotContains(
            '.page__envbar',
            $testPage->getBody()
        );
        if ($user) {
            $this->logOut();
        }
    }

    /**
     * Test the unauthorised user is forbidden access
     */
    public function testNotAuthorised($url, $user, $stage, $environment)
    {
        if ($user) {
            $this->logInAs($user);
        }
        $testPage = $this->get($url);
        $this->assertEquals(403, $testPage->getStatusCode());
        if ($user) {
            $this->logOut();
        }
    }

    /**
     * Test the anonymous user is redirected to the login
     */
    public function testRedirectToLogin($url, $user, $stage, $environment)
    {
        if ($user) {
            $this->logInAs($user);
        }
        $this->get($url);
        $this->assertExactHTMLMatchBySelector(
            '#MemberLoginForm_LoginForm_BackURL',
            [
                '<input type="hidden" name="BackURL" value="/test-page" class="hidden"'
                    . ' id="MemberLoginForm_LoginForm_BackURL" />'
            ]
        );
        if ($user) {
            $this->logOut();
        }
    }

    /**
     * Get the correct url for the test
     */
    public function getStagePageURL($stage)
    {
        $page = $this->objFromFixture('SilverStripe\CMS\Model\SiteTree', 'default');
        if ($stage === 'draft') {
            $url = $page->URLSegment . '?stage=Stage';
        } elseif ($stage === 'published') {
            $page->copyVersionToStage(Versioned::DRAFT, Versioned::LIVE);
            $url = $page->URLSegment;
        } else {
            $url = null;
        }
        return $url;
    }
}
