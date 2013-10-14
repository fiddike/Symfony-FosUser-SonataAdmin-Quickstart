<?php

namespace Phprogress\UserBundle\Tests\Fixtures;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserNeedsActivationData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new \Application\Sonata\UserBundle\Entity\User();
        $user->setUsername('foobar');
        $user->setEmail('foo@bar.com');
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 1);
        $user->setPassword($encoder->encodePassword('12341234', $user->getSalt()));
        $user->setEnabled(false);
        $user->setConfirmationToken('69k42szyub4s4gw4w4ooook4c04cs84o8s040o4800ww8os0gg');
        $manager->persist($user);
        $manager->flush();
    }
}
