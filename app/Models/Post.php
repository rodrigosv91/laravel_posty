<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'    
    ];

    //protected $with = ['user', 'likes'];
    

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    // public function ownedBy(User $user)
    // {
    //     return $user->id === $this->user_id; // compara valor testado e tipo
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
