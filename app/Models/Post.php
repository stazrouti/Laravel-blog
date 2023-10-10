<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
        
    use HasFactory;

    protected $fillable = [ "title", "picture", "content","likes","category_id","created_at" ];
//i change the return return $this->belongsTo(Category::class);
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
