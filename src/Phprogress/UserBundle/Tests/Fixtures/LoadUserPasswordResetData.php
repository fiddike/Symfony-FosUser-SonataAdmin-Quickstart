<?php

namespace Phprogress\UserBundle\Tests\Fixtures;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserPasswordResetData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new \Application\Sonata\UserBundle\Entity\User();
        $user->setUsername('foobar');
        $user->setEmail('foo@bar.com');
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 1);
        $user->setPassword($encoder->encodePassword('12341234', $user->getSalt()));
        $user->setEnabled(false);
        $user->setPasswordRequestedAt(new \DateTime());
        $user->setConfirmationToken('3bsxa20o51icowk0w84s44ows4c4cccw44s8wg4s0g004080cs');
        $manager->persist($user);
        $manager->flush();
    }
}
