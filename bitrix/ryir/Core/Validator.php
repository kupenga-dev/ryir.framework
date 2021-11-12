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
}
