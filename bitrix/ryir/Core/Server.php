<?php

namespace Ryir\Core;

use Ryir\Core\Type\Dictionary;

class Server extends Dictionary
{
    protected $arServer = [];

    public function __construct(array $arServer = null)
    {
        if ($arServer !== null) {
            $this->arServer = $arServer;
        }
    }

    public function getDocumentRoot()
    {
        return $this->arServer["DOCUMENT_ROOT"];
    }

    public function getRequestUri()
    {
        return $this->arServer["REQUEST_URI"];
    }

    public function getScriptName()
    {
        return $this->arServer["SCRIPT_NAME"];
    }
}