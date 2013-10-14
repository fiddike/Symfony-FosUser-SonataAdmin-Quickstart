<?php

namespace Phprogress\UserBundle\Tests\Fixtures;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserActiveData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new \Application\Sonata\UserBundle\Entity\User();
        $user->setUsername('foobar');
        $user->setEmail('foo@bar.com');
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
        $user->setPassword($encoder->encodePassword('correctPass', $user->getSalt()));
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();
    }
}
