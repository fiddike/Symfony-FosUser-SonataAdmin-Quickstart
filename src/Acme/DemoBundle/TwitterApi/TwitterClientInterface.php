<?php

namespace Acme\DemoBundle\TwitterApi;

use Symfony\Component\Security\Core\User\UserInterface;

interface TwitterClientInterface
{
    public function getTweetsForUser(UserInterface $user);
} 