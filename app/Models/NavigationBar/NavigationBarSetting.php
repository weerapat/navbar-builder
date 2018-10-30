<?php

namespace App\Models\NavigationBar;

use Illuminate\Database\Eloquent\Model;

class NavigationBarSetting extends Model
{
    const TYPES = [
        'STANDARD' => 'standard',
        'LINK' => 'link'
    ];
    protected $table = 'navigation_bar_setting';
    protected $casts = [
        'items' => 'array'
    ];
    protected $fillable = [
        'items',
        'related_article_amount'
    ];
}
