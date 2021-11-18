<?php

namespace Ryir\Core;

use App\Services\Database;

class Validator
{
    private string $type;
    private $rule;
    private array $validators;
    private $databaseItem;

    public function __construct(string $stringType, $rule = null, array $massValidators = null)
    {
        $this->databaseItem = new Database;
        $this->type = $stringType;
        if (isset($rule)) {
            $this->rule = $rule;
        }

        if (isset($massValidators)) {
            $this->validators = $massValidators;
        }
    }

    private function chain($value): bool
    {
        if (!isset($this->validators)) {
            return false;
        }
        if (empty($value)) {
            return false;
        }
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

    private function minLength(string $value): bool
    {
        return (mb_strlen($value) >= $this->rule);
    }

    private function isUniqueEmail($value)
    {
        return !$this->databaseItem->findUserByEmail($value);
    }
    private function isUniqueUsername($value)
    {
        return !$this->databaseItem->findUserByUsername($value);
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

    private function in($value): bool
    {
        if (is_array($value)) {
            return (count(array_intersect($value, $this->rule)) !== count($value));
        }
        return in_array($value, $this->rule);
    }
}
