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
        return $query->where('user_id', User::Where('name', $name)->firstOrFail()->id)->firstOrFail();
    }
}
