<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    // protected $table = 'options';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id'
    ];
    
    protected $fillable = [
        'poll_id', 'content'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::Class);
    }
}
