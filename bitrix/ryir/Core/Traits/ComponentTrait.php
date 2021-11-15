<?php

namespace Ryir\Core\Traits;

use Ryir\Core\Component\Template;

trait ComponentTrait
{
    public function __construct(string $id, string $template, array $params)
    {
        parent::__construct($id, $template, $params);
        $this->componentTemplate = new Template($template, $this);
    }

    public function getResult()
    {
        return $this->result;
    }
    public function getParams()
    {
        return $this->params;
    }
}
