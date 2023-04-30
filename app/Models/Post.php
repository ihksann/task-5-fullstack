<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'image',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
