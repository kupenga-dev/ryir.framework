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
        return preg_match($this->rule, $value);
    }

    private function email(string $value): bool
    {
        $this->rule = '/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,10}$/';
        return $this->regexp($value);
    }

    private function name(string $value): bool
    {
        $this->rule = '/^[a-zA-Z]{2, 2}+$/';
        return $this->regexp($value);
    }

    // private function password(string $value): bool
    // {
    //     $this->rule = '/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/';
    //     return $this->regexp($value);
    // }
    private function username(string $value)
    {
        return $this->minLength($value);
    }
    private function in($value): bool
    {
        if (is_array($value)) {
            if (count(array_intersect($value, $this->rule)) !== count($value)) {
                return false;
            }
            return true;
        }
        return in_array($value, $this->rule);
    }
}
