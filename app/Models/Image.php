<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'photo' 
    ];

    public function Post(){
        return $this->belongsTo(Post::class);
    }
}
