<?
$appItem = \Ryir\Core\Application::getInstance();
$appItem->header();
$array = [
    'div_class' => 'form',
    'form_class' => 'form_body', 
    'h1_title' => 'Регистрация',
    'id' => 'register__form',
    'js' => 'register.js',
    'h1_class' => 'form_title',
    'elements' => [ 
        [
            'type' => 'text',
            'label_class' => 'form_label',
            'div_class' => 'form_item',
            'input_class' => [
                'form_input',
                '_req',
                '_username'
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
                '_password'
            ],
            'name' => 'password',
            'title' => 'пароль',
            'default' => 'Введите пароль*:'
        ],
        [
            'type' => 'password',
            'label_class' => 'form_label',
            'div_class' => 'form_item',
            'input_class' => [
                'form_input',
                '_req',
                '_confirn_password'
            ],
            'name' => 'confirn_password',
            'title' => 'пароль',
            'default' => 'Подтвердите пароль*:'
        ],
        [
            'type' => 'e-mail',
            'label_class' => 'form_label',
            'div_class' => 'form_item',
            'input_class' => [
                'form_input',
                '_req',
                '_email'
            ],
            'name' => 'email',
            'title' => 'Логин',
            'default' => 'Введите E-mail*:'
        ],
        [
            'type' => 'text',
            'label_class' => 'form_label',
            'div_class' => 'form_item',
            'input_class' => [
                'form_input',
                '_req',
                '_name'
            ],
            'name' => 'name',
            'default' => 'Введите имя*:'
        ],
        [
            'type' => 'submit',
            'div_class' => 'form_item',
            'button_class' => 'form_button',
            'id' => 'registration_button',
            'default' => 'Зарегестрироваться'
        ],

    ]
];
?>
<? $appItem->includeComponent('ryir:interface.form', 'stis', $array); ?>
<? $appItem->footer(); ?>