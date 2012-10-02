<?php

namespace DaveDevelopment\BehatRegistry;

use ArrayObject;

/**
 * This file is part of behat-registry
 *
 * Copyright (c) 2012 Dave Marshall <dave.marshall@atstsolutuions.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Registry extends ArrayObject
{
    protected $persisted = array();

    public function __construct($array = array())
    {
        parent::__construct($array, parent::ARRAY_AS_PROPS);
    }


    public function offsetUnset($index)
    {
        unset($this->persisted[$index]);
        return parent::offsetUnset($index);
    }

    public function tearDown()
    {
        $toDelete = array();
        foreach ($this as $k => $v) {
            if (!isset($this->persisted[$k])) {
                $toDelete[] = $k;
            }
        }

        foreach ($toDelete as $key) {
            unset($this[$key]);
        }
    }

    public function persist($index)
    {
        $this->persisted[$index] = true;
    }
}
