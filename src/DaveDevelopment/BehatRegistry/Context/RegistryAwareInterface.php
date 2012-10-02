<?php

namespace DaveDevelopment\BehatRegistry\Context;

use DaveDevelopment\BehatRegistry\Registry;

interface RegistryAwareInterface
{
    /**
     * Sets Registry Instance
     *
     * @param Registry $registry
     */
    public function setRegistry(Registry $registry);
}
