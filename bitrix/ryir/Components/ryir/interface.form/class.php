<?php

use Ryir\Core\Component\Base;
use Ryir\Core\Traits\ComponentTrait;
use Ryir\Core\Application;

class InterfaceForm extends Base
{

    protected $result;
    protected $params = [];
    use ComponentTrait;
    private function colletctComponents($params)
    {
        $appItem = Application::getInstance();
        foreach ($params as $value) {
            if ($value['type'] == 'text') {
                $appItem->includeComponent('ryir:interface.input.text', 'stis', $value);
            }
            if ($value['type'] == 'text.multiple') {
                $appItem->includeComponent('ryir:interface.input.text.multiple', 'stis', $value);
            }
            if ($value['type'] == 'select') {
                $appItem->includeComponent('ryir:interface.input.select', 'stis', $value);
            }
            if ($value['type'] == 'select.multiple') {
                $appItem->includeComponent('ryir:interface.input.select.multiple', 'stis', $value);
            }
            if ($value['type'] == 'textarea') {
                $appItem->includeComponent('ryir:interface.textarea', 'stis', $value);
            }
            if ($value['type'] == 'radio.multiple') {
                $appItem->includeComponent('ryir:interface.input.radio.multiple', 'stis', $value);
            }
            if ($value['type'] == 'radio') {
                $appItem->includeComponent('ryir:interface.input.radio', 'stis', $value);
            }
            if ($value['type'] == 'password') {
                $appItem->includeComponent('ryir:interface.input.password', 'stis', $value);
            }
            if ($value['type'] == 'number') {
                $appItem->includeComponent('ryir:interface.input.number', 'stis', $value);
            }
            if ($value['type'] == 'cheackbox') {
                $appItem->includeComponent('ryir:interface.input.cheackbox', 'stis', $value);
            }
            if ($value['type'] == 'cheackbox.multiple') {
                $appItem->includeComponent('ryir:interface.input.cheackbox.multiple', 'stis', $value);
            }
        }
    }
    public function executeComponent()
    {
        if (isset($params['attr']['data-form-id'])) {
            $result = '';
            foreach ($params['attr']['data-form-id'] as $value) {
                $result .= $value . " ";
            }
            $params['attr']['data-form-id'] = $result;
        }
        if (isset($params['elements'])) {
            $this->colletctComponents($params['elements']);
        }
        $this->componentTemplate->render();
    }
}
