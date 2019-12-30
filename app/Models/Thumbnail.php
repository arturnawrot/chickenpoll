<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    protected $primaryKey = 'poll_id';
    protected $table = 'thumbnails';

    protected $fillable = [
        'path'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::Class);
    }
}
