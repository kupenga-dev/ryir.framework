<?php

namespace Ryir\Core;

use Ryir\Core\Type\Dictionary;

class Request extends Dictionary
{
    public function __construct(array $values)
    {
        parent::__construct($values);
    }
    
}
