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
        $this->validators = $massValidators;
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
        if (isset($this->validators)) {
            return $this->$this->type($this->validators, $value);
        }
        return $this->$this->type($value);
    }


    public function minLength($value): bool
    {
        if (mb_strlen($value) < $this->rule) {
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


    public function regexp($value): bool
    {
        if (!preg_match($this->rule, $value)) {
            return false;
        }
        return true;
    }

    public function in()
    {
    }
}
