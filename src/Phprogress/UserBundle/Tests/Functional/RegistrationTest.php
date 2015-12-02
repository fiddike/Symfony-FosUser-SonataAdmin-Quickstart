<?php

namespace Phprogress\UserBundle\Tests\Functional;

// use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase
{
    public function testRegister()
    {
        $this->loadFixtures(array());
        $client = static::createClient();
        $crawler = $client->request('GET', '/register/');
        $form = $crawler->selectButton('Register')->form();
        $form->setValues(array(
            'fos_user_registration_form[username]' => 'testUser',
            'fos_user_registration_form[email]' => 'testEmail@testDomain.com',
            'fos_user_registration_form[plainPassword][first]' => 'testPass',
            'fos_user_registration_form[plainPassword][second]' => 'testPass',
        ));
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("The user has been created successfully")')->count() > 0);
    }

    public function testActiveAccount()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserNeedsActivationData'));
        $client = static::createClient();
        $crawler = $client->request('GET', '/register/confirm/69k42szyub4s4gw4w4ooook4c04cs84o8s040o4800ww8os0gg');
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("your account is now activated.")')->count() > 0);
    }
}
