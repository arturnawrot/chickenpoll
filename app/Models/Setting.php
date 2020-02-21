<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'poll_id';

    protected $fillable = [
        'poll_id', 'name', 'value'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::Class);
    }
}
