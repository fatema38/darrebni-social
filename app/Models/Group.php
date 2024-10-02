<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'owner_id',
        'image_path'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'user_group')->withPivot('is_admin')->withTimestamps();
    }
    public function admins(){
        return $this->belongsToMany(User::class,'user_group')->where('is_admin',true)->withPivot('is_admin')->withTimestamps();
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function owner(){
      return  $this->belongsTo(User::class,'owner_id');
    }
}
