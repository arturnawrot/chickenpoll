<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlink extends Model
{
    protected $fillable = [
        'url', 'shortened_url', 'service', 'ip'
    ];
}
