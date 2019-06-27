<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    protected $fillable = [
        'name',
        'thumbnail'
    ];

    // 多对一用 belonesTo
    public function user()
    {
        return $this->belonesTo(User::class);
    }

    // 一对多用 hasMany
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }


}
