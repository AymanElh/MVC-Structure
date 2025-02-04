<?php

namespace App\Core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MATCH = 'match';

    public function loadData(array $data)
    {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return array
     */
    abstract function rules() : array;

    public array $errors = [];

    /**
     * @return bool
     */
    public function validate() : bool
    {
        foreach($this->rules() as $attribute => $rules) {
            $value = $this->$attribute;
            foreach($rules as $rule) {
                $ruleName= $rule;
                if(is_array($rule)) {
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, $ruleName);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, $ruleName);
                }
                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, $ruleName);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * @param string $attribute
     * @param string $rule
     * @return void
     */
    public function addError(string $attribute, string $rule)
    {
        $this->errors[$attribute][] = $this->errorMessages()[$rule];
    }

    /**
     * @return string[]
     */
    public function errorMessages() : array
    {
        return [
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_EMAIL => 'This field must be a valid email address.',
            self::RULE_MATCH => 'This field must be a matching pattern.',
        ];
    }

    /**
     * @param string $attribute
     * @return false|mixed
     */
    public function hasError(string $attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    /**
     * @param string $attribute
     * @return string|null
     */
    public function getFirstError(string $attribute) : ?string
    {
        return $this->errors[$attribute][0] ?? null;
    }
}