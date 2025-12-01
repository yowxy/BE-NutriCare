<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserChallenge extends Model
{

    protected $table = 'user_challenges';

    protected $fillable = [
        'user_id',
        'challenge_id',
        'status',
        'progress',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'daily_status' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
