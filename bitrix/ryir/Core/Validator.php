<?php

namespace Ryir\Core;

class Validator
{
    private string $type;
    private ?mixed $rule;
    private ?array $validators;
//     $valid = new Validator('minLength', 5);
// $valid->exec($value) : boolean result
// или , когда сложная валидация
//
// private string Validator::type - тут будет хранится строковое представление метода валидации
// private ?mixed Validator::rule - правило для валидации
// private ?array Validator::validators- массив дополнительных объектов валидации

// public function exec() - метод выполнения валидации.
// public function {type}() - именованные методы валидации (например minLength() - проверка значения на длину, in() - проверка из списка, regexp())

// Как это должно работать.
// $valid = new Validator
//     (
//     'chain',
//      true,
//      [
//         new Validator('minLength', 5),
//         new Validator('regexp', '/^[A-Za-z0-9]{0,}$/'),
//         new Validator('email')
//      ]
//     );

// $valid->exec($value);
public function minLength()
{

}

public function __construct()
{

}

}