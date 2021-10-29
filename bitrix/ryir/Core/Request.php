<?php

namespace Ryir\Core;

use Ryir\Core\Type\Dictionary;

class Request extends Dictionary
{
    protected $arRequest = [];

    public function __construct(array $arRequest = null)
    {
        if ($arRequest !== null) {
            $this->arRequest = $arRequest;
        }
    }
}
