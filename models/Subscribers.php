<?php namespace Indikator\News\Models;

use Model;

class Subscribers extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'news_subscribers';

    public $rules = [
        'email'  => 'required|email',
        'status' => 'required|between:1,2|numeric'
    ];

    public function beforeCreate()
    {
        $this->created = 1;
        $this->statistics = 0;
    }

    public function beforeUpdate()
    {
        unset($this->created, $this->statistics);
    }
}
