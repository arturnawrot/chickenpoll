<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'option_id', 'ip', 'agent'
    ];

    public function option()
    {
        return $this->hasOne(Option::Class);
    }

    public function poll()
    {
        return $this->hasOneThrough(Option::Class, Poll::Class);
    }

    public function visitor()
    {
        return Visitor::Where('ip', $this->ip)
            ->where('created_at', '<', $this->created_at)
            ->orderBy('id', 'desc')
            ->first();
//        return $this->hasOne(Visitor::Class, 'ip', 'ip');
    }
}
