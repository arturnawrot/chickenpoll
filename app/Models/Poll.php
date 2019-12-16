<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $table = 'polls';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'ip', 'agent'
    ];

    protected $guarded = [
        'id'
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(Answer::Class, Option::Class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::Class);
    }
}

