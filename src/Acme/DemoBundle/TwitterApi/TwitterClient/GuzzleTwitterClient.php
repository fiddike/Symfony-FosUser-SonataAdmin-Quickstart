<?php

namespace Acme\DemoBundle\TwitterApi\TwitterClient;

use Acme\DemoBundle\TwitterApi\TwitterClientInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class GuzzleTwitterClient implements TwitterClientInterface
{
    public function getTweetsForUser(UserInterface $user)
    {
        // TODO: Implement getTweetsForUser() method.
    }
}