<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Poll extends Model
{
    use Sortable, SoftDeletes, HasSlug;

    protected $table = 'polls';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'ip', 'agent'
    ];

    protected $guarded = [
        'id'
    ];

    public $sortable = [
        'title', 'created_at'
    ];

    public $sortableAs = ['votes_count'];

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

    public function reports()
    {
        return $this->hasMany(Report::Class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::Class);
    }

    public function fakeVotes()
    {
        return $this->options()->where('ip', 'fake')->all();
    }

    public function hasSetting($setting)
    {
        return $this->settings()->where('value', $setting)->exists();
    }
}

