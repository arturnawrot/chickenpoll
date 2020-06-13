<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function scopeFindByUsername($query, $name)
    {
        return $query->whereHas('user', static function ($query) use ($name) {
            $query->where('name', $name);
        })->firstOrFail();
    }
}
