<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //





    public function reviews (){
        return $this->hasMany(Review::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function likedByUsers(){
    return $this->belongsToMany(User::class, 'likes' )->withTimestamps();
    }


}
