<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Visitor extends Model
{
    use Sortable;

    protected $fillable = [
        'ip',
        'method',
        'url',
        'referer',
        'agent',
        'type',
        'is_bot',
        'os',
        'browser',
        'country',
        'country_code',
        'city',
        'lat',
        'long',
        'language'
    ];

    public $sortable = [
        'created_at'
    ];
}
