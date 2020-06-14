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

    protected $fillable = [
        'title', 'ip', 'agent'
    ];

    public $sortable = [
        'title', 'created_at'
    ];

    public $sortableAs = ['responses_count'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function responses()
    {
        return $this->hasManyThrough(Response::Class, Option::Class);
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

    public function fakeresponses()
    {
        return $this->options()->where('ip', 'fake')->all();
    }

    public function hasSetting($setting)
    {
        return $this->settings()->where('value', $setting)->exists();
    }

    public function validationRules()
    {
        $rules = [
            'options_id' => ['min:1', 'required']
        ];

        $availableSettings = [
            [
                'title' => 'captcha',
                'key' => 'g-recaptcha-response',
                'value' => ['required', 'recaptcha'],
            ]
        ];

        foreach($availableSettings as $setting)
        {
            if($this->hasSetting($setting['title'])) {
                $rules[$setting['key']] = $setting['value'];
            }
        }
        
        return [
            'rules' => $rules,
            'messages' => [
                'options_id.required' => 'You have not selected any option(s)',
                'g-recaptcha-response.required' => 'Please complete the captcha',
            ]
        ];
    }
}

