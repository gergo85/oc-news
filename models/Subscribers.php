<?php namespace Indikator\News\Models;

use Model;

class Subscribers extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'news_subscribers';

    public $rules = [
        'name'  => 'between:1,100',
        'email' => 'required|between:8,100'
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
