<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'tags',
        'group_id',
        'pendingPost',
        'image'
    ];
    protected $casts = [
        'tags' => 'array',
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function usersRatings()
    {
        return $this->belongsToMany(User::class, 'ratings','','')->withPivot('type')->withTimestamps();
    }

    public function authedRating(){
        return $this->belongsToMany(User::class, 'ratings')->where('user_id',auth()->id())->withPivot('type')->withTimestamps();
    }

    public function postUpVotes(){
        return $this->belongsToMany(User::class, 'ratings')->withPivot('type')->where('type','upVote')->withTimestamps();
    }

    public function postDownVotes(){
        return $this->belongsToMany(User::class, 'ratings')->withPivot('type')->where('type','downVote')->withTimestamps();
    }

    public function getAuthedRatingAttribute(){
      return  $this->authedRating()->first();
    }


    public function allTags()
    {
        // الوسوم من الحقل JSON
        $jsonTags = $this->tags ?? [];

        // الوسوم من العلاقة
        $relatedTags = $this->tags()->pluck('name')->toArray();

        // دمج الوسوم وتفادي التكرار
        return array_unique(array_merge($jsonTags, $relatedTags));
    }
    public function usersReports(){
        return $this->belongsToMany(User::class,'reports')->withPivot('note')->withTimestamps();

    }
    public function group(){
        return $this->belongsTo(Group::class);
    }


}
