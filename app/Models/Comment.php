<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function usersRatings(){
        return $this->belongsToMany(User::class,'ratings')->withPivot('type')->withTimestamps();
    }
    public function authedRating(){
        return $this->belongsToMany(User::class,'ratings')->where('user_id',auth()->id())->withPivot('type')->withTimestamps();
    }
    public function getAuthedRatingAttribute(){
        return  $this->authedRating()->first();
    }
    public function commentUpVotes(){
        return $this->belongsToMany(User::class, 'ratings')->withPivot('type')->where('type','upVote')->withTimestamps();
    }

    public function commentDownVotes(){
        return $this->belongsToMany(User::class, 'ratings')->withPivot('type')->where('type','downVote')->withTimestamps();
    }



}
