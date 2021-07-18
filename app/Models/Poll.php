<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'is_active', 'ip'
    ];

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function settings()
    {
        return $this->hasMany(PollSetting::class);
    }

    public function isActive() : bool
    {
        return (bool) $this->is_active;
    }
}
