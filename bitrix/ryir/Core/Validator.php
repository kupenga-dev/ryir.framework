<?php

namespace Ryir\Core;

class Validator
{
    private string $type;
    private $rule;
    private ?array $validators;

    public function __construct(string $stringType, $rule = '', array $massValidators = null)
    {
        $this->type = $stringType;
        $this->$rule = $rule;
        $this->validators = $massValidators;
    }

    private function chain(string $value): bool
    {
        if (!isset($this->validators)) {
            return false;
        }
        foreach ($this->validators as $class) {
            // var_dump($class);
            if (!$class->exec($value)) {
                return false;
            }
        }
        return true;
    }

    public function exec($value): bool
    {
        $method = $this->type;
        return $this->$method($value);
    }

    private function isEmpty(string $value): bool
    {
        return !empty($value);
    }
    private function minLength(string $value): bool
    {
        return (mb_strlen($value) > $this->rule);
    }

    private function regexp(string $value): bool
    {
        var_dump($this);
        return preg_match($this->rule, $value);
    }

    private function email(string $value): bool
    {
        $this->rule = '/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,10}$/';

        return $this->regexp($value);
    }

    private function username(string $value)
    {
        return $this->minLength($value);
    }
    private function in($value): bool
    {
        if (is_array($value)) {
            return (count(array_intersect($value, $this->rule)) !== count($value));
        }
        return in_array($value, $this->rule);
    }
}
