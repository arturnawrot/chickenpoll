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

    protected $appends = array('percentage', 'responses');

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
        // @TODO Yeah, I know...
        $poll = Poll::Where('id', $this->poll_id)->first();
        $totalresponses = $poll->responses->count();
        if($totalresponses === 0) {
            return 0;
        }
        return $this->responses / $totalresponses * 100;
    }

    private function getPollModel($id)
    {
        app('App\Models\Poll')->listcity($id);
    }

    public function getResponsesAttribute()
    {
        return $this->responses()->count();
    }

    public function toArray() {
        $data = parent::toArray();
        $data['responses'] = $this->responses;
        $data['percentage'] = $this->percentage;
        return $data;
    }


}
