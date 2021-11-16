<?php

namespace Ryir\Core\Traits;

use Ryir\Core\Component\Template;

trait InterfaceComponentTrait
{
    public function __construct(string $id, string $template, array $params)
    {
        parent::__construct($id, $template, $params);
        $this->result = $params;
        $this->componentTemplate = new Template($template, $this);
    }
    public function executeComponent()
    {
        $this->result = $this->newTag($this->params);
        $this->componentTemplate->render();
    }

    protected function newTag($arr)
    {
        if (isset($arr['input_class'])) {
            $result = '';
            foreach ($arr['input_class'] as $key => $value) {
                $result .= $value . ' ';
            }
            $arr['input_class'] = $result;
            return $arr;
        }
        if (isset($arr['attr'])) {
            $result = '';
            foreach ($arr['attr'] as $key => $value) {
                $result .= $key . '="' . $value . '" ';
            }
            $arr['attr'] = $result;
        }
        return $arr;
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
