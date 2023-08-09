<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkMovie extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'linkmovie';
    protected $filltable = [
        'title',
        'description',
        'status'
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    
}
