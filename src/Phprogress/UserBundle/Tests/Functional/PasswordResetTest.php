<?php

namespace Phprogress\UserBundle\Tests\Functional;

// use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class PasswordResetTest extends WebTestCase
{
    public function testPasswordResetRequest()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserActiveData'));
        $username = 'foobar';
        $client = static::createClient();
        $crawler = $client->request('GET', '/resetting/request');
        $form = $crawler->selectButton('Reset password')->form();
        $form->setValues(array(
            'username' => $username,
        ));
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("An email has been sent to")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("It contains a link you must click to reset your password.")')->count() > 0);
    }

    public function testPasswordReset()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserPasswordResetData'));
        $client = static::createClient();
        $crawler = $client->request('GET', '/resetting/reset/3bsxa20o51icowk0w84s44ows4c4cccw44s8wg4s0g004080cs');
        $form = $crawler->selectButton('Change password')->form();
        $form->setValues(array(
            'fos_user_resetting_form[new][first]'  => 'newPass',
            'fos_user_resetting_form[new][second]' => 'newPass',
        ));
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("link_edit_profile")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("link_edit_authentication")')->count() > 0);
    }

    public function testUseResetTokenViaRegisterConfirm()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserPasswordResetData'));
        $client = static::createClient();
        $crawler = $client->request('GET', '/register/confirm/3bsxa20o51icowk0w84s44ows4c4cccw44s8wg4s0g004080cs');
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("your account is now activated.")')->count() > 0);
    }
}
