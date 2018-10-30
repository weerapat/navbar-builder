<?php

namespace App\Models\NavigationBar;

use Illuminate\Database\Eloquent\Model;

class NavigationBar extends Model
{
    protected $table = 'navigation_bar';
    protected $casts = [
        'bar' => 'array',
    ];
}
