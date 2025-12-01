<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'points',
        'duration_days',
    ];

    protected $casts = [
        'criteria' => 'array',
    ];

    public function userChallenges()
    {
        return $this->hasMany(UserChallenge::class);
    }
}
