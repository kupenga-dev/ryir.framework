<?php

use Ryir\Core\Application;
use Ryir\Core\Component\Base;
use Ryir\Core\Traits\InterfaceComponentTrait;


class InterfaceForm extends Base
{
    use InterfaceComponentTrait;
    public function colletctComponents($params)
    {
        $appItem = Application::getInstance();
        $map = [
            'text' => 'input.text',
            'text.multiple' => 'input.text.multiple',
            'number' => 'input.number',
            'password' => 'input.password',
            'e-mail' => 'input.email',
            'checkbox' => 'input.checkbox',
            'checkbox.multiple' => 'input.checkbox.multiple',
            'radio' => 'input.radio',
            'radio.multiple' => 'input.radio.multiple',
            'select' => 'input.select',
            'select.multiple' => 'input.select.multiple',
            'textarea' => 'textarea',
            'submit' => 'button',
        ];
        foreach ($map as $key => $value) {
            for ($i = 0; $i < count($params); $i++) {
                ($key == $params[$i]['type']) ? $appItem->includeComponent("ryir:interface.$value", 'stis', $params[$i]) : '';
            }
        }
    }
}
