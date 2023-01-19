<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'info';
    protected $filltable = [
        'title',
        'description',
        'logo'
    ];
}
