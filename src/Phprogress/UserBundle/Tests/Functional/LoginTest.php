<?php

namespace Phprogress\UserBundle\Tests\Functional;

// use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testLogin()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserActiveData'));
        $username = 'foobar';
        $client = $this->helperGetLoggedInClient($username, 'correctPass');
        $this->helperAssertLoggedInAs($client, $username);
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Not logged in
     */
    public function testLoginWrongPass()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserActiveData'));
        $username = 'foobar';
        $client = $this->helperGetLoggedInClient($username, 'wrongPass');
        $this->helperAssertLoggedInAs($client, $username);
    }

    public function testLoginLogout()
    {
        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserActiveData'));
        $username = 'foobar';
        $client = $this->helperGetLoggedInClient($username, 'correctPass');
        $this->helperAssertLoggedInAs($client, $username);
        $crawler = $client->request('GET', '/logout');
        $crawler = $client->request('GET', '/demo/secured/hello/World');
        $this->helperAssertLoggedInAs($client, 'Anonymous');
    }

    public function helperGetLoggedInClient($username, $password)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form();
        $form->setValues(array(
            '_username' => $username,
            '_password' => $password,
        ));
        $client->submit($form);

        return $client;
    }

    public function helperAssertLoggedInAs($client, $username)
    {
        $crawler = $client->request('GET', '/demo/secured/hello/World');
        if (1 > $crawler->filter('html:contains("logged in as '.$username.'")')->count()) {
            throw new \Exception('Not logged in');
        }
    }

//    public function testLoginSession()
//    {
//        $this->loadFixtures(array('Phprogress\UserBundle\Tests\Fixtures\LoadUserActiveData'));
//        $user = $this->getContainer()->get('doctrine')->getEntityManager()->getRepository('ApplicationSonataUserBundle:User')->findOneByUsername('foobar');
//
//        $this->loginAs($user, 'main');
//        $crawler = $this->fetchCrawler('/demo/secured/hello/World', $method = 'GET', $authentication = true, $success = true);
//
//        // this does not work yet: "fails"
//        $this->assertTrue($crawler->filter('html:contains("logged in as foobar")')->count() > 0);
//
//        // this explains why: "logged in as Anonymous"
//        throw new \Exception('the text is: ' .PHP_EOL . $crawler->text());
//    }
}
