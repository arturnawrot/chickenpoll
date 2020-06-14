<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'poll_id', 'content'
    ];

    protected $appends = array('percentage', 'responsesCount');

    public function poll()
    {
        return $this->belongsTo(Poll::Class);
    }

    public function responses()
    {
        return $this->hasMany(Response::Class);
    }

    public function getPercentageAttribute()
    {
        $totalResponses = $this->poll->responses()->count();
        if($totalResponses === 0)
            return 0;
        return $this->responsesCount / $totalResponses * 100;
    }

    public function getResponsesCountAttribute()
    {
        return $this->responses()->count();
    }

    public function toArray() {
        $data = parent::toArray();
        $data['responses'] = $this->responsesCount;
        $data['percentage'] = $this->percentage;
        return $data;
    }


}
