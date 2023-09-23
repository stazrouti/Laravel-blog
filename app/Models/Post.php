<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
        
    use HasFactory;

    protected $fillable = [ "title", "picture", "content","likes","category_id","created_at" ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
