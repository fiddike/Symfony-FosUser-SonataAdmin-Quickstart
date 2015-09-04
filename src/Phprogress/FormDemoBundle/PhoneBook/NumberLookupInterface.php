<?php
namespace Phprogress\FormDemoBundle\PhoneBook;

interface NumberLookupInterface
{
    function lookup ($name);
}