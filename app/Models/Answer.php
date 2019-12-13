<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'option_id', 'ip', 'os', 'browser'
    ];

    public function option()
    {
        return $this->hasOne(Option::Class);
    }
}
