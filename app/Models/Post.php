<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'body',
    // ];

    protected $guarded = [];

    public function isOwnPost()
    {
        return Auth::check() && $this->user_id == Auth::id();
    }

    //public function user()
    //{
    //    return $this->belongsTo(User::class);
    //}

    public function author()
    {
        // return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo(User::class, 'user_id');
    }

}