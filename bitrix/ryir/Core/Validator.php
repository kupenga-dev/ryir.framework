<?php

namespace Ryir\Core;

class Validator
{
    private $type;
    private $rule;
    private $validators;

    public function __construct($stringType, $rule = null, array $massValidators = null)
    {
        $this->type = $stringType;
        if (isset($rule))
        {
            $this->$rule = $rule;
        }
        if (isset($massValidators))
        {
            $this->validators = $massValidators;
        }
        
    }

    private function chain(string $value): bool
    {
        if (!isset($this->validators)) {
            return false;
        }
        var_dump($this->validators);
        die();
        foreach ($this->validators as $class) {
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
