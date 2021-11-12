<?php

namespace Ryir\Core;

class Validator
{
    private string $type;
    private ?mixed $rule;
    private ?array $validators;

    public function __construct(string $stringType, mixed $rule = null, array $massValidators = null)
    {
        $this->type = $stringType;
        $this->$rule = $rule;
        if ($rule == true) {
            $this->validators = $massValidators;
        }
    }

    public function chain(array $massValid, $data): bool
    {
        foreach ($massValid as $value) {
            $validator = $value;
            if (!$validator->exec($data)) {
                return false;
            }
        }
        return true;
    }

    public function exec($value): bool
    {
        if ($this->rule == null) {
            return $this->$this->type($value);
        }
        if (isset($this->validators)) {
            return $this->$this->type($this->validators, $value);
        }
        return $this->$this->type($this->rule, $value);
    }


    public function minLength($rule, $value): bool
    {
        if (mb_strlen($value) < $rule) {
            return false;
        }
        return true;
    }

    public function email($value): bool
    {
        $patternForEmail = '/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,10}$/';
        if (!preg_match($patternForEmail, $value)) {
            return false;
        }
        return true;
    }


    public function regexp($rule, $value): bool
    {
        if (!preg_match($rule, $value)) {
            return false;
        }
        return true;
    }

    public function in()
    {
    }
    // $valid = new Validator('minLength', 5);
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

}
