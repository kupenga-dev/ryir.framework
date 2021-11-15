<?
$appItem = \Ryir\Core\Application::getInstance();
$appItem->header();
$array = [
    'div_class' => 'form',
    'form_class' => 'form_body', 
    'id' => 'form',
    'h1_title' => 'Авторизация',
    'h1_class' => 'form_title',
    'elements' => [ 
        [
            'type' => 'text',
            'label_class' => 'form_label',
            'div_class' => 'form_item',
            'input_class' => [
                'form_input',
                '_req',
            ],
            'name' => 'username',
            'title' => 'Логин',
            'default' => 'Введите логин*:'
        ],
        [
            'type' => 'password',
            'label_class' => 'form_label',
            'div_class' => 'form_item',
            'input_class' => [
                'form_input',
                '_req',
                '_username'
            ],
            'name' => 'password',
            'title' => 'пароль',
            'default' => 'Введите пароль*:'
        ],
        [
            'type' => 'submit',
            'div_class' => 'form_item',
            'button_class' => 'form_button',
            'id' => 'authorization_button',
            'default' => 'Зарегестрироваться'
        ],
    ]
];
?>
<? $appItem->includeComponent('ryir:interface.form', 'stis', $array); ?>
<? $appItem->footer(); ?>