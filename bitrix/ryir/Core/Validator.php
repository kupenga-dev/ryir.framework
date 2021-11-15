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

    private function chain(array $value): bool
    {
        if (!isset($this->validators)) {
            return false;
        }
        foreach ($this->validators as $class) {
            $validator = $class;
            if (!$validator->exec($value)) {
                return false;
            }
        }
        return true;
    }

    public function exec(string $value): bool
    {
        return $this->$this->type($value);
    }


    private function minLength(string $value): bool
    {
        if (mb_strlen($value) < $this->rule) {
            return false;
        }
        return true;
    }

    private function regexp(string $value): bool
    {
        if (!preg_match($this->rule, $value)) {
            return false;
        }
        return true;
    }

    private function email(string $value): bool
    {
        //через regexp
        $this->rule = '/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,10}$/';
        if (!$this->regexp($value)) {
            return false;
        }
        return true;
    }

    private function name(string $value): bool
    {
        $this->rule = '/^[a-zA-Z]{2, 2}+$/';
        if (!$this->regexp($value)) {
            return false;
        }
        return true;
    }

    private function password(string $value): bool
    {
        $this->rule = '/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/';
        if (!$this->regexp($value)) {
            return false;
        }
        return true;
    }
    private function username(string $value)
    {
        if (!$this->minLength($value)) {
            return false;
        }
        return true;
    }
    private function in($value): bool
    {
        if (!in_array($value, $this->rule)) {
            return false;
        }
        return true;
    }
}
