<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Elegant extends Model
{
    protected $rules = [];

    protected $errors;

    public function validate ($data) {
        $v = Validator::make($data, $this->rules);

        if ($v->fails()) {
            $this->errors = $v->errors;
            return false;
        }

        return true;
    }

    public function errors () {
        return $this->errors;
    }
}
