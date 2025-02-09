<?php

namespace App\Core\Form;

use App\Core\Model;

/**
 *
 */
class Field
{
    public Model $model;
    public string $attribute;
    public string $type;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = 'text';
    }

    /**
     * @return $this
     */
    public function passwordField() : Field
    {
        $this->type = 'password';
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('
            <div class="mb-3">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->model->getLabel($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

}