<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext as BaseMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends BaseMinkContext
{
    public function __construct($session)
    {

    }
}