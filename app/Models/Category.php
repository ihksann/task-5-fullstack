<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
