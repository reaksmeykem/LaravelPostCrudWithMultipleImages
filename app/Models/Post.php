<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description'
    ];

    public function rPhoto(){
        return $this->hasMany(Image::class,'post_id','id');
    }
}
