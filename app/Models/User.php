<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role_id',
        'facebook',
        'linkedin',
        'twitter',
        'gmail',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function postsRatings()
    {
        return $this->belongsToMany(Post::class, 'ratings')->withPivot('type')->withTimestamps();
    }
    public function postsUpVotes(){
        return $this->belongsToMany(Post::class, 'ratings')->withPivot('type')->where('type','upVote')->withTimestamps();
    }

    public function postsDownVotes(){
        return $this->belongsToMany(Post::class, 'ratings')->withPivot('type')->where('type','downVote')->withTimestamps();
    }

    public function commentsRatings()
    {
        return $this->belongsToMany(Comment::class, 'ratings')->withPivot('type')->withTimestamps();
    }
    public function followers(){
        return $this->belongsToMany(User::class,'followers','following_id','follower_id');
    }

    public function following(){
        return $this->belongsToMany(User::class,'followers','follower_id','following_id');
    }


public function role(){
        return $this->belongsTo(Role::class);
}
public function postsreports(){
           return $this->belongsToMany(Post::class,'reports')->withPivot('note')->withTimestamps();
}

    public function groups(){
        return $this->belongsToMany(Group::class,'user_group')->withPivot('is_admin')->withTimestamps();
    }
    public function isMemberOfGroup($groupId){
        return $this->groups()->where('group_id',$groupId)->exists();
    }
    public function isAdminOfGroup($groupId){
        return $this->groups()->where('group_id',$groupId)->where('is_admin',true)->exists();
    }



}
