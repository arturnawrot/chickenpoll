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

    protected $appends = array('percentage', 'votes');

    public function poll()
    {
        return $this->belongsTo(Poll::Class);
    }

    public function votes()
    {
        return $this->hasMany(Answer::Class);
    }

    public function getPercentageAttribute()
    {
        // @TODO Yeah, I know...
        $poll = Poll::Where('id', $this->poll_id)->first();
        $totalVotes = $poll->votes->count();
        if($totalVotes === 0) {
            return 0;
        }
        return $this->votes / $totalVotes * 100;
    }

    private function getPollModel($id)
    {
        app('App\Models\Poll')->listcity($id);
    }

    public function getVotesAttribute()
    {
        return $this->votes()->count();
    }
}
