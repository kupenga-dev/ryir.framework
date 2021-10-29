<?php

namespace Ryir\Core;

use Ryir\Core\Type\Dictionary;

class Server extends Dictionary
{
    public function __construct(array $values)
    {
        parent::__construct($values);
    }

    public function getDocumentRoot()
    {
        return $this->values['DOCUMENT_ROOT'];
    }

    public function getRequestUri()
    {
        return $this->values["REQUEST_URI"];
    }

    public function getScriptName()
    {
        return $this->values["SCRIPT_NAME"];
    }
}