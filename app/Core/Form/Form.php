<?php

namespace App\Core\Form;

use App\Core\Model;

class Form
{
    /**
     * @param string $method
     * @param string $action
     * @return Form
     */
    public static function begin(string $method, string $action = "") : Form
    {
        echo(sprintf('<form action="" method="POST">'));
        return new Form;
    }

    /**
     * @return string
     */
    public static function end() : string
    {
        return '</form>';
    }

    /**
     * @param Model $model
     * @param string $attribute
     * @param string $type
     * @return Field
     */
    public function field(Model $model, string $attribute, string $type = 'text') : Field
    {
        return new Field($model, $attribute);
    }
}