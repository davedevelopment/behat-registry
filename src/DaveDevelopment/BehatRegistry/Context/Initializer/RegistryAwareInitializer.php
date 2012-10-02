<?php

namespace DaveDevelopment\BehatRegistry\Context\Initializer;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Behat\Behat\Context\Initializer\InitializerInterface,
    Behat\Behat\Context\ContextInterface,
    Behat\Behat\Event\ScenarioEvent,
    Behat\Behat\Event\OutlineEvent;

use DaveDevelopment\BehatRegistry\Registry;

use DaveDevelopment\BehatRegistry\Context\RegistryAwareInterface;

/**
 * This file is part of behat-registry
 *
 * Copyright (c) 2012 Dave Marshall <dave.marshall@atstsolutuions.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RegistryAwareInitializer implements InitializerInterface, EventSubscriberInterface
{
    private $registry;

    /**
     * Initializes initializer.
     *
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Checks if initializer supports provided context.
     *
     * @param ContextInterface $context
     *
     * @return Boolean
     */
    public function supports(ContextInterface $context)
    {
        // if context/subcontext implements MinkAwareInterface
        if ($context instanceof RegistryAwareInterface) {
            return true;
        }

        return false;
    }

    /**
     * Initializes provided context.
     *
     * @param ContextInterface $context
     */
    public function initialize(ContextInterface $context)
    {
        $context->setRegistry($this->registry);
    }

    /**
     * {@inherit}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'beforeScenario' => array('tearDown', 0),
        );
    }

    public function tearDown()
    {
        $this->registry->tearDown();
    }
}
