<?php


namespace myframework\base;


use myframework\Db;
use Valitron\Validator;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = h($data[$name]);
            }
        }
    }

    public function validate($data)
    {
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        $this->errors = $v->errors();

        return false;
    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }

    public function save($tabel)
    {
        $tbl = \R::dispense($tabel);
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }

        return \R::store($tbl);
    }
}