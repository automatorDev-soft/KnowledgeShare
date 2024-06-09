<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'article_id',
        'course_id',
        'content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }
    /*public function likes(){
        return $this->hasMany(Like::class);
    }*/
}
