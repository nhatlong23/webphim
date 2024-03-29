<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    //1 danh muc co nhieu phim
    public function movie()
    {
        return $this->hasMany(Movie::class)->orderby('id', 'DESC');
    }
    //1 phim co nhieu danh muc
    public function movie_category()
    {
        return $this->belongsToMany(Movie::class, 'movie_category')->where('year', '=', '2023')
            ->whereHas('genre', function ($subquery) {
                $subquery->where('status', 1);
            })
            ->orderBy('date_created', 'DESC')->limit(20);
    }
}
